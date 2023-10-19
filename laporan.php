<!DOCTYPE html>
<html lang="id">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Laporan</title>
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
        <link href="css/styles.css" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    </head>
    <body class="sb-nav-fixed">
    <?php include('navbar/upbar.php')?>
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
                            <a class="nav-link" href="#" style="margin-top:    ;">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Laporan
                            </a>
                            
                </nav>
            </div>

            <!-- isi konten -->
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Laporan</h1>
                        <ol class="breadcrumb mb-4">
                            <!-- <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li> -->
                            <li class="breadcrumb-item active">Laporan</li>
                        </ol>
                        <div class="card mb-4 px-4">
                            <div class="card-body">
                                <table id="datatablesSimple">
                                    <thead>
                                        <tr>
                                        
                <th>ID</th>
                
                <th>NIK</th>
                <th>Nama</th>
                <th>Kode Surat</th>
                <th>No Pengajuan</th>
                <th>Status</th>
                <th>Detail</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                        <th>ID</th>
               
                <th>NIK</th>
                <th>Nama</th>
                <th>Kode Surat</th>
                <th>No Pengajuan</th>
                <th>Status</th>
                <th>Detail</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                    <?php
include("koneksi.php");

try {
    $sql = "SELECT laporan.id,  pengajuan_surat.nik, pengajuan_surat.nama,pengajuan_surat.kode_surat, pengajuan_surat.no_pengajuan, laporan.status 
     FROM `laporan`
    join pengajuan_surat
    GROUP by id desc;";
    $query = $conn->prepare($sql);
    $query->execute();

    $query->store_result(); // This is necessary to use num_rows with prepared statements
    $rowCount = $query->num_rows;

    if ($rowCount > 0) {
        $query->bind_result($id, $nik, $nama, $kode_surat,$no_pengajuan, $status,);

        while ($query->fetch()) { ?>
            <tr>
                <td><?php echo htmlentities($id); ?></td>
               

                <td><?php echo htmlentities($nik); ?></td>
                <td><a href="suratmasuk_detail.php?no_pengajuan=<?php echo htmlentities($no_pengajuan); ?>&kode_surat=<?php echo htmlentities($kode_surat);?>">
                <?php echo htmlentities($nama); ?>
        </a>
    </td>
                <td><?php echo htmlentities($kode_surat); ?></td>
                <td><?php echo htmlentities($no_pengajuan); ?></td>
                <td><?php echo htmlentities($status); ?></td>
                <td style="text-align: center;">
                    <a href="suratmasuk_detail.php?no_pengajuan=<?php echo htmlentities($id);?>&kode_surat=<?php echo htmlentities($kode_surat);?>">
                        <img src="btn-edit.png" alt="Detail" title="Detail" class="btn-edit">
                    </a>
                </td>
            </tr>
            <?php
        }
    } else {
        echo "No results found.";
    }
} catch (Exception $e) {
    die("Error: " . $e->getMessage());
}
?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        
                        
                        
                    </div>
                </main>
            </div>
        </div>
            
        
                    
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="assets/demo/chart-area-demo.js"></script>
        <script src="assets/demo/chart-bar-demo.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
        <script src="js/datatables-simple-demo.js"></script>
    </body>
</html>
