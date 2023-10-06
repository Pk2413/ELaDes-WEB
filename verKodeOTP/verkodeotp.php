<?php
// include "../verKodeOTP/index.html";
include "../koneksi.php";
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
$username ;
$kode = "0000000";
$kode_otp = $_POST['kode_otp'];
$otp ;

if (!isset($_SESSION['kode_otp'])) {
//     // Generate random OTP if it doesn't exist in the session
    $otp = mt_rand(100000, 999999);
    $_SESSION['kode_otp'] = $otp;
    $query = "update akun_admin set kode_otp='$otp' where username='$username'";
    $update = mysqli_query($conn, $query);
} else {
    // Jika kode OTP sudah ada, gunakan yang sudah ada
    // $otp = $_SESSION['kode_otp'];
}

$sql = "select username, kode_otp from akun_admin where username='admin'";
$slect = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($slect);

if($row){
    $username = $row['username'];
    $kode = $row['kode_otp'];
}
echo $kode;

// if (!$update) {
//     die("Error in query: " . mysqli_error($conn));
// }

if($kode_otp == $kode){
    header("Location: ../ubahpassword/");
    exit();
}
}




?>