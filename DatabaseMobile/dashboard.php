<?php
require 'koneksi.php';

$user = $_POST['username'];
// $status = $_POST['status'];

$sql= "SELECT 
sum( case when  laporan.status = 'Proses' then 1 else 0 end) as Proses,
sum(case when laporan.status = 'Selesai' then 1 else 0 end ) as Selesai
FROM `laporan`
inner join pengajuan_surat
ON laporan.id = pengajuan_surat.id
WHERE pengajuan_surat.username = '$user';";

$eksekusi = mysqli_query($konek, $sql);

$response = array();

if ($eksekusi) {
    $ambil = mysqli_fetch_object($eksekusi);
    // Jika insert berhasil
    $response['kode'] = true;
    $response['pesan'] = "Berhasil Mengambil Data";
    $response["data"] = array();
    $data["Proses"] = $ambil->Proses;
    $data["Selesai"] = $ambil->Selesai;
    array_push($response["data"], $data);
} else {
    // Jika insert gagal
    $response['kode'] = false;
    $response['pesan'] =  mysqli_error($konek);
}

echo json_encode($response);
mysqli_close($konek);
?>