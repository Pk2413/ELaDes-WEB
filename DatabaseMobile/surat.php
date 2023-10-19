<?php
include ("Koneksi.php");

$perintah = "SELECT * from surat ";
$eksekusi = mysqli_query($konek, $perintah);
$cek = mysqli_affected_rows($konek);

$response = array();

if ($cek > 0) {
    $ambil = mysqli_fetch_object($eksekusi);
   
            $response["kode"] = 1;
            $response["pesan"] = "Data Tersedia";
            $response["data"] = array();
            $F["kode_surat"] = $ambil->kode_surat;
            $F["tipe_surat"] = $ambil->tipe_surat;
            $F["keterangan"] = $ambil->Keterangan;
            array_push($response["data"], $F);
        
   
} else {
    $response["kode"] = 0;
    $response["pesan"] = "Data Tidak Tersedia";
}

echo json_encode($response);
mysqli_close($konek);
?>