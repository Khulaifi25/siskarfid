<?php
session_start();
include 'koneksi.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php
    include 'navbar.php'; ?>
    <title>SignIn RFID - CV Mulia Abadi</title>
</head>

<body class="vh-100">
    <div class="authincation h-100">
        <div class="container h-100">
            <div class="row justify-content-center h-100 align-items-center">
                <div class="col-md-6">
                    <div class="authincation-content">
                        <div class="row no-gutters">
                            <div class="col-xl-12">
                                <div class="auth-form">
                                    <div class="text-center mb-3">
                                        <a href="index.php" class="brand-logo" data-layout="horizontal">
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
                                    </div>
                                    <h4 class="text-center mb-4">Masuk ke Akun Anda</h4>
                                    <form action="cek_signin.php" method="POST">
                                        <div class="mb-3">
                                            <label class="mb-1"><strong>UID</strong></label>
                                            <input type="text" name="id_card" class="form-control" value="" placeholder="Masukkan UID Anda">
                                        </div>
                                        <div class="mb-3">
                                            <label class="mb-1"><strong>Password</strong></label>
                                            <input type="password" name="password" class="form-control" value="" placeholder="Masukkan Password Anda">
                                        </div>
                                        <div class="row d-flex justify-content-between mt-4 mb-2">
                                            <div class="mb-3">
                                                <label class="mb-1"><strong>Pilih Role</strong></label>
                                                <select id="single-select" class="form-control default-select wide" name="level">
                                                    <option value="karyawan">Karyawan</option>
                                                    <option value="admin">Administrator</option>
                                                </select>
                                            </div>
                                            <div class="mb-3">
                                                <div class="form-check custom-checkbox ms-1">
                                                    <input type="checkbox" class="form-check-input" id="basic_checkbox_1">
                                                    <label class="form-check-label" for="basic_checkbox_1">Ingat saya</label>
                                                </div>
                                            </div>
                                            <div class="mb-3">
                                                <a href="reset-password.php">Lupa Password?</a>
                                            </div>
                                        </div>
                                        <div class="text-center">
                                            <button type="submit" name="login" class="btn btn-primary btn-block">Masuk</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!--**********************************
        Scripts
    ***********************************-->
    <!-- Required vendors -->
    <script src="vendor/global/global.min.js"></script>
    <script src="js/custom.min.js"></script>
    <script src="js/dlabnav-init.js"></script>
    <script src="js/styleSwitcher.js"></script>
</body>

</html>

</html>