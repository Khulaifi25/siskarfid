<?php
require 'koneksi.php'; // Sesuaikan dengan file koneksi Anda
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php'; // Sesuaikan dengan lokasi autoload.php Anda

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_card = $_POST['id_card'];
    $email = $_POST['email'];

    // Validasi ID Card di tabel karyawan
    $query = "SELECT * FROM karyawan WHERE id_card = ?";
    $stmt = $koneksi->prepare($query);
    $stmt->bind_param("s", $id_card);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Set zona waktu ke waktu lokal, misalnya Jakarta (WIB)
        date_default_timezone_set('Asia/Jakarta');
        // ID Card ditemukan
        $token = bin2hex(random_bytes(32));
        $expires_at = date("Y-m-d H:i:s", strtotime("+30 minutes"));

        // Simpan token ke tabel password_resets
        $insert_query = "INSERT INTO password_resets (id_card, token, expires_at) VALUES (?, ?, ?)";
        $stmt = $koneksi->prepare($insert_query);
        $stmt->bind_param("sss", $id_card, $token, $expires_at);
        $stmt->execute();

        // Kirim email dengan token
        $reset_link = "https://" . $_SERVER['HTTP_HOST'] . "/change_password.php?token=$token";
        // Konfigurasi PHPMailer
        $mail = new PHPMailer(true);
        try {
            $mail->isSMTP();
            $mail->Host       = 'smtp.gmail.com'; // SMTP server
            $mail->SMTPAuth   = true;
            $mail->Username   = 'kazuhikooffcl@gmail.com'; // Email Anda
            $mail->Password   = 'pyvc omjf rucv izqw'; // Password aplikasi Gmail Anda
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port       = 587;

            // Pengaturan email
            $mail->setFrom('no-reply.siskarfid@gmail.com', 'SISKA System');
            $mail->addAddress($email); // Email penerima
            $mail->Subject = 'Reset Password';
            $mail->isHTML(true); // Set email format to HTML
            $mail->Body    = "
                <html>
                <head>
                    <style>
                        .button {
                            background-color: #007bff; /* Blue */
                            border: none;
                            color: white;
                            padding: 15px 32px;
                            text-align: center;
                            text-decoration: none;
                            display: inline-block;
                            font-size: 16px;
                            margin: 4px 2px;
                            cursor: pointer;
                            border-radius: 12px;
                        }
                    </style>
                </head>
                <body>
                    <h2>Reset Password - UID : $id_card</h2>
                    <p>Sistem SISKA menerima permintaan untuk mereset password Anda. Klik tombol di bawah ini untuk melanjutkan proses reset password</p>
                    <a href='$reset_link' class='button'>Reset Password</a>
                    <p>Jika Anda tidak meminta reset password, abaikan email ini.</p>
                    <p>Terima kasih,<br>SISKA System</p>
                </body>
                </html>";

            $mail->send();
            echo "<script>alert('Password telah direset, silahkan cek email Anda!'); window.location.href = 'reset-password.php';</script>";
        } catch (Exception $e) {
            echo "<script>alert('Gagal mengirim email. Error: {$mail->ErrorInfo}'); window.history.back();</script>";
        }
    } else {
        // ID Card tidak ditemukan
        echo "<script>alert('ID Card tidak ditemukan.'); window.history.back();</script>";
    }
}
