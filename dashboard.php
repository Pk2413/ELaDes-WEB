<?php
include ("koneksi.php");
?>

<!DOCTYPE html>
<html lang="id">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Dashboard</title>
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
        <link href="css/styles.css" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    </head>
    <body class="sb-nav-fixed">
    <?php include('navbar/upbar.php')?>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <?php include("navbar/lefbar.php");?>
            </div>

            <!-- isi konten -->
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Dashboard</h1>
                        
                            <br>
                        
                          
                       
                     
                    


                    <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-chart-area me-1"></i>
                            </div>
                            <div class="card-body"><canvas id="myAreaChart" width="100%" height="30"></canvas></div>
                            <script>
// Ambil data dari PHP (gunakan jQuery atau Fetch API)
fetch('get_data.php')
    .then(response => response.json())
    .then(data => {
        // Data yang diambil dari MySQL
        var dates = data.map(entry => entry.tanggal);
        var counts = data.map(entry => entry.jumlah);

        // Buat Area Chart
        var ctx = document.getElementById('myAreaChart').getContext('2d');
        var areaChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: dates,
                datasets: [{
                    label: 'Surat Masuk per Hari',
                    data: counts,
                    fill: true,
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    x: [{
                        type: 'time',
                        time: {
                            unit: 'day'
                        }
                    }],
                    y: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            }
        });
    });
</script>

                            <div class="card-footer small text-muted">Terakhir pada tanggal
                            <?php
include("koneksi.php");

$query = "SELECT DATE_FORMAT(tanggal, '%d-%m-%Y') 
as tanggal FROM pengajuan_surat ORDER BY tanggal DESC LIMIT 1";
$result = $conn->query($query);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $data = $row['tanggal'];
} else {
    $data = ""; // Atau sesuaikan dengan nilai default jika tidak ada data
}

echo $data;

$conn->close();
?>


</tbody>
                                </table>
                            </div>
                            </div>
                        </div>

                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12" style="margin-top:1%">
    <a class="dashboard-stat bg-success" href="hasil-pemantauan.php">
        <?php
        include ("koneksi.php");
    
        $sql = "SELECT COUNT(*) as total FROM laporan where status='proses'"; // Menghitung jumlah data unik dalam kolom StudentId pada tabel hasil_pemantauan
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
        $totalHasilPemantauan = $row['total'];
        ?>

        <span class="number counter">
            <?php echo htmlentities($totalHasilPemantauan); ?>
        </span>
        <span class="name">Hasil Pemantauan</span>
        <span class="bg-icon"><i class="fa fa-file-text"></i></span>
    </a>
  
</div>
                        
                        </div>
                    </div>
                </main>
                
            
        
                    
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <!-- <script src="assets/demo/chart-area-demo.js"></script> -->
        <!-- <script src="assets/demo/chart-bar-demo.js"></script> -->
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
        <!-- <script src="js/datatables-simple-demo.js"></script> -->
    </body>
</html>
