<?php
include("koneksi.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user = $_POST["username"];
    $password = $_POST["password"];

    // Mengenkripsi password yang diinputkan menggunakan MD5
    $password_md5 = md5($password);

    $successMessage = "Login successful";
    $errorMessage = "Login failed. Please try again.";

    // Menggunakan parameterized query untuk menghindari SQL injection
    $query = "SELECT username as id FROM akun_admin WHERE username = ? AND password = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "ss", $user, $password_md5);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
        $id = $row['id'];

        session_start();
         $_SESSION['username']=$id;

        // Jika pengguna terdaftar, alihkan ke halaman dashboard.php atau halaman lain yang sesuai
        header("location: dashboard.php?user=" . htmlentities($id));
        exit();
    } else {
        // Jika login gagal, tampilkan pesan kesalahan
        echo '<script>';
        echo 'alert("' . $errorMessage . '");';
        echo '</script>';
    }

    // Tutup statement
    mysqli_stmt_close($stmt);
}

// Tutup koneksi
mysqli_close($conn);
?>
