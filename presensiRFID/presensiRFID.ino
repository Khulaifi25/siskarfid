#include <SPI.h>
#include <MFRC522.h>
#include <ESP8266HTTPClient.h>
#include <WiFiClient.h>
#include <ESP8266WiFi.h>
#include <Wire.h>
#include <Adafruit_GFX.h>
#include <Adafruit_SSD1306.h>
#include <ArduinoJson.h>

// Network SSID
const char* ssid = "Noir";
const char* password = "yuknowlah....";

// Host (Server IP Address)
const char* host = "192.168.241.6";

// Sediakan variabel untuk RFID
#define SDA_PIN 2  // D4
#define RST_PIN 0  // D3

MFRC522 mfrc522(SDA_PIN, RST_PIN);

// Setup OLED
#define SCREEN_WIDTH 128
#define SCREEN_HEIGHT 64
Adafruit_SSD1306 display(SCREEN_WIDTH, SCREEN_HEIGHT, &Wire, -1);


// Deklarasi pin untuk buzzer
#define BUZZER_PIN 15 // Pin D8 untuk buzzer

// Deklarasi WiFiClient secara global
WiFiClient client;

unsigned long previousMillisz = 0; // Timing control


void setup() {
  Serial.begin(115200);
  if (!display.begin(SSD1306_SWITCHCAPVCC, 0x3C)) {
    Serial.println(F("SSD1306 allocation failed"));
    for (;;); // If failed, stop execution here
  }
  display.display();  
  delay(2000);  // Initial delay for display
  
  // Setting koneksi WiFi
  WiFi.hostname("NodeMCU");
  WiFi.begin(ssid, password);

  // Cek Koneksi WiFi
  while (WiFi.status() != WL_CONNECTED) {
    // Mencari WiFi
    delay(500);
    Serial.println(".");
  }
  Serial.println("WiFi Connected");
  Serial.println("IP Address :");
  Serial.println(WiFi.localIP());

  pinMode(BUZZER_PIN, OUTPUT);
  digitalWrite(BUZZER_PIN, LOW); // Matikan buzzer di awal

  SPI.begin();
  mfrc522.PCD_Init();
  Serial.println("Dekatkan Kartu RFID Anda ke Sensor Reader");
  Serial.println();

  // Menampilkan pesan Intro di OLED
  display.clearDisplay();
  display.setTextSize(1);      
  display.setTextColor(WHITE);
  display.setCursor(0, 15);
  display.print("SISKA-CV MULIA ABADI");
  display.display();
  delay(2000); // Tunggu sebentar

  display.clearDisplay();
  display.setTextSize(1);      
  display.setCursor(0, 15);
  display.print("Silahkan Tempel Kartu RFID Anda");
  display.display();
}

void loop() {
  unsigned long currentMillisz = millis();

  // Read RFID every interval (non-blocking)
  if (currentMillisz - previousMillisz >= 1000) {
    previousMillisz = millis();
    
    if (mfrc522.PICC_IsNewCardPresent() && mfrc522.PICC_ReadCardSerial()) {
      // Membunyikan buzzer selama 500 ms
      digitalWrite(BUZZER_PIN, HIGH);
      delay(500);
      digitalWrite(BUZZER_PIN, LOW);
      
      String IDTAG = "";
      for (byte i = 0; i < mfrc522.uid.size; i++) {
        IDTAG += mfrc522.uid.uidByte[i];
      }

      // Update OLED with UID
      display.clearDisplay();
      display.setCursor(0, 0);
      display.print("UID/IDTAG: ");
      display.print(IDTAG);
      display.setCursor(0, 20);
      display.print("Scanning...");
      display.display();

      // Wait a little before making HTTP request
      delay(500);  // Give some time to process

      // Send data to server
      String Link = "http://192.168.241.6:8080/siska/kirimkartu.php?id_card=" + IDTAG;
      HTTPClient http;
      http.begin(client, Link); // HTTP Request to server
      http.setTimeout(5000); // Set timeout to avoid blocking
      int httpCode = http.GET();
      if (httpCode > 0) {
        String payload = http.getString();
        StaticJsonDocument<200> doc;
        DeserializationError error = deserializeJson(doc, payload);

        if (!error) {
          const char* nama = doc["nama"];
          const char* statuse = doc["statuse"];
          
          // Tampilkan respon (nama) di OLED
          display.clearDisplay();
          display.setCursor(25, 0);
          display.print("=== SISKA ===");
          
          display.setCursor(0, 10); // Pindah ke baris kedua
          display.print("UID: ");
          display.print(IDTAG);
          
          display.setCursor(0, 20);
          display.print("NAMA: ");
          display.print(nama); // Menampilkan nama yang diambil dari server
          
          display.setCursor(0, 40);
          display.print("STATUS: ");
          display.setCursor(0, 50);
          display.print(statuse);// Menampilkan status yang diambil dari server
          display.display();
        } else {
          Serial.println("Gagal parsing JSON");
        }
      } else {
        Serial.println("Gagal mengakses server");
      }
      http.end(); // End HTTP request
    }
  }

  yield(); // Allow watchdog timer to reset

//  delay(2000);
}
