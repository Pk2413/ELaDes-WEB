<?php
include "../koneksi.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Proses form saat dikirimkan
    $username = $_POST["username"];
    $password = $_POST["password"];
    $password2 = $_POST["password2"];

    if ($password == "" and $password2 == "") {
        $pesan = "Masukan password";
        echo '<script>';
        echo 'alert("' . $pesan . '");';
        echo 'window.location.href = "index.html";';
        echo '</script>';
    } elseif (strlen($password) < 6) {
        $pesan = "Password minimal 6 karakter.";
        echo '<script>';
        echo 'alert("' . $pesan . '");';
        echo 'window.location.href = "index.html";';
        echo '</script>';
    } elseif ($password == $password2) {
        $pw = md5($password2);
        // Sesuaikan dengan kondisi yang benar, contoh menggunakan username sebagai kondisi
        $query = "UPDATE `akun_admin` SET `password`='$pw' WHERE `username`='$username'";
        $result = mysqli_query($conn, $query);
        if ($result) {
            // Jika berhasil, arahkan ke dashboard.php
            header("Location: ../dashboard.php");
            exit();
        } else {
            die("Error in query: " . mysqli_error($conn));
        }
    } else {
        $pesan = "Password tidak sama.";
        echo '<script>';
        echo 'alert("' . $pesan . '");';
        echo 'window.location.href = "index.html";';
        echo '</script>';
    }
}
?>
