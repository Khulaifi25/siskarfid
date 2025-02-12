<?php
include "koneksi.php";

//baca status presensi terakhir
$mode = mysqli_query($koneksi, "SELECT * FROM status");
$data_mode = mysqli_fetch_array($mode);
$mode_presensi = $data_mode['mode'];

//status terakhir kemudian ditambah 1
$mode_presensi = $mode_presensi + 1;
if ($mode_presensi > 4) {
    $mode_presensi = 1;
}

//simpan mode absen di tabel status dengan cara update
$simpan = mysqli_query($koneksi, "UPDATE status SET mode='$mode_presensi'");
if ($simpan) {
    echo "Berhasil";
} else {
    echo "Gagal";
}
