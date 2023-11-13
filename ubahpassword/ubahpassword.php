<?php
include "index.html";
include "../koneksi.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Proses form saat dikirimkan
    // $username = $_POST["username"];
    $username = $_POST["username"];
    $password = $_POST["password"];
    $password2 = $_POST["password2"];
    

//     $cekpass = "select * from akun_admin where username='$username'";
//     // $result = $conn->query($query);
//     $result = mysqli_query($conn, $cekpass);
//     $row = mysqli_fetch_assoc($result);
//     // echo $cekpass;

// // Verifikasi password
// if ($row) {
    // $hash_password_database = $row['password'];
    // $kode_otp = $row["kode_otp"];
    if($password == "" and $password2 == ""){
        $pesan = "Masukan password";
                                                        echo '<script>';
                                                        echo 'alert("'.$pesan.'");';
                                                        echo 'window.location.href = "index.html";';
                                                        echo '</script>';
    }
    // Gunakan fungsi password_verify untuk membandingkan password yang dimasukkan dengan hash database
    elseif (strlen($password) < 5) {
        $pesan = "Password minimal 6";
        echo '<script>';
        echo 'alert("'.$pesan.'");'; // Sesuaikan dengan halaman loginmu
        echo '</script>';
        // exit();
    }
    elseif ($password == $password2) {
        $pw = md5($password2);
        // Lakukan logika pembaruan password di sini
        $query = "UPDATE `akun_admin` SET `password`='$pw' WHERE 1";
        echo $query;
        $result = mysqli_query($conn, $query);
        // Jika berhasil, arahkan ke login.html
        header("Location: ../dashboard.php");
        exit();
    } else {
        // Jika password tidak sesuai, beri tahu pengguna
        $pesan = "Password tidak sama.";
                                                        echo '<script>';
                                                        echo 'alert("'.$pesan.'");';
                                                        echo 'window.location.href = "index.html";';
                                                        echo '</script>';

    }
// } else {
//     // Pengguna tidak ditemukan
//     $pesan = "Username atau password salah.";
//     echo '<script>';
//                                                         echo 'alert("'.$pesan.'");';
//                                                         echo 'window.location.href = "index.html";';
//                                                         echo '</script>';
// }
if (!$result) {
    die("Error in query: " . mysqli_error($conn));
}


//     // Periksa apakah password baru sesuai dengan konfirmasi password
//     if ($password_baru == $konfirmasi_password) {
//         // Lakukan logika pembaruan password di sini
//         $query = "UPDATE `akun_admin` SET `password`='$password2', WHERE username='$username' AND password='$password'";
//         $result = mysqli_query($conn, $query);
//         // Jika berhasil, arahkan ke login.html
//         header("Location: login.php");
//         exit();
//     } else {
//         // Jika password tidak sesuai, beri tahu pengguna
//         echo "Password baru dan konfirmasi password tidak cocok.";
//     }
}

?>