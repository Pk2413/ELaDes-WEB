<?php
// session_start();
// error_reporting(0);
include('koneksi.php');

// if (strlen($_SESSION['alogin']) == "") {
//     header("Location: index.php");
// } else {
// if (isset($_GET['id'])) {
$no_pengajuan = $_GET['no_pengajuan'];
$kode_surat = $_GET['kode_surat'];
// $sql = $conn->prepare("SELECT * FROM pengajuan_surat WHERE id = ? and kode_surat 
// = ?");
// $query = $dbh->prepare($sql);
// $query->bindParam('ss', $id, $kode_surat);
// $query->execute();
// $result = $query->fetch(PDO::FETCH_OBJ);
// echo $sql;
// }
// }
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Detail Surat Masuk</title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <link href="css/styles.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
</head>

<body class="sb-nav-fixed">
    <?php include('navbar/upbar.php') ?>
    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion sb-sidenav-light" id="sidenavAccordion">
                <div class="sb-sidenav-menu">
                    <div class="nav">

                        <a class="nav-link" href="dashboard.php" style="margin-top: 50px;">
                            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                            Dashboard
                        </a>
                        <a class="nav-link" href="suratmasuk.php" style="margin-top: ;">
                            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                            Surat Masuk
                        </a>
                        <a class="nav-link" href="laporan.php" style="margin-top:    ;">
                            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                            Laporan
                        </a>

            </nav>
        </div>


        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid">
                    <h1 class="mt-4">Detail Surat Masuk</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item"><a href="suratmasuk.php">Surat Masuk</a></li>
                        <li class="breadcrumb-item active">Detail Surat Masuk</li>
                    </ol>

                </div>


                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="panel">

                                <div class="panel-body p-20">
                                    <div class="col-md-7">
                                        <h3>
                                            <?php
                                            include("koneksi.php");

                                            $query = "SELECT keterangan FROM surat where kode_surat ='$kode_surat'";
                                            $result = $conn->query($query);

                                            if ($result->num_rows > 0) {
                                                $row = $result->fetch_assoc();
                                                $data = $row['keterangan'];
                                            } else {
                                                $data = ""; // Atau sesuaikan dengan nilai default jika tidak ada data
                                            }

                                            echo $data;

                                            // $conn->close();
                                            ?>
                                        </h3>
                                    </div>


                                    <?php
                                    if ($conn->connect_error) {
                                        die("koneksi database error");
                                    }
                                    //query
                                    $query = $conn->prepare("SELECT * FROM `$kode_surat` WHERE no_pengajuan = ?");
                                    // echo $query;
                                    $query->bind_param("i", $no_pengajuan);
                                    // echo $query;
                                    // $result = mysql_query($conn,$query);
                                    $query->execute();
                                    $result = $query->get_result();


                                    if ($result->num_rows > 0) {
                                        $fields = $result->fetch_fields();


                                        //membuat tabel HTML
                                        echo "<table class='table table-striped-columns table-bordered col-md-12' id='datatablesSimple'><tr>";

                                        //nama kolom
                                        while ($row = $result->fetch_assoc()) {
                                            foreach ($fields as $field) {
                                                $columnName = $field->name;
                                                echo "<tr>";
                                                echo "<td><strong>$columnName</strong></td>";
                                                echo "<td>{$row[$columnName]}</td>";
                                                echo "</tr>";
                                            }

                                        }

                                        //menutup table
                                        echo "</table>";
                                    } else {
                                        echo "Data tidak ditemukan";
                                    }

                                    //menutup database
                                    // mysql_close($konesi);
                                    
                                    ?>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>




        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
            crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js"
            crossorigin="anonymous"></script>
        <script src="assets/demo/chart-area-demo.js"></script>
        <script src="assets/demo/chart-bar-demo.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js"
            crossorigin="anonymous"></script>
        <script src="js/datatables-simple-demo.js"></script>
</body>

</html>