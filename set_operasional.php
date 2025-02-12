<?php
include 'koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $waktu_masuk_start = $_POST['waktu_masuk_start'];
    $waktu_masuk_end = $_POST['waktu_masuk_end'];
    $waktu_pulang_start = $_POST['waktu_pulang_start'];
    $waktu_pulang_end = $_POST['waktu_pulang_end'];


    // Validasi 1: waktu_masuk_end harus lebih kecil dari waktu_pulang_start
    // Validasi 2: waktu_pulang_end harus lebih besar dari waktu_pulang_start
    if ($waktu_masuk_end >= $waktu_pulang_start) {
        echo "<script>
            alert('Waktu masuk akhir tidak boleh lebih besar atau sama dengan waktu pulang awal. Silakan periksa kembali waktu yang dimasukkan.');
            window.location.href = 'jam-operasional.php';
        </script>";
    } elseif ($waktu_pulang_end <= $waktu_pulang_start) {
        echo "<script>
            alert('Waktu pulang akhir tidak boleh lebih kecil atau sama dengan waktu pulang awal. Silakan periksa kembali waktu yang dimasukkan.');
            window.location.href = 'jam-operasional.php';
        </script>";
    } else {
        // Cek apakah data sudah ada
        $cek = $koneksi->query("SELECT id FROM operasional WHERE id=1");
        if ($cek->num_rows > 0) {
            // Data ada, lakukan UPDATE
            $sql = "UPDATE operasional SET waktu_masuk_start=?, waktu_masuk_end=?, waktu_pulang_start=?, waktu_pulang_end=? WHERE id=1";
            $stmt = $koneksi->prepare($sql);
            $stmt->bind_param('ssss', $waktu_masuk_start, $waktu_masuk_end, $waktu_pulang_start, $waktu_pulang_end);
        } else {
            // Data kosong, lakukan INSERT
            $sql = "INSERT INTO operasional (id, waktu_masuk_start, waktu_masuk_end, waktu_pulang_start, waktu_pulang_end) VALUES (1, ?, ?, ?, ?)";
            $stmt = $koneksi->prepare($sql);
            $stmt->bind_param('ssss', $waktu_masuk_start, $waktu_masuk_end, $waktu_pulang_start, $waktu_pulang_end);
        }

        if ($stmt->execute()) {
            echo "<script>
                alert('Jam Operasional Kerja Berhasil Disimpan!');
                window.location.href = 'jam-operasional.php';
            </script>";
        } else {
            echo "<script>alert('Gagal Disimpan');
            window.location.href = 'jam-operasional.php';
            </script>";
        }
        $stmt->close();
    }
}
$koneksi->close();
