<?php

session_start();
unset($_SESSION['id_card']);
unset($_SESSION['nama']);
unset($_SESSION['job']);
unset($_SESSION['gender']);
unset($_SESSION['password']);
unset($_SESSION['level']);

session_destroy();
echo "<script>alert('Anda Telah Logout!');document.location.href='signin.php'</script>";
