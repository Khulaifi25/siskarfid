# SISKA - Sistem Presensi Karyawan RFID dan NodeMCU

## 📋 Overview

SISKA (Sistem Presensi Karyawan) is a modern employee attendance system that integrates RFID technology with web-based management. Built using PHP Native for the backend and Arduino-based hardware implementation.

## 🌐 Live Demo

- **Demo URL**: https://siskarfid.cloud/
- **Login Panel**: https://siskarfid.cloud/signin.php/
- **Test Credentials**:

  - Admin Access:
    UID: **🔒Not Access**
    Password: **🔒Not Access**

  - Employee Access:
    UID: 1452091914
    Password: khotimah

## 🚀 Key Features

- Real-time RFID card scanning
- Employee attendance tracking
- Attendance reports and analytics
- User management system
- Dashboard monitoring
- Export attendance data (XLSX, PDF)

## 🛠 Technology Stack

### Software

- PHP Native
- MySQL Database
- HTML5, CSS3, JavaScript
- Bootstrap Framework

### Hardware

- NodeMCU ESP8266
- RFID-RC522 Module
- Buzzer Module 3.3V
- OLED 0.96"

## 💻 System Requirements

- PHP 7.4 or higher
- MySQL 5.7 or higher
- Arduino IDE

## 📦 Installation

1. Clone this repository
2. Import database schema (contact me to access)
3. Configure database connection
4. Upload Arduino code ../presensiRFID/presensiRFID.ino to NodeMCU
5. Connect RFID hardware
6. Run the system

## 📱 Features Preview

- Employee Registration
- RFID Card Management
- Real-time Attendance Monitoring
- Attendance Reports
- User Access Control
- Set of working hours for attendance (Present, Late, Leave, Out of Hours Work/Absent)

## 🤝 Contributing

Contributions, issues, and feature requests are welcome!

## ⚖️ License

This project is licensed under the MIT License

## 📞 Contact

Developer: [Abdurrosyid Khulaifi]
Email: [khulaifi52@gmail.com]

---

<div id="tag" align="center">Made with ❤️ for better attendance management</div>
<div id="copyright" align="center">
    &copy; 2024 - 2025 siskarfid.cloud - 4Saken Inc. - All Rights Reserved.
</div>
<script>
(() => {
    const copyrightElement = document.getElementById("copyright");
    copyrightElement.innerHTML = "&copy; 2024 - "+new Date().getFullYear()+" siskarfid.cloud - All Rights Reserved.";
})();
</script>
