<?php
require 'koneksi.php';

$user = $_POST['username'];
// $status = $_POST['status'];

$sql= "SELECT 
sum(case when laporan.status = 'Selesai' then 1 else 0 end ) as Selesai,
sum(case when laporan.status = 'Masuk' then 1 else 0 end ) as Masuk,
sum(case when laporan.status = 'Tolak' then 1 else 0 end ) as Tolak
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
    $data["Selesai"] = $ambil->Selesai;
    $data["Masuk"] = $ambil->Masuk;
    $data["Tolak"] = $ambil->Tolak;
    array_push($response["data"], $data);
} else {
    // Jika insert gagal
    $response['kode'] = false;
    $response['pesan'] =  mysqli_error($konek);
}

echo json_encode($response);
mysqli_close($konek);
?>