<?php
// Sisipkan file koneksi.php untuk menghubungkan ke database
include("koneksi.php");

// Ambil nilai yang dimasukkan oleh pengguna
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    $berhasil = "Berhasil Login";

    // Query SQL untuk memeriksa apakah pengguna terdaftar di tabel admin
    $query = "SELECT * FROM akun_admin WHERE username = '$username' AND password = '$password'";
    // $result = $conn->query($query);
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) == 1) {
        // Jika pengguna terdaftar, alihkan ke halaman welcome.php atau halaman lain yang sesuai
        header("location: dashboard.php");
        // $response = array('status' => 'success', 'message' => 'Login berhasil');
        // exit();
    }else{
        header("location: login.html");
        // $response = array('status' => 'error', 'message' => 'Login gagal. Coba lagi.');
    }
    
}
// header('Content-Type: application/json');
//     echo json_encode($response);
?>