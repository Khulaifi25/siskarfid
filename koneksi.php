<?php
$koneksi = mysqli_connect('localhost', 'sisc2617_siska', 'siskarfid', 'sisc2617_siska');
if (!$koneksi) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
