<?php
include 'koneksi.php';
$user = $_GET['user'];

$query = "SELECT * FROM akun_admin WHERE username = ? ";
$stmt = mysqli_prepare($conn, $query);
mysqli_stmt_bind_param($stmt, "s", $user);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

if (mysqli_num_rows($result) == 1) {

} else {
    header("Location: login.php");
}
?>