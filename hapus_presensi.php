<?php
include 'koneksi.php';

$id = $_GET['id'];
$hapus = mysqli_query($koneksi, "DELETE FROM presensi WHERE id='$id'");

if ($hapus) {
    echo "
    <script>
    alert('Data Berhasil Dihapus');
    document.location.href = 'rekapitulasi.php';
    </script>
    ";
} else {
    echo "
    <script>
    alert('Data Gagal Dihapus');
    document.location.href = 'rekapitulasi.php';
    </script>
    ";
}
