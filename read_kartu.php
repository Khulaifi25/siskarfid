<?php include 'navbar.php'; ?>

<?php

include "koneksi.php";

// Baca tabel operasional untuk jam masuk dan jam pulang
$sql_operasional = mysqli_query($koneksi, "SELECT * FROM operasional LIMIT 1");
$data_operasional = mysqli_fetch_array($sql_operasional);

// Ambil jam operasional
if ($data_operasional) {
    $waktu_masuk_start = $data_operasional['waktu_masuk_start'];
    $waktu_masuk_end = $data_operasional['waktu_masuk_end'];
    $waktu_pulang_start = $data_operasional['waktu_pulang_start'];
    $waktu_pulang_end = $data_operasional['waktu_pulang_end'];
} else {
    // Berikan default jika tabel operasional kosong
    $waktu_masuk_start = "08:00:00";
    $waktu_masuk_end = "09:00:00";
    $waktu_pulang_start = "16:00:00";
    $waktu_pulang_end = "17:00:00";
}

// Waktu sekarang
date_default_timezone_set('Asia/Jakarta');
$waktu_sekarang = date('H:i:s');

// Tentukan mode presensi berdasarkan waktu sekarang
$mode = "";
if ($waktu_sekarang >= $waktu_masuk_start && $waktu_sekarang <= $waktu_masuk_end) {
    $mode = "Masuk";
} elseif ($waktu_sekarang > $waktu_masuk_end && $waktu_sekarang < $waktu_pulang_start) {
    $mode = "Masuk (Terlambat)";
} elseif ($waktu_sekarang >= $waktu_pulang_start && $waktu_sekarang <= $waktu_pulang_end) {
    $mode = "Pulang";
} else {
    $mode = "Di Luar Jam Kerja";
}


// Baca tabel tmprfid
$baca_kartu = mysqli_query($koneksi, "SELECT * FROM tmprfid");
$data_kartu = mysqli_fetch_array($baca_kartu);
$id_card = isset($data_kartu['id_card']) ? $data_kartu['id_card'] : "";

?>

<div class="container-fluid text-center">

    <?php if ($id_card == "") { ?>
        <h3 class="fw-bold">Presensi : <?php echo $mode; ?></h3>
        <h2 class="fw-bold">Silahkan Tempelkan Kartu RFID</h2>
        <img style="width: 300px !important;" class="w-25 mt-3" src="images/rfid.svg"><br>
        <img style="width: 150px;" class="md-5" src="images/loader.gif">
    <?php } else {
        // Cek nomor kartu di tabel karyawan
        $cari_karyawan = mysqli_query($koneksi, "SELECT * FROM karyawan WHERE id_card='$id_card'");
        $jumlah_data = mysqli_num_rows($cari_karyawan);

        if ($jumlah_data == 0) {
            echo "<h3 class='fw-bold text-danger'>Maaf, Kartu Tidak Terdaftar!</h3>";
        } else {
            // Baca data karyawan
            $data_karyawan = mysqli_fetch_array($cari_karyawan);
            $nama = $data_karyawan['nama'];
            $job = $data_karyawan['job'];

            // Tanggal dan jam hari ini
            $tanggal = date('Y-m-d');
            $jam = date('H:i:s');

            // Tentukan status berdasarkan waktu presensi
            $status = "";
            if ($mode == "Masuk") {
                $status = "Tepat Waktu";
            } elseif ($mode == "Masuk (Terlambat)") {
                $status = "Terlambat";
            } elseif ($mode == "Pulang") {
                $status = "Tepat Waktu";
            }

            // Cek tabel presensi, apakah sudah ada data presensi hari ini
            $cari_presensi = mysqli_query($koneksi, "SELECT * FROM presensi WHERE id_card='$id_card' AND tanggal='$tanggal'");
            $jumlah_presensi = mysqli_num_rows($cari_presensi);

            if ($jumlah_presensi == 0) {
                // Jika belum ada data presensi hari ini
                if ($mode == "Masuk" || $mode == "Masuk (Terlambat)") {
                    echo "<h2 class='fw-bold'>Selamat Datang <br> $nama</h2>";
                    mysqli_query($koneksi, "INSERT INTO presensi (id_card, nama, job, tanggal, jam_masuk, status) 
                                            VALUES ('$id_card', '$nama', '$job', '$tanggal', '$jam', '$status')");
                } else {
                    echo "<h3 class='fw-bold text-danger'>Presensi Tidak Valid, Anda Belum Melakukan Presensi Masuk!</h3>";
                }
            } else {
                // Jika sudah ada data presensi hari ini
                $data_presensi = mysqli_fetch_array($cari_presensi);

                if ($mode == "Masuk" || $mode == "Masuk (Terlambat)") {
                    // Cek apakah jam masuk sudah tercatat
                    if (empty($data_presensi['jam_masuk']) || $data_presensi['jam_masuk'] == "00:00:00") {
                        echo "<h2 class='fw-bold'>Selamat Datang <br> $nama</h2>";
                        mysqli_query($koneksi, "UPDATE presensi SET jam_masuk='$jam', status='$status' 
                                                WHERE id_card='$id_card' AND tanggal='$tanggal'");
                    } else {
                        echo "<h2 class='fw-bold text-warning'>Anda sudah melakukan presensi masuk hari ini.</h2>";
                    }
                } elseif ($mode == "Pulang") {
                    // Cek apakah presensi masuk sudah tercatat sebelum memeriksa presensi pulang
                    if (!empty($data_presensi['jam_masuk']) && $data_presensi['jam_masuk'] != "00:00:00") {
                        // Cek apakah jam pulang sudah tercatat (periksa apakah jam pulang == '00:00:00')
                        if ($data_presensi['jam_pulang'] == "00:00:00") {
                            echo "<h2 class='fw-bold'>Selamat Jalan <br> $nama</h2>";
                            $status_pulang = ($jam <= $waktu_pulang_end) ? "Tepat Waktu" : "Belum Presensi";
                            mysqli_query($koneksi, "UPDATE presensi SET jam_pulang='$jam', status_pulang='$status_pulang' 
                                                    WHERE id_card='$id_card' AND tanggal='$tanggal'");
                        } else {
                            echo "<h2 class='fw-bold text-warning'>Anda sudah melakukan presensi pulang hari ini.</h2>";
                        }
                    } else {
                        echo "<h3 class='fw-bold text-danger'>Presensi Tidak Valid, Anda Belum Melakukan Presensi Masuk!</h3>";
                    }
                } else {
                    echo "<h3 class='fw-bold text-danger'>Presensi Tidak Valid, Anda Di Luar Jam Kerja!</h3>";
                }
            }
        }
        // Kosongkan tabel tmprfid
        mysqli_query($koneksi, "DELETE FROM tmprfid");
    } ?>
</div>