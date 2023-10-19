<!DOCTYPE html>
<html lang="id">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Login - SB Admin</title>
        <link href="css/styles.css" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
        
    </head>
    <body class="bg-primary">
        <div id="layoutAuthentication">
            <div id="layoutAuthentication_content">
                <main>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-5">
                                <div class="card shadow-lg border-0 rounded-lg mt-5">
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4">Login</h3></div>
                                    <div class="card-body">
                                        <form method="POST">
                                            <div class="form-floating mb-3">
                                                <input class="form-control" id="username" name="username" type="text" placeholder="Username" required/>
                                                <label for="username">Username</label>
                                            </div>
                                            <div class="form-floating mb-3">
                                                <input class="form-control" id="password" name="password" type="password" placeholder="Password" required/>
                                                <label for="password">Password</label>
                                            </div>
                                            <div class="form-check mb-3">
                                                <input class="form-check-input" id="inputRememberPassword" type="checkbox" value="true" />
                                                <label class="form-check-label" for="inputRememberPassword">Remember Password</label>
                                            </div>
                                            <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                                                <a class="small" href="verKodeOtp/">Forgot Password?</a>
                                                <input class="btn btn-primary" type="submit" value="Login">
                                            </div>
                                            <?php
                                                // Sisipkan file koneksi.php untuk menghubungkan ke database
                                                include("koneksi.php");
                                               

                                                // Ambil nilai yang dimasukkan oleh pengguna
                                                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                                                    $username = $_POST["username"];
                                                    $password = $_POST["password"];

                                                    $berhasil = "Berhasil Login";

                                                    $successMessage = "Login successful";
                                                    $erorMessage = "Login failed. Please try again.";


                                                    // Query SQL untuk memeriksa apakah pengguna terdaftar di tabel admin
                                                    // $query = "SELECT * FROM akun_admin WHERE username = '$username' AND password = '$password';";
                                                    // echo $query;

                                                    // $result = $conn->query($query);
                                                    $query = "SELECT * FROM akun_admin WHERE username = ? AND password = ?";
                                                    $stmt = mysqli_prepare($conn, $query);
                                                    mysqli_stmt_bind_param($stmt, "ss", $username, $password);
                                                    mysqli_stmt_execute($stmt);
                                                    $result = mysqli_stmt_get_result($stmt);
                                                    // echo $result;


                                                    if (mysqli_num_rows($result) == 1) {
                                                        // Jika pengguna terdaftar, alihkan ke halaman welcome.php atau halaman lain yang sesuai
                                                        header("location: dashboard.php");
                                                        // $response = array('status' => 'success', 'message' => 'Login berhasil');
                                                        // echo '<script>';
                                                        // echo 'alert("' . $successMessage . '");';
                                                        // echo 'window.location.href = "dashboard.php";';
                                                        // echo '</script>';
                                                        exit();
                                                    }else{
                                                        // header("location: login.php");
                                                        // $response = array('status' => 'error', 'message' => 'Login gagal. Coba lagi.');
                                                        echo '<script>';
                                                        echo 'alert("'.$erorMessage.'");';
                                                        echo 'window.location.href = "login.php";';
                                                        echo '</script>';

                                                    }
                                                    
                                                }
                                                // header('Content-Type: application/json');
                                                //     echo json_encode($response);
                                            ?>
                                        </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </main>
                
            </div>
            <footer class="sticky-footer bg-white mt-auto py-4 g-col-12">
                <div class="container my-auto">
                    <div class="text-center my-auto">
                    <img src="gambar/logo.png" height="35dp" width="60dp">
            
                    <!-- <span>
                      &copy; 2023 Di Develop oleh P-RESH</span> -->
                      <span class="text-muted">&copy; Copyright 2023 P-Resh Developer</span>
                      <!-- <div>
                          <a href="#">Privacy Policy</a>
                          &middot;
                          <a href="#">Terms &amp; Conditions</a>
                      </div> -->
                  </div>
              </div>
            </footer>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
        <script src="js/toast.js"></script>
    </body>
        
</html>
