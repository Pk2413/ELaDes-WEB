<?php
include 'utility/sesionlogin.php';

?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Pengajuan Surat</title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <link href="css/styles.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
</head>

<body class="sb-nav-fixed">
    <?php include('navbar/upbar.php') ?>
    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <?php include("navbar/lefbar.php"); ?>
        </div>


        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-5">
                    <h1 class="" style="margin-top: 50px;">Pengajuan Surat</h1>
                    <ol class="breadcrumb mb-4">
                        <!-- <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li> -->
                        <li class="breadcrumb-item active">Pengajuan Surat</li>
                    </ol>

                    <div class="card mb-4 px-4">
                        <div class="card-body">
                            <table id="datatablesSimple" class="table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>NIK</th>
                                        <th>Nama Lengkap</th>
                                        <th>Tipe Surat</th>
                                        <th>Tanggal Laporan</th>
                                        <th>no Pengajuan</th>
                                        <th>Detail</th>
                                    </tr>
                                </thead>
                                <!-- <tfoot>
                                        <tr>
                                        <th>ID</th>
                <th>NIK</th>
                <th>Nama Lengkap</th>
                <th>Tipe Surat</th>
                <th>Tanggal Laporan</th>
                <th>no Pengajuan</th>
                <th>Detail</th>
                                        </tr>
                                    </tfoot> -->
                                <tbody>
                                    <?php
                                    include("koneksi.php");

                                    try {
                                        $sql = "SELECT pengajuan_surat.id as id, pengajuan_surat.nik, pengajuan_surat.nama, pengajuan_surat.kode_surat, pengajuan_surat.tanggal, pengajuan_surat.no_pengajuan
                                        FROM pengajuan_surat
                                        JOIN laporan
                                        on pengajuan_surat.id = laporan.id
                                        where laporan.status = 'Masuk' or laporan.status ='Proses'
                                        GROUP by id  
                                        ORDER BY `pengajuan_surat`.`id` DESC";
                                        $query = $conn->prepare($sql);
                                        $query->execute();

                                        $query->store_result(); // This is necessary to use num_rows with prepared statements
                                        $rowCount = $query->num_rows;

                                        if ($rowCount > 0) {
                                            $query->bind_result($id, $nik, $nama, $kode_surat, $tanggal, $no_pengajuan);

                                            while ($query->fetch()) { ?>
                                                <tr>
                                                    <td>
                                                        <?php echo htmlentities($id); ?>
                                                    </td>
                                                    <td>
                                                        <?php echo htmlentities($nik); ?>
                                                    </td>

                                                    <td><a href="suratmasuk_detail.php?no_pengajuan=<?php echo htmlentities($no_pengajuan); ?>&kode_surat=<?php echo htmlentities($kode_surat); ?>&id=<?php echo htmlentities($id) ?>&user=<?php echo htmlentities($user)?>">
                                                            <?php echo htmlentities($nama); ?>
                                                        </a>
                                                    </td>
                                                    <td>
                                                        <?php echo htmlentities($kode_surat); ?>
                                                    </td>
                                                    <td>
                                                        <?php echo htmlentities($tanggal); ?>
                                                    </td>
                                                    <td>
                                                        <?php echo htmlentities($no_pengajuan); ?>
                                                    </td>
                                                    <td class="">
                                                        <a class="btn btn-primary" role="button"
                                                            href="suratmasuk_detail.php?no_pengajuan=<?php echo urlencode(trim($no_pengajuan)); ?>&kode_surat=<?php echo urlencode(trim(htmlentities($kode_surat))); ?>&id=<?php echo urlencode(trim(htmlentities($id))); ?>&user=<?php echo htmlentities($user)?>">
                                                            Detail
                                                        </a>



                                                        <a class="btn btn-danger" role="button"
                                                            href="utility/proses_tolak.php?id=<?php echo htmlentities($id); ?>"
                                                            onclick="
                                                            return confirm('Apakah anda yakin akan menolak surat?')
                                                            ">
                                                            Tolak
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

    <script>
        $(document).ready(function () {
            // Inisialisasi DataTables dengan konfigurasi kolom pencarian
            var table = $('#datatablesSimple').DataTable({
                "scrollX": true, // Menambahkan fungsi gulir horizontal
                "columns": [
                    { "searchable": false }, // Kolom ID
                    { "searchable": false }, // Kolom NIK
                    { "searchable": true }, // Kolom Nama Lengkap
                    { "searchable": true }, // Kolom Tipe surat
                    { "searchable": false }, // Kolom Tanggal Laporan
                    { "searchable": false }, // Kolom No Pengajuan
                    { "searchable": false }  // Kolom Detail
                ]
            });

            // Tambahkan fungsi pencarian
            $('#datatablesSimple_filter input').unbind().bind('keyup', function () {
                table.search(this.value).draw();
            });
        });
    </script>








    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        crossorigin="anonymous"></script>
    <script src="js/scripts.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    <!-- <script src="assets/demo/chart-area-demo.js"></script>
        <script src="assets/demo/chart-bar-demo.js"></script> -->
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js"
        crossorigin="anonymous"></script>
    <script src="js/datatables-simple-demo.js"></script>
</body>

</html>