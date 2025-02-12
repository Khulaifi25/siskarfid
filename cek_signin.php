<?php
// Koneksi DB
include 'koneksi.php';

$pass = md5($_POST['password']);
$id_card = mysqli_escape_string($koneksi, $_POST['id_card']);
$password = mysqli_escape_string($koneksi, $pass);
$level = mysqli_escape_string($koneksi, $_POST['level']);

// cek id_card terdaftar atau tidak
$cek_user = mysqli_query($koneksi, "SELECT * FROM karyawan WHERE id_card='$id_card' AND level='$level'");
$user_valid = mysqli_fetch_array($cek_user);

// uji id_card terdaftar
if ($user_valid) {
    //jika terdaftar
    //cek password sesuai atau tdk
    if ($password == $user_valid['password']) {
        //jika sesuai
        session_start();
        $_SESSION['id'] = $user_valid['id'];
        $_SESSION['id_card'] = $user_valid['id_card'];
        $_SESSION['nama'] = $user_valid['nama'];
        $_SESSION['job'] = $user_valid['job'];
        $_SESSION['gender'] = $user_valid['gender'];
        $_SESSION['level'] = $user_valid['level'];
        session_write_close();

        //uji level
        if ($level == "admin") {
            header('location:home_admin.php');
        } else if ($level == "karyawan") {
            header('location:home_karyawan.php');
        }
    } else {
        //jika password tidak sesuai
        echo "<script>alert('Password Salah!');document.location.href='signin.php'</script>";
    }
} else {
    //jika tidak terdaftar
    echo "<script>alert('UID Tidak Terdaftar!');document.location.href='signin.php'</script>";
}
