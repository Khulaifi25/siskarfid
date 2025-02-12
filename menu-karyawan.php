<?php
// Cek apakah sesi sudah dimulai
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>

<div class="dlabnav">
    <div class="dlabnav-scroll">
        <ul class="metismenu" id="menu">
            <li class="dropdown header-profile">
                <a class="nav-link" href="javascript:void(0);" role="button" data-bs-toggle="dropdown">
                    <img src="images/user.png" width="20" alt="">
                    <div class="header-info ms-3">
                        <?php
                        $nama = $_SESSION['nama'];
                        $nama_singkat = strlen($nama) > 10 ? substr($nama, 0, 10) . '...' : $nama;
                        ?>
                        <span class="font-w600 ">Hi,<b><?php echo $nama_singkat ?></b></span>
                        <small class="text-start font-w400">UID: <?php echo $_SESSION['id_card'] ?></small>
                    </div>
                </a>
                <div class="dropdown-menu dropdown-menu-end">
                    <a href="profile_karyawan.php" class="dropdown-item ai-icon">
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
            <li><a href="home_karyawan.php" aria-expanded="false">
                    <i class="flaticon-046-home"></i>
                    <span class="nav-text">Home</span>
                </a>
            </li>
            <li><a href="profile_karyawan.php" aria-expanded="false">
                    <i class="flaticon-381-user-8"></i>
                    <span class="nav-text">Profile</span>
                </a>
            </li>
            <li><a href="absensi.php" aria-expanded="false">
                    <i class="flaticon-041-graph"></i>
                    <span class="nav-text">Realtime Presensi</span>
                </a>
            </li>
            <li><a href="scan_view.php" class="ai-icon" aria-expanded="false" target="_blank">
                    <i class="flaticon-381-wifi-2"></i>
                    <span class="nav-text">Scan Kartu</span>
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