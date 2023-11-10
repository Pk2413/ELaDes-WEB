<!-- <?php
// Sisipkan file koneksi.php untuk menghubungkan ke database
require("koneksi.php");
include("login.php");

// Ambil nilai yang dimasukkan oleh pengguna
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    $berhasil = "Berhasil Login";

    $successMessage = "Login successful";
    $erorMessage = "Login failed. Please try again.";


    // Query SQL untuk memeriksa apakah pengguna terdaftar di tabel admin
    $query = "SELECT * FROM akun_admin WHERE username = '$username' AND password = '$password'";
    echo $query;

    // $result = $conn->query($query);
    $query = "SELECT * FROM akun_admin WHERE username = ? AND password = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "ss", $username, $password);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);


    if (mysqli_num_rows($result) == 1) {
        // Jika pengguna terdaftar, alihkan ke halaman welcome.php atau halaman lain yang sesuai
        header("location: dashboard.php");
        // $response = array('status' => 'success', 'message' => 'Login berhasil');
        echo '<script>';
        echo 'alert("' . $successMessage . '");';
        echo 'window.location.href = "Dashboard.php";';
        echo '</script>';
        exit();
    } else {
        header("location: login.php");
        // $response = array('status' => 'error', 'message' => 'Login gagal. Coba lagi.');
        echo '<script>';
        echo 'alert("' . $erorMessage . '");';
        // echo 'window.location.href = "index.php";';
        echo '</script>';

    }

}
// header('Content-Type: application/json');
//     echo json_encode($response);
?> -->