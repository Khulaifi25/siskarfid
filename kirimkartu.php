<?php
include "koneksi.php";

// Set header agar response berbentuk JSON
header('Content-Type: application/json');

if (isset($_GET['id_card'])) {
    $idcard = $_GET['id_card'];
    // kosongkan tabel tmprfid
    mysqli_query($koneksi, "delete from tmprfid");

    // Simpan id kartu yang baru ke tabel tmprfid
    $simpan = mysqli_query($koneksi, "INSERT INTO tmprfid (id_card) VALUES ('$idcard')");
    if ($simpan) {
        // Ambil data nama dari tabel karyawan berdasarkan id_card
        $query = mysqli_query($koneksi, "SELECT nama FROM karyawan WHERE id_card = '$idcard'");
        $data = mysqli_fetch_assoc($query);

        if ($data) {
            // Jika nama ditemukan, kembalikan respons JSON dengan nama
            echo json_encode([
                "statuse" => "Berhasil Presensi",
                "id_card" => $idcard,
                "nama" => $data['nama']
            ]);
        } else {
            // Jika nama tidak ditemukan di tabel karyawan
            echo json_encode([
                "statuse" => "Kartu Belum Terdaftar",
                "id_card" => $idcard,
                "nama" => "Tidak ditemukan"
            ]);
        }
    } else {
        // Jika gagal menyimpan ke tmprfid
        echo json_encode([
            "statuse" => "Gagal",
            "pesan" => "Gagal menyimpan data ke tmprfid"
        ]);
    }
} else {
    // Respons jika parameter id_card tidak ditemukan
    echo json_encode([
        "statuse" => "Error",
        "pesan" => "Parameter id_card tidak ditemukan!"
    ]);
}
