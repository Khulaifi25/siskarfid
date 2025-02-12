<?php
// Cek apakah sesi sudah dimulai
session_start();
if (!isset($_SESSION['level']) || $_SESSION['level'] != 'karyawan') {
    echo "<script>alert('Maaf, Halaman ini untuk Karyawan!');document.location.href='signin.php'</script>";
    exit();
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    include 'navbar.php'; ?>
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
        include 'menu-karyawan.php'; ?>
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

            //hitung semua data  admin dari column level
            $query_admin = "SELECT COUNT(*) as total_admin FROM karyawan WHERE level='admin'";
            $result_admin = mysqli_query($koneksi, $query_admin);
            $data_admin = mysqli_fetch_assoc($result_admin);
            $total_admin = $data_admin['total_admin'];

            //hitung semua data karyawan dari column level
            $query_karyawan = "SELECT COUNT(*) as total_karyawan FROM karyawan WHERE level='karyawan'";
            $result_karyawan = mysqli_query($koneksi, $query_karyawan);
            $data_karyawan = mysqli_fetch_assoc($result_karyawan);
            $total_karyawan = $data_karyawan['total_karyawan'];

            ?>

            <div class="container-fluid">
                <div class="row">
                    <div class="col-xl-6 col-xxl-12">
                        <div class="card">
                            <div class="card-header d-block d-sm-flex border-0">
                                <div class="me-3">
                                    <h4 class="card-title mb-2 fw-bold">Histori Kehadiran Terbaru</h4>
                                </div>

                            </div>
                            <div class="card-body tab-content p-0">
                                <div class="tab-pane active show fade" id="monthly" role="tabpanel">
                                    <div class="table-responsive">
                                        <table class="table table-responsive-md card-table transactions-table">
                                            <tbody>
                                                <?php
                                                include "koneksi.php";
                                                // Baca tanggal hari ini
                                                date_default_timezone_set('Asia/Jakarta');
                                                $tanggal = date('Y-m-d');
                                                // filter data berdasarkan tanggal hari ini
                                                $sql = mysqli_query($koneksi, "SELECT b.nama,
                                                b.job, a.tanggal, a.jam_masuk, a.jam_pulang 
                                                from presensi a, karyawan b WHERE a.id_card=b.id_card and a.tanggal='$tanggal' ORDER BY a.id DESC LIMIT 5");
                                                $no = 0;
                                                while ($data = mysqli_fetch_array($sql)) {
                                                    $no++;
                                                ?>
                                                    <tr>
                                                        <td>
                                                            <?php if ($data['jam_pulang'] != '00:00:00') { ?>
                                                                <svg class="bgl-danger tr-icon" width="63" height="63" viewbox="0 0 63 63" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                    <g>
                                                                        <path d="M35.2219 42.9875C34.8938 42.3094 35.1836 41.4891 35.8617 41.1609C37.7484 40.2531 39.3453 38.8422 40.4828 37.0758C41.6477 35.2656 42.2656 33.1656 42.2656 31C42.2656 24.7875 37.2125 19.7344 31 19.7344C24.7875 19.7344 19.7344 24.7875 19.7344 31C19.7344 33.1656 20.3523 35.2656 21.5117 37.0813C22.6437 38.8477 24.2461 40.2586 26.1328 41.1664C26.8109 41.4945 27.1008 42.3094 26.7727 42.993C26.4445 43.6711 25.6297 43.9609 24.9461 43.6328C22.6 42.5063 20.6148 40.7563 19.2094 38.5578C17.7656 36.3047 17 33.6906 17 31C17 27.2594 18.4547 23.743 21.1016 21.1016C23.743 18.4547 27.2594 17 31 17C34.7406 17 38.257 18.4547 40.8984 21.1016C43.5453 23.7484 45 27.2594 45 31C45 33.6906 44.2344 36.3047 42.7852 38.5578C41.3742 40.7508 39.3891 42.5063 37.0484 43.6328C36.3648 43.9555 35.55 43.6711 35.2219 42.9875Z" fill="#F46A6A"></path>
                                                                        <path d="M36.3211 31.7274C36.5891 31.9953 36.7203 32.3453 36.7203 32.6953C36.7203 33.0453 36.5891 33.3953 36.3211 33.6633L32.8812 37.1031C32.3781 37.6063 31.7109 37.8797 31.0055 37.8797C30.3 37.8797 29.6273 37.6008 29.1297 37.1031L25.6898 33.6633C25.1539 33.1274 25.1539 32.2633 25.6898 31.7274C26.2258 31.1914 27.0898 31.1914 27.6258 31.7274L29.6437 33.7453L29.6437 25.9742C29.6437 25.2196 30.2562 24.6071 31.0109 24.6071C31.7656 24.6071 32.3781 25.2196 32.3781 25.9742L32.3781 33.7508L34.3961 31.7328C34.9211 31.1969 35.7852 31.1969 36.3211 31.7274Z" fill="#F46A6A"></path>
                                                                    </g>
                                                                </svg>
                                                            <?php } else { ?>
                                                                <svg class="bgl-success tr-icon" width="63" height="63" viewbox="0 0 63 63" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                    <g>
                                                                        <path d="M35.2219 42.9875C34.8938 42.3094 35.1836 41.4891 35.8617 41.1609C37.7484 40.2531 39.3453 38.8422 40.4828 37.0758C41.6477 35.2656 42.2656 33.1656 42.2656 31C42.2656 24.7875 37.2125 19.7344 31 19.7344C24.7875 19.7344 19.7344 24.7875 19.7344 31C19.7344 33.1656 20.3523 35.2656 21.5117 37.0813C22.6437 38.8477 24.2461 40.2586 26.1328 41.1664C26.8109 41.4945 27.1008 42.3094 26.7727 42.993C26.4445 43.6711 25.6297 43.9609 24.9461 43.6328C22.6 42.5063 20.6148 40.7563 19.2094 38.5578C17.7656 36.3047 17 33.6906 17 31C17 27.2594 18.4547 23.743 21.1016 21.1016C23.743 18.4547 27.2594 17 31 17C34.7406 17 38.257 18.4547 40.8984 21.1016C43.5453 23.7484 45 27.2594 45 31C45 33.6906 44.2344 36.3047 42.7852 38.5578C41.3742 40.7508 39.3891 42.5063 37.0484 43.6328C36.3648 43.9555 35.55 43.6711 35.2219 42.9875Z" fill="#2BC155"></path>
                                                                        <path d="M36.3211 31.7274C36.5891 31.9953 36.7203 32.3453 36.7203 32.6953C36.7203 33.0453 36.5891 33.3953 36.3211 33.6633L32.8812 37.1031C32.3781 37.6063 31.7109 37.8797 31.0055 37.8797C30.3 37.8797 29.6273 37.6008 29.1297 37.1031L25.6898 33.6633C25.1539 33.1274 25.1539 32.2633 25.6898 31.7274C26.2258 31.1914 27.0898 31.1914 27.6258 31.7274L29.6437 33.7453L29.6437 25.9742C29.6437 25.2196 30.2562 24.6071 31.0109 24.6071C31.7656 24.6071 32.3781 25.2196 32.3781 25.9742L32.3781 33.7508L34.3961 31.7328C34.9211 31.1969 35.7852 31.1969 36.3211 31.7274Z" fill="#2BC155"></path>
                                                                    </g>
                                                                </svg>
                                                            <?php } ?>
                                                        </td>
                                                        <td>
                                                            <h6 class="fs-16 font-w600 mb-0"><a href="javascript:void(0);" class="text-black"><?php echo $data['nama'] ?></a></h6>
                                                            <span class="fs-14"><?php echo $data['job'] ?></span>
                                                        </td>
                                                        <td>
                                                            <h6 class="fs-16 text-black font-w600 mb-0"><?php echo date('d-m-Y', strtotime($data['tanggal'])); ?></h6>
                                                            <?php if ($data['jam_pulang'] != '00:00:00') { ?>
                                                                <span class="fs-14">Pulang : <?php echo $data['jam_pulang'] ?></span>
                                                            <?php } else { ?>
                                                                <span class="fs-14">Masuk : <?php echo $data['jam_masuk'] ?></span>
                                                            <?php } ?>
                                                        </td>
                                                        <?php
                                                        if ($data['jam_pulang'] != '00:00:00') {
                                                            echo '<td><span class="badge light badge-danger fs-16 font-w500">Pulang</span></td>';
                                                        } elseif ($data['jam_masuk'] != '00:00:00') {
                                                            echo '<td><span class="badge light badge-success fs-16 font-w500">Masuk</span></td>';
                                                        } else {
                                                            echo '<td><span class="badge light badge-info fs-16 font-w500">Tidak Absen</span></td>';
                                                        }
                                                        ?>
                                                    </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="col-xl-6 col-xxl-12">
                        <div class="row">
                            <div class="col-xl-12">
                                <div class="card coin-card">
                                    <div class="card-body d-sm-flex d-block align-items-center">
                                        <span class="coin-icon">
                                            <i class="flaticon-381-wifi-2 fs-2"></i>
                                        </span>
                                        <div>
                                            <h3 class="text-white">Scan Your RFID Card</h3>
                                            <a class="text-white" href="scan.php">Learn more >></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-12">
                                <div class="card coin-card ">
                                    <div class="card-body d-sm-flex d-block align-items-center">
                                        <span class="coin-icon">
                                            <i class="flaticon-381-eject fs-2"></i>
                                        </span>
                                        <div>
                                            <h3 class="text-white">JAM WIB (GMT+7)</h3>
                                            <h2 class="text-white" id="clock"></h2>
                                            <h4 class="text-white" id="day" style="display: inline-block; margin-right: 10px;"></h4>
                                            <h4 class="text-white" id="date" style="display: inline-block;"></h4>
                                            <script>
                                                function updateClock() {
                                                    var now = new Date();
                                                    var hours = now.getHours();
                                                    var minutes = now.getMinutes();
                                                    var seconds = now.getSeconds();
                                                    var days = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
                                                    var day = days[now.getDay()];
                                                    var date = now.getDate();
                                                    var month = now.getMonth() + 1; // Months are zero-based
                                                    var year = now.getFullYear();
                                                    hours = hours < 10 ? '0' + hours : hours;
                                                    minutes = minutes < 10 ? '0' + minutes : minutes;
                                                    seconds = seconds < 10 ? '0' + seconds : seconds;
                                                    date = date < 10 ? '0' + date : date;
                                                    month = month < 10 ? '0' + month : month;
                                                    var timeString = hours + ':' + minutes + ':' + seconds;
                                                    var dateString = date + ' - ' + month + ' - ' + year;
                                                    document.getElementById('clock').innerHTML = timeString;
                                                    document.getElementById('day').innerHTML = day;
                                                    document.getElementById('date').innerHTML = dateString;
                                                }
                                                setInterval(updateClock, 1000);
                                                updateClock();
                                            </script>
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

    <!-- Dashboard 1 -->
    <script src="js/dashboard/dashboard-1.js"></script>

    <script src="js/custom.min.js"></script>
    <script src="js/dlabnav-init.js"></script>
    <script src="js/demo.js"></script>
    <script src="js/styleSwitcher.js"></script>

</body>

</html>