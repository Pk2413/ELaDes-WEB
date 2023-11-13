<?php
include("koneksi.php");
// include "login.php";


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Mengenkripsi password yang diinputkan menggunakan MD5
    $password_md5 = md5($password);

    $berhasil = "Berhasil Login";

    $successMessage = "Login successful";
    $errorMessage = "Login failed. Please try again.";

    // Menggunakan parameterized query untuk menghindari SQL injection
    $query = "SELECT * FROM akun_admin WHERE username = ? AND password = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "ss", $username, $password_md5);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if (mysqli_num_rows($result) == 1) {
        $user = $result->username;

        // Jika pengguna terdaftar, alihkan ke halaman welcome.php atau halaman lain yang sesuai
        header("location: dashboard.php?user=" . htmlentities($user));
        exit();
    } else {
        // Jika login gagal, tampilkan pesan kesalahan
        echo '<script>';
        echo 'alert("' . $errorMessage . '");';
        echo '</script>';
    }
}
?>