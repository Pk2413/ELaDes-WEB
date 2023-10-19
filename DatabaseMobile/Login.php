<?php
require('Koneksi.php');

// Menerima data dari aplikasi Android
$em = $_POST['username']; // 'email' harus sesuai dengan key yang dikirim dari Android
$pas = $_POST['password']; // 'password' harus sesuai dengan key yang dikirim dari Android

$perintah = "SELECT * FROM `akun_user` WHERE username = '$em';";
$eksekusi = mysqli_query($konek, $perintah);
$cek = mysqli_affected_rows($konek);

$response = array();

if ($cek > 0) {
    $ambil = mysqli_fetch_object($eksekusi);
    $password_db = $ambil->password;
    if ($pas == $password_db) {
     

            // Password benar
            $response["kode"] = 1;
            $response["pesan"] = "Data Tersedia";
            $response["data"] = array();
            $F["username"] = $ambil->username;
            $F["password"] = $ambil->password;
            $F["email"] = $ambil->email;
            $F["nama"] = $ambil->nama;
            $F["kode_otp"] = $ambil->kode_otp;
            array_push($response["data"], $F);
        
    } else {
        // Password salah
        $response["kode"] = 2;
        $response["pesan"] = "Password Salah";
    }
} else {
    // Email tidak ditemukan di database
    $response["kode"] = 0;
    $response["pesan"] = "Data Tidak Tersedia";
}

echo json_encode($response);
mysqli_close($konek);

?>