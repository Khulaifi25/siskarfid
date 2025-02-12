<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

include 'koneksi.php';
// Query untuk mendapatkan data dari tabel
$sql = "SELECT * FROM karyawan WHERE id='$id'";
$query = mysqli_query($koneksi, $sql);
$hasil = mysqli_fetch_array($query);


?>

<div class="dlabnav">
    <div class="dlabnav-scroll">
        <ul class="metismenu" id="menu">
            <li class="dropdown header-profile">
                <a class="nav-link" href="javascript:void(0);" role="button" data-bs-toggle="dropdown">
                    <img src="images/user.png" width="20" alt="">
                    <div class="header-info ms-3">
                        <?php
                        $nama = isset($_SESSION['nama']) ? $_SESSION['nama'] : $hasil['nama'];
                        $nama_singkat = strlen($nama) > 10 ? substr($nama, 0, 10) . '...' : $nama;
                        ?>
                        <span class="font-w600 ">Hi,<b><?php echo $nama_singkat ?></b></span>
                        <small class="text-start font-w400">UID: <?php echo isset($_SESSION['id_card']) ? $_SESSION['id_card'] : $hasil['id_card'] ?></small>
                    </div>
                </a>
                <div class="dropdown-menu dropdown-menu-end">
                    <a href="profile_admin.php" class="dropdown-item ai-icon">
                        <svg id="icon-user1" xmlns="http://www.w3.org/2000/svg" class="text-primary" width="18" height="18" viewbox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                            <circle cx="12" cy="7" r="4"></circle>
                        </svg>
                        <span class="ms-2">Profile </span>
                    </a>
                    <a href="logout.php" class="dropdown-item ai-icon">
                        <svg id="icon-logout" xmlns="http://www.w3.org/2000/svg" class="text-danger" width="18" height="18" viewbox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
                            <polyline points="16 17 21 12 16 7"></polyline>
                            <line x1="21" y1="12" x2="9" y2="12"></line>
                        </svg>
                        <span class="ms-2">Logout </span>
                    </a>
                </div>
            </li>
            <li><a href="home_admin.php" aria-expanded="false">
                    <i class="flaticon-046-home"></i>
                    <span class="nav-text">Home</span>
                </a>
            </li>
            <li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                    <i class="flaticon-381-user-8"></i>
                    <span class="nav-text">User Data</span>
                </a>
                <ul aria-expanded="false">
                    <li><a href="dataadmin.php">Data Admin</a></li>
                    <li><a href="datakaryawan.php">Data Karyawan</a></li>
                </ul>
            </li>
            <li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                    <i class="flaticon-041-graph"></i>
                    <span class="nav-text">Laporan</span>
                </a>
                <ul aria-expanded="false">
                    <li><a href="absensi.php">Realtime Presensi</a></li>
                    <li><a href="rekapitulasi.php">Rekapitulasi</a></li>
                    <li><a href="rekap-2.php">Rekap (Bulanan)</a></li>
                </ul>
            </li>
            <li><a href="profile_admin.php" class="ai-icon" aria-expanded="false">
                    <i class="flaticon-381-user-3"></i>
                    <span class="nav-text">Profile</span>
                </a>
            </li>
            <li><a href="jam-operasional.php" class="ai-icon" aria-expanded="false">
                    <i class="flaticon-381-eject"></i>
                    <span class="nav-text">Jam Operasional</span>
                </a>
            </li>
            <li><a href="scan.php" class="ai-icon" aria-expanded="false">
                    <i class="flaticon-381-wifi-2"></i>
                    <span class="nav-text">Scan Kartu</span>
                </a>
            </li>
            <li><a href="cetak.php" class="ai-icon" aria-expanded="false">
                    <i class="flaticon-072-printer"></i>
                    <span class="nav-text">Cetak Laporan</span>
                </a>
            </li>
            <li><a href="info-app.php" class="ai-icon" aria-expanded="false">
                    <i class="flaticon-050-info"></i>
                    <span class="nav-text">Info Apps</span>
                </a>
            </li>
        </ul>
    </div>
</div>