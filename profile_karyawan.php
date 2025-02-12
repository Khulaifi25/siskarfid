<?php
include "koneksi.php";
// Cek apakah sesi sudah dimulai
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if (!isset($_SESSION['level']) || ($_SESSION['level'] != 'admin' && $_SESSION['level'] != 'karyawan')) {
    echo "<script>alert('Maaf, Halaman ini hanya untuk Administrator dan Karyawan!');document.location.href='signin.php'</script>";
    exit();
}


// Edit data
// Membaca Id yang akan diedit
// Mendapatkan id dari URL atau session
if ($_SESSION['level'] == 'admin' && isset($_GET['id'])) {
    $id = $_GET['id']; // Admin dapat melihat berdasarkan 'id' di URL
} else {
    $id = $_SESSION['id']; // Karyawan hanya bisa melihat profil mereka sendiri
}

// Query untuk mendapatkan data dari tabel
$sql = "SELECT * FROM karyawan WHERE id='$id'";
$query = mysqli_query($koneksi, $sql);
// Cek apakah data ditemukan
if (!$query || mysqli_num_rows($query) == 0) {
    echo "<script>alert('Data tidak ditemukan!');document.location.href='rekapitulasi.php'</script>";
    exit();
}
$hasil = mysqli_fetch_array($query);

// Proses Update
if (isset($_POST['btnSubmit'])) {
    $id_card = isset($_POST['id_card']) ? $_POST['id_card'] : '';
    $pass_baru = md5($_POST['pass_baru']);
    $konfirmasi_password = md5($_POST['konfirmasi_password']);
    $nama = $_POST['nama'];
    $job = $_POST['job'];
    $gender = isset($_POST['gender']) ? $_POST['gender'] : '';

    // Cek apakah password baru diisi
    if (!empty($_POST['pass_baru']) && !empty($_POST['konfirmasi_password'])) {
        // Cek Password Baru dan Konfirmasi Password
        if ($pass_baru != $konfirmasi_password) {
            echo "<script>alert('Password Baru dan Konfirmasi Password Tidak Sama!')</script>";
        } else {
            // Update Data dengan Password Baru
            $simpan = "UPDATE karyawan SET password='$pass_baru', id_card='$id_card', nama='$nama', job='$job', gender='$gender' WHERE id='$id'";
            $q = mysqli_query($koneksi, $simpan);
            if ($q) {
                echo "<script>alert('Data dan Password Berhasil Diupdate!')</script>";
                echo "<script>document.location.href='profile_karyawan.php'</script>";
            } else {
                echo "<script>alert('Data Gagal Diupdate!')</script>";
            }
        }
    } else {
        // Update Data tanpa Password Baru
        $simpan = "UPDATE karyawan SET id_card='$id_card', nama='$nama', job='$job', gender='$gender' WHERE id='$id'";
        $q = mysqli_query($koneksi, $simpan);
        if ($q) {
            echo "<script>alert('Data Berhasil Diupdate!')</script>";
            echo "<script>document.location.href='profile_karyawan.php'</script>";
        } else {
            echo "<script>alert('Data Gagal Diupdate!')</script>";
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    include 'navbar.php'; ?>
    <link href="vendor/datatables/css/jquery.dataTables.min.css" rel="stylesheet">
    <title>Menu Utama</title>
</head>

<body>

    <!--*******************
        Preloader start
    ********************-->
    <div id="preloader">
        <div class="waviy">
            <span style="--i:1">L</span>
            <span style="--i:2">o</span>
            <span style="--i:3">a</span>
            <span style="--i:4">d</span>
            <span style="--i:5">i</span>
            <span style="--i:6">n</span>
            <span style="--i:7">g</span>
            <span style="--i:8">.</span>
            <span style="--i:9">.</span>
            <span style="--i:10">.</span>
        </div>
    </div>
    <!--*******************
        Preloader end
    ********************-->

    <!--**********************************
        Main wrapper start
    ***********************************-->
    <div id="main-wrapper">

        <!--**********************************
            Nav header start
        ***********************************-->
        <div class="nav-header">
            <a href="home_karyawan.php" class="brand-logo">
                <svg fill="#000000" width="50px" height="50px" viewBox="0 0 24 24" id="barcode-scan" data-name="Line Color" xmlns="http://www.w3.org/2000/svg" class="icon line-color">
                    <path id="secondary" d="M4,12H20M8,7V8m4-1V8M8,17V16m8-9V8m0,9V16m-4,1V16" style="fill: none; stroke: rgb(44, 169, 188); stroke-linecap: round; stroke-linejoin: round; stroke-width: 2;"></path>
                    <path id="primary" d="M3,8V4A1,1,0,0,1,4,3H8" style="fill: none; stroke: rgb(0, 0, 0); stroke-linecap: round; stroke-linejoin: round; stroke-width: 2;"></path>
                    <path id="primary-2" data-name="primary" d="M21,8V4a1,1,0,0,0-1-1H16" style="fill: none; stroke: rgb(0, 0, 0); stroke-linecap: round; stroke-linejoin: round; stroke-width: 2;"></path>
                    <path id="primary-3" data-name="primary" d="M3,16v4a1,1,0,0,0,1,1H8" style="fill: none; stroke: rgb(0, 0, 0); stroke-linecap: round; stroke-linejoin: round; stroke-width: 2;"></path>
                    <path id="primary-4" data-name="primary" d="M16,21h4a1,1,0,0,0,1-1V16" style="fill: none; stroke: rgb(0, 0, 0); stroke-linecap: round; stroke-linejoin: round; stroke-width: 2;"></path>
                </svg>
                <svg class="brand-title" width="124px" height="33px">
                    <path class="svg-title-path" fill-rule="evenodd" fill="rgb(25, 59, 98)" d="M 58.4 28.32 L 67.04 28.32 L 67.04 18.04 L 73.36 28.32 L 83.88 28.32 L 74.04 13.48 L 82.8 0.32 L 73.72 0.32 L 67.04 11.08 L 67.04 0.32 L 58.4 0.32 L 58.4 28.32 Z M 12.96 8.92 L 19.96 5.92 C 18.44 2.44 14.68 0 10.8 0 C 4.725 0 1.281 4.036 0.947 8.072 A 7.845 7.845 0 0 0 0.92 8.72 A 7.97 7.97 0 0 0 1.285 11.181 C 2.415 14.688 5.939 16.065 8.537 16.963 A 116.14 116.14 0 0 1 9.8 17.4 A 23.917 23.917 0 0 0 9.806 17.403 C 11.204 17.922 12.48 18.282 12.48 19.36 C 12.48 20.28 11.64 20.96 10.56 20.96 A 3.428 3.428 0 0 1 9.709 20.858 C 8.753 20.613 8.177 19.977 7.981 19.432 A 1.342 1.342 0 0 1 7.92 19.2 L 0 21.12 A 9.641 9.641 0 0 0 5.885 27.732 A 12.47 12.47 0 0 0 10.64 28.64 A 12.061 12.061 0 0 0 15.703 27.596 A 8.457 8.457 0 0 0 20.8 19.68 A 8.572 8.572 0 0 0 20.501 17.361 C 19.55 13.96 16.512 12.628 14.125 11.733 A 5113.316 5113.316 0 0 0 13.12 11.36 C 12.169 11.033 10.224 10.544 9.553 9.673 A 1.025 1.025 0 0 1 9.32 9.04 A 1.306 1.306 0 0 1 10.227 7.788 A 1.926 1.926 0 0 1 10.88 7.68 C 11.84 7.68 12.64 8.16 12.96 8.92 Z M 47.36 8.92 L 54.36 5.92 C 52.84 2.44 49.08 0 45.2 0 C 39.125 0 35.681 4.036 35.347 8.072 A 7.845 7.845 0 0 0 35.32 8.72 A 7.97 7.97 0 0 0 35.685 11.181 C 36.815 14.688 40.339 16.065 42.937 16.963 A 116.14 116.14 0 0 1 44.2 17.4 A 23.917 23.917 0 0 0 44.206 17.403 C 45.604 17.922 46.88 18.282 46.88 19.36 C 46.88 20.28 46.04 20.96 44.96 20.96 A 3.428 3.428 0 0 1 44.109 20.858 C 43.153 20.613 42.577 19.977 42.381 19.432 A 1.342 1.342 0 0 1 42.32 19.2 L 34.4 21.12 A 9.641 9.641 0 0 0 40.285 27.732 A 12.47 12.47 0 0 0 45.04 28.64 A 12.061 12.061 0 0 0 50.103 27.596 A 8.457 8.457 0 0 0 55.2 19.68 A 8.572 8.572 0 0 0 54.901 17.361 C 53.95 13.96 50.912 12.628 48.525 11.733 A 5113.316 5113.316 0 0 0 47.52 11.36 C 46.569 11.033 44.624 10.544 43.953 9.673 A 1.025 1.025 0 0 1 43.72 9.04 A 1.306 1.306 0 0 1 44.627 7.788 A 1.926 1.926 0 0 1 45.28 7.68 C 46.24 7.68 47.04 8.16 47.36 8.92 Z M 84.28 28.32 L 93.32 28.32 L 95 23.24 L 104.44 23.24 L 106.08 28.32 L 115.16 28.32 L 104.4 0.32 L 95.04 0.32 L 84.28 28.32 Z M 23.76 28.32 L 31.44 28.32 L 31.44 10.08 L 23.76 10.08 L 23.76 28.32 Z M 23.6 4.28 C 23.6 6.52 25.4 8.32 27.6 8.32 C 29.8 8.32 31.6 6.52 31.6 4.28 C 31.6 2.08 29.8 0.28 27.6 0.28 C 25.4 0.28 23.6 2.08 23.6 4.28 Z M 97 17.16 L 99.72 8.84 L 102.44 17.16 L 97 17.16 Z" vector-effect="non-scaling-stroke" />
                    </path>
                </svg>
            </a>
            <div class="nav-control">
                <div class="hamburger">
                    <span class="line"></span><span class="line"></span><span class="line"></span>
                </div>
            </div>
        </div>
        <!--**********************************
            Nav header end
        ***********************************-->

        <!--**********************************
            Header start
        ***********************************-->
        <div class="header">
            <div class="header-content">
                <nav class="navbar navbar-expand">
                    <div class="collapse navbar-collapse justify-content-between">
                        <div class="header-left">
                            <div class="dashboard_bar">
                                SISKA RFID (UID : <?php echo $_SESSION['id_card'] ?>)
                            </div>
                        </div>
                    </div>
                </nav>
            </div>
        </div>
        <!--**********************************
            Header end ti-comment-alt
        ***********************************-->

        <!--**********************************
            Sidebar start
        ***********************************-->
        <?php
        if ($_SESSION['level'] == 'admin') {
            include 'menu.php';
        } elseif ($_SESSION['level'] == 'karyawan') {
            include 'menu-karyawan.php';
        }
        ?>
        <!--**********************************
            Sidebar end
        ***********************************-->

        <!--**********************************
            Content body start
        ***********************************-->
        <div class="content-body">
            <!-- row -->
            <!-- Koneksi hitung user -->
            <?php
            include 'koneksi.php';

            ?>

            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="profile card card-body px-3 pt-3 pb-0">
                            <div class="profile-head">
                                <div class="photo-content">
                                    <div class="cover-photo rounded"></div>
                                </div>
                                <div class="profile-info">
                                    <div class="profile-photo">
                                        <img src="images/user.png" class="img-fluid rounded-circle" alt="">
                                    </div>
                                    <div class="profile-details">
                                        <div class="profile-name px-3 pt-2">
                                            <h4 class="text-primary mb-0"><?php echo $hasil['nama']  ?></h4>
                                            <p>Job : <?php echo $hasil['job']  ?></p>
                                        </div>
                                        <div class="profile-email px-2 pt-2">
                                            <h4 class="text-muted mb-1"><?php echo $hasil['id_card'] ?></h4>
                                            <a href="#" onclick="copyToClipboard('<?php echo htmlspecialchars($hasil['id_card'], ENT_QUOTES, 'UTF-8'); ?>'); return false;" class="btn btn-primary light sharp mb-1">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                    <rect x="9" y="9" width="13" height="13" rx="2" ry="2"></rect>
                                                    <path d="M5 15H4a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h9a2 2 0 0 1 2 2v1"></path>
                                                </svg>
                                            </a>
                                            <p>UID</p>
                                        </div>
                                        <div class="dropdown ms-auto">
                                            <a href="#" class="btn btn-primary light sharp" data-bs-toggle="dropdown" aria-expanded="true"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="18px" height="18px" viewbox="0 0 24 24" version="1.1">
                                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                        <rect x="0" y="0" width="24" height="24"></rect>
                                                        <circle fill="#000000" cx="5" cy="12" r="2"></circle>
                                                        <circle fill="#000000" cx="12" cy="12" r="2"></circle>
                                                        <circle fill="#000000" cx="19" cy="12" r="2"></circle>
                                                    </g>
                                                </svg></a>
                                            <ul class="dropdown-menu dropdown-menu-end">
                                                <li class="dropdown-item">
                                                    <a href="logout.php"><svg id="icon-logout" xmlns="http://www.w3.org/2000/svg" class="text-danger" width="18" height="18" viewbox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                            <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
                                                            <polyline points="16 17 21 12 16 7"></polyline>
                                                            <line x1="21" y1="12" x2="9" y2="12"></line>
                                                        </svg>
                                                    </a> Logout
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xl-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="profile-tab">
                                    <div class="custom-tab-1">
                                        <ul class="nav nav-tabs">
                                            <li class="nav-item"><a href="#my-posts" data-bs-toggle="tab" class="nav-link active show">History</a>
                                            </li>
                                            <li class="nav-item"><a href="#about-me" data-bs-toggle="tab" class="nav-link">About Me</a>
                                            </li>
                                            <li class="nav-item"><a href="#profile-settings" data-bs-toggle="tab" class="nav-link">Setting</a>
                                            </li>
                                        </ul>
                                        <div class="tab-content">
                                            <div id="my-posts" class="tab-pane fade active show">
                                                <div class="my-post-content pt-3">
                                                    <h4 class="text-primary mb-4">Histori Presensi</h4>
                                                    <div class="class-informaton">
                                                        <!-- Filter data -->
                                                        <div class="row">
                                                            <div class="col-sm-6">
                                                                <form method="POST" class="form-inline d-flex justify-content-between gap-3 flex-wrap">
                                                                    <input type="date" name="tgl_mulai" class="form-control">
                                                                    <input type="date" name="tgl_selesai" class="form-control">
                                                                    <button type="submit" class="btn btn-primary mb-3" name="filter-tgl">Filter</button>
                                                                    <a href="profile_karyawan.php"><button type="button" class="btn btn-danger mb-3">Reset</button></a>

                                                                </form>
                                                            </div>
                                                            <div class="mb-3 col-md-4">
                                                                <h4 class="mb-3 mt-2 font-w600">Informasi Presensi</h4>
                                                                <div class="mb-3 col-md-6">
                                                                    <?php
                                                                    if ($_SESSION['level'] == 'admin' && isset($_GET['id'])) {
                                                                        $id = $_GET['id'];  // Admin memilih karyawan berdasarkan id
                                                                        // Ambil id_card dari tabel karyawan berdasarkan id
                                                                        $sql_id_card = mysqli_query($koneksi, "SELECT id_card FROM karyawan WHERE id = '$id'");
                                                                        $data_id_card = mysqli_fetch_assoc($sql_id_card);
                                                                        $id_card = $data_id_card['id_card'];  // Ambil id_card dari hasil query
                                                                    } else {
                                                                        // Jika karyawan, ambil id_card dari session
                                                                        $id_card = $_SESSION['id_card'];
                                                                    }

                                                                    if (isset($_POST['filter-tgl'])) {
                                                                        $tgl_mulai = $_POST['tgl_mulai'];
                                                                        $tgl_selesai = $_POST['tgl_selesai'];
                                                                        $sql_tepat_waktu = mysqli_query($koneksi, "SELECT COUNT(*) AS total_tepat_waktu FROM presensi WHERE id_card='$id_card' AND status='Tepat Waktu' AND tanggal BETWEEN '$tgl_mulai' AND '$tgl_selesai'");
                                                                        $sql_terlambat = mysqli_query($koneksi, "SELECT COUNT(*) AS total_terlambat FROM presensi WHERE id_card='$id_card' AND status='Terlambat' AND tanggal BETWEEN '$tgl_mulai' AND '$tgl_selesai'");
                                                                        $sql_pulang_tepat = mysqli_query($koneksi, "SELECT COUNT(*) AS total_pulang_tepat FROM presensi WHERE id_card='$id_card' AND status_pulang='Tepat Waktu' AND tanggal BETWEEN '$tgl_mulai' AND '$tgl_selesai'");
                                                                        $sql_pulang_absen = mysqli_query($koneksi, "SELECT COUNT(*) AS total_pulang_absen FROM presensi WHERE id_card='$id_card' AND status_pulang='Belum Presensi' AND tanggal BETWEEN '$tgl_mulai' AND '$tgl_selesai'");
                                                                    } else {
                                                                        $sql_tepat_waktu = mysqli_query($koneksi, "SELECT COUNT(*) AS total_tepat_waktu FROM presensi WHERE id_card='$id_card' AND status='Tepat Waktu'");
                                                                        $sql_terlambat = mysqli_query($koneksi, "SELECT COUNT(*) AS total_terlambat FROM presensi WHERE id_card='$id_card' AND status='Terlambat'");
                                                                        $sql_pulang_tepat = mysqli_query($koneksi, "SELECT COUNT(*) AS total_pulang_tepat FROM presensi WHERE id_card='$id_card' AND status_pulang='Tepat Waktu'");
                                                                        $sql_pulang_absen = mysqli_query($koneksi, "SELECT COUNT(*) AS total_pulang_absen FROM presensi WHERE id_card='$id_card' AND status_pulang='Belum Presensi'");
                                                                    }
                                                                    $data_tepat_waktu = mysqli_fetch_array($sql_tepat_waktu);
                                                                    $data_terlambat = mysqli_fetch_array($sql_terlambat);
                                                                    $data_pulang_tepat = mysqli_fetch_array($sql_pulang_tepat);
                                                                    $data_pulang_absen = mysqli_fetch_array($sql_pulang_absen);
                                                                    ?>
                                                                    <label class="form-label">Masuk (Tepat Waktu) : <?php echo $data_tepat_waktu['total_tepat_waktu']; ?></label>
                                                                </div>
                                                                <div class="mb-3 col-md-6">
                                                                    <label class="form-label">Masuk (Terlambat) : <?php echo $data_terlambat['total_terlambat']; ?></label>
                                                                </div>
                                                                <div class="mb-3 col-md-6">
                                                                    <label class="form-label">Pulang (Tepat Waktu) : <?php echo $data_pulang_tepat['total_pulang_tepat']; ?></label>
                                                                </div>
                                                                <div class="mb-3 col-md-6">
                                                                    <label class="form-label">Pulang (Belum Presensi) : <?php echo $data_pulang_absen['total_pulang_absen']; ?></label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <!-- Tabel data -->
                                                    <div class="table-responsive mt-4">
                                                        <table id="example4" class="display" style="min-width: 845px">
                                                            <div class="d-flex justify-content-between mb-3">
                                                                <a class="btn btn-dark light me-3" onclick="printTable()"><i class="las la-print me-3 scale5"></i>Cetak</a>
                                                            </div>
                                                            <thead>
                                                                <tr>
                                                                    <th>No</th>
                                                                    <th>Tanggal</th>
                                                                    <th>Nama</th>
                                                                    <th>Masuk</th>
                                                                    <th>Pulang</th>
                                                                    <th>Status Masuk</th>
                                                                    <th>Status Pulang</th>
                                                                    <th>Aktivitas</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?php
                                                                include "koneksi.php";

                                                                if ($_SESSION['level'] == 'admin' && isset($_GET['id'])) {
                                                                    $id = $_GET['id'];  // Admin memilih karyawan berdasarkan id
                                                                    // Ambil id_card dari tabel karyawan berdasarkan id
                                                                    $sql_id_card = mysqli_query($koneksi, "SELECT id_card FROM karyawan WHERE id = '$id'");
                                                                    $data_id_card = mysqli_fetch_assoc($sql_id_card);
                                                                    $id_card = $data_id_card['id_card'];  // Ambil id_card dari hasil query
                                                                } else {
                                                                    // Jika karyawan, ambil id_card dari session
                                                                    $id_card = $_SESSION['id_card'];
                                                                }
                                                                $no = 0;

                                                                if (isset($_POST['filter-tgl'])) {
                                                                    $tgl_mulai = $_POST['tgl_mulai'];
                                                                    $tgl_selesai = $_POST['tgl_selesai'];

                                                                    $sql = mysqli_query($koneksi, "SELECT * FROM presensi WHERE id_card='$id_card' AND tanggal BETWEEN '$tgl_mulai' AND '$tgl_selesai' ORDER BY id DESC");
                                                                } else {
                                                                    $sql = mysqli_query($koneksi, "SELECT * FROM presensi WHERE id_card='$id_card' ORDER BY id DESC");
                                                                }

                                                                while ($data = mysqli_fetch_array($sql)) {
                                                                    $no++;
                                                                ?>
                                                                    <tr>
                                                                        <td><?php echo $no; ?></td>
                                                                        <td><?php echo date('d-m-Y', strtotime($data['tanggal'])); ?></td>
                                                                        <td><?php echo $data['nama'] ?></td>
                                                                        <td><?php echo $data['jam_masuk'] ?></td>
                                                                        <td><?php echo $data['jam_pulang'] ?></td>
                                                                        <td>
                                                                            <?php
                                                                            if ($data['status'] == 'Tepat Waktu') {
                                                                                echo '<span class="badge light badge-success">Tepat Waktu</span>';
                                                                            } elseif ($data['status'] == 'Terlambat') {
                                                                                echo '<span class="badge light badge-danger">Terlambat</span>';
                                                                            } else {
                                                                                echo $data['status'];
                                                                            }
                                                                            ?>
                                                                        </td>
                                                                        <td>
                                                                            <?php
                                                                            if ($data['status_pulang'] == 'Tepat Waktu') {
                                                                                echo '<span class="badge light badge-success">Tepat Waktu</span>';
                                                                            } elseif ($data['status_pulang'] == 'Belum Presensi') {
                                                                                echo '<span class="badge light badge-info">Belum Presensi</span>';
                                                                            } else {
                                                                                echo $data['status_pulang'];
                                                                            }
                                                                            ?>
                                                                        </td>
                                                                        <?php
                                                                        if ($data['jam_pulang'] != '00:00:00') {
                                                                            echo '<td><span class="badge light badge-danger">Pulang</span></td>';
                                                                        } elseif ($data['jam_masuk'] != '00:00:00') {
                                                                            echo '<td><span class="badge light badge-success">Masuk</span></td>';
                                                                        } else {
                                                                            echo '<td><span class="badge light badge-info">Tidak Absen</span></td>';
                                                                        }
                                                                        ?>

                                                                    </tr>
                                                                <?php } ?>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                            <div id="about-me" class="tab-pane fade">
                                                <div class="profile-personal-info mt-4">
                                                    <h4 class="text-primary mb-4">Personal Information</h4>
                                                    <div class="row mb-2">
                                                        <div class="col-sm-3 col-5">
                                                            <h5 class="f-w-500">Nama <span class="pull-end">:</span>
                                                            </h5>
                                                        </div>
                                                        <div class="col-sm-9 col-7"><span><?php echo $hasil['nama']  ?></span>
                                                        </div>
                                                    </div>
                                                    <div class="row mb-2">
                                                        <div class="col-sm-3 col-5">
                                                            <h5 class="f-w-500">UID <span class="pull-end">:</span>
                                                            </h5>
                                                        </div>
                                                        <div class="col-sm-9 col-7"><span><?php echo $hasil['id_card']  ?></span>
                                                        </div>
                                                    </div>
                                                    <div class="row mb-2">
                                                        <div class="col-sm-3 col-5">
                                                            <h5 class="f-w-500">Job <span class="pull-end">:</span></h5>
                                                        </div>
                                                        <div class="col-sm-9 col-7"><span><?php echo $hasil['job']  ?></span>
                                                        </div>
                                                    </div>
                                                    <div class="row mb-2">
                                                        <div class="col-sm-3 col-5">
                                                            <h5 class="f-w-500">Gender <span class="pull-end">:</span>
                                                            </h5>
                                                        </div>
                                                        <div class="col-sm-9 col-7"><span><?php echo $hasil['gender']  ?></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div id="profile-settings" class="tab-pane fade">
                                                <div class="pt-3">
                                                    <div class="settings-form">
                                                        <h4 class="text-primary">Account Setting</h4>
                                                        <form method="post" action="">
                                                            <div class="mb-3">
                                                                <label class="form-label">UID</label>
                                                                <input type="text" placeholder="Masukkan Nomor ID Card" value="<?php echo $hasil['id_card']; ?>" class="form-control" readonly>
                                                                <input type="hidden" name="id_card" value="<?php echo $hasil['id_card']; ?>">
                                                            </div>
                                                            <div class="row">
                                                                <div class="mb-3 col-md-4">
                                                                    <label class="form-label">Password Baru</label>
                                                                    <input type="password" name="pass_baru" placeholder="Masukkan Password Baru" class="form-control" id="pass_baru">
                                                                    <input type="checkbox" class="form-check-input mt-2" id="show_pass_baru" onclick="togglePassword('pass_baru')">
                                                                    <label class="form-check-label mt-2" for="show_pass_baru">Show Password</label>
                                                                </div>
                                                                <div class="mb-3 col-md-4">
                                                                    <label class="form-label">Konfirmasi Password Baru</label>
                                                                    <input type="password" name="konfirmasi_password" placeholder="Masukkan Password" class="form-control" id="konfirmasi_password">
                                                                    <input type="checkbox" class="form-check-input mt-2" id="show_konfirmasi_password" onclick="togglePassword('konfirmasi_password')">
                                                                    <label class="form-check-label mt-2" for="show_konfirmasi_password">Show Password</label>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="mb-3 col-md-6">
                                                                    <label class="form-label">Nama Lengkap</label>
                                                                    <input type="text" placeholder="Masukkan Nama Lengkap" value="<?php echo $hasil['nama']; ?>" class="form-control" id="nama" name="nama">
                                                                </div>
                                                                <div class="mb-3 col-md-6">
                                                                    <label class="form-label">Job</label>
                                                                    <select name="job" id="job" class="form-control default-select wide" disabled>
                                                                        <option value="Karyawan" <?php if ($hasil['job'] == 'Karyawan') echo 'selected'; ?>>Karyawan</option>
                                                                        <option value="Staff" <?php if ($hasil['job'] == 'Staff') echo 'selected'; ?>>Staff</option>
                                                                        <option value="Administrator" <?php if ($hasil['job'] == 'Administrator') echo 'selected'; ?>>Administrator</option>
                                                                    </select>
                                                                    <input type="hidden" name="job" value="<?php echo $hasil['job']; ?>">
                                                                </div>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label class="form-label">Gender</label>
                                                                <div class="col-sm-9">
                                                                    <div class="form-check">
                                                                        <input class="form-check-input" type="radio" name="gender" id="gender" value="Laki-Laki" <?php echo ($hasil['gender'] == 'Laki-Laki') ? 'checked' : ''; ?> disabled>
                                                                        <label class="form-check-label">
                                                                            Laki-Laki
                                                                        </label>
                                                                    </div>
                                                                    <div class="form-check">
                                                                        <input class="form-check-input" type="radio" name="gender" id="gender" value="Perempuan" <?php echo ($hasil['gender'] == 'Perempuan') ? 'checked' : ''; ?> disabled>
                                                                        <label class="form-check-label">
                                                                            Perempuan
                                                                        </label>
                                                                    </div>
                                                                    <input type="hidden" name="gender" value="<?php echo $hasil['gender']; ?>">
                                                                </div>
                                                            </div>
                                                            <button class="btn btn-primary" type="submit" name="btnSubmit" id="btnSubmit">Update</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--**********************************
            Content body end
        ***********************************-->

        <!--**********************************
            Footer start
        ***********************************-->
        <div class="footer">
            <?php
            include 'footer.php'; ?>
        </div>
        <!--********</div>**************************
            Footer end
        ***********************************-->




    </div>
    <!--**********************************
        Main wrapper end
    ***********************************-->

    <!--**********************************
        Scripts
    ***********************************-->
    <!-- Required vendors -->
    <script src="vendor/global/global.min.js"></script>
    <script src="vendor/chart.js/Chart.bundle.min.js"></script>
    <script src="vendor/jquery-nice-select/js/jquery.nice-select.min.js"></script>

    <!-- Apex Chart -->
    <script src="vendor/apexchart/apexchart.js"></script>
    <script src="vendor/nouislider/nouislider.min.js"></script>
    <script src="vendor/wnumb/wNumb.js"></script>

    <!-- Datatable -->
    <script src="vendor/datatables/js/jquery.dataTables.min.js"></script>
    <script src="js/plugins-init/datatables.init.js"></script>


    <!-- Dashboard 1 -->
    <script src="js/dashboard/dashboard-1.js"></script>

    <script src="js/custom.min.js"></script>
    <script src="js/dlabnav-init.js"></script>
    <script src="js/demo.js"></script>
    <script src="js/styleSwitcher.js"></script>

    <script>
        function copyToClipboard(text) {
            if (!navigator.clipboard) {
                // Fallback untuk browser yang tidak mendukung navigator.clipboard
                const tempInput = document.createElement("textarea");
                tempInput.value = text;
                document.body.appendChild(tempInput);
                tempInput.select();
                try {
                    document.execCommand("copy");
                    alert("UID tersalin ke papan klip");
                } catch (err) {
                    alert("Gagal menyalin UID");
                }
                document.body.removeChild(tempInput);
                return;
            }

            // Untuk browser modern dengan dukungan navigator.clipboard
            navigator.clipboard.writeText(text).then(function() {
                alert("UID tersalin ke papan klip");
            }).catch(function(err) {
                alert("Gagal menyalin UID: " + err);
            });
        }
    </script>

    <script>
        function printTable() {
            let table = document.getElementById('example4').outerHTML;
            let newWindow = window.open('', '', 'width=800, height=600');
            newWindow.document.write('<html><head><title>Cetak Tabel</title>');
            newWindow.document.write('<link rel="stylesheet" href="vendor/datatables/css/jquery.dataTables.min.css">');
            newWindow.document.write('<link rel="stylesheet" href="css/style2.css">');
            newWindow.document.write('</head><body>');
            newWindow.document.write('<h1 class="text-center m-0 fw-bold">CV Mulia Abadi</h1>');
            newWindow.document.write('<h5 class="text-center mt-1 fw-bold">Jl. Raya Jepara - Kudus KM.5</h5>');
            let date = new Date();
            let dateString = date.toLocaleDateString('en-GB');
            newWindow.document.write('<p class="fw-italic">Dicetak pada: ' + dateString + ' ' + date.toLocaleTimeString('en-GB') + ' </p>');
            newWindow.document.write('<p> Masuk: <?php echo $data_tepat_waktu['total_tepat_waktu']; ?> &emsp; | &emsp; Masuk (Terlambat): <?php echo $data_terlambat['total_terlambat']; ?> &emsp; | &emsp; Pulang: <?php echo $data_pulang_tepat['total_pulang_tepat']; ?> &emsp; | &emsp; Pulang (Absen): <?php echo $data_pulang_absen['total_pulang_absen']; ?>');
            newWindow.document.write(table);
            newWindow.document.write('<div class="text-right mt-2">');
            newWindow.document.write('<p><strong>Nama Direktur</strong></p>');
            newWindow.document.write('<br><br><br>');
            newWindow.document.write('<p>Direktur</p>');
            newWindow.document.write('</div>');
            newWindow.document.write('</body></html>');
            newWindow.document.close();
            newWindow.print();
        }
    </script>


    <script>
        function togglePassword(id) {
            var x = document.getElementById(id);
            if (x.type === "password") {
                x.type = "text";
            } else {
                x.type = "password";
            }
        }
    </script>

</body>

</html>