<?php
include ("../koneksi.php");

$kode_surat = $_GET['kode_surat'];
$id = $_GET['no_pengajuan'];
// $print = $_GET['print'];


//query
$query = $conn->prepare("SELECT * FROM `$kode_surat` WHERE no_pengajuan = ?");
// echo $query;
$query->bind_param("i", $id);
// echo $query;
// $result = mysql_query($conn,$query);
$query->execute();
$result = $query->get_result();

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        // Lakukan sesuatu dengan data yang diambil
        // Contoh:
        $nama = $row['nama'];
        $nik = $row['nik'];
        $tempat_tanggal_lahir = $row['tempat_tgl_lahir'];
        $kebangsaan = $row['kebangsaan'];
        $agama = $row['agama'];
        $jenis_kelamin =$row['jenis_kelamin'];
        $status = $row['status_perkawinan'];
        $pekerjaan = $row['pekerjaan'];
        $tinggal = $row['tempat_tinggal'];

        // ... (Lakukan hal yang sesuai dengan kebutuhan Anda)
    }
} else {
    echo "Tidak ada data yang ditemukan.";
}
//tutup query
// $query->close();
// Tutup koneksi
// $conn->close();

$query = $conn->prepare("SELECT * FROM `pengajuan_surat` WHERE no_pengajuan = ? and kode_surat = ?" );
// echo $query;
$query->bind_param("ii", $id,$kode_surat);
// echo $query;
// $result = mysql_query($conn,$query);
$query->execute();
$result = $query->get_result();

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $tanggal_masuk = $row['tanggal'];
        $tanggal_pengajuan = ubahFormatTanggal($tanggal_masuk);
    }
} else {
    echo "Tidak ada data yang ditemukan.";
}
$query->close();
// Tutup koneksi
$conn->close();


function ubahFormatTanggal($tanggal1) {
    // Daftar nama bulan dalam bahasa Indonesia
    $bulanIndonesia = [
        'Januari', 'Februari', 'Maret', 'April',
        'Mei', 'Juni', 'Juli', 'Agustus',
        'September', 'Oktober', 'November', 'Desember'
    ];

    // Pisahkan tanggal menjadi array
    $tanggalArray = explode('-', $tanggal1);

    // Ambil elemen bulan dan ubah sesuai dengan array nama bulan
    $bulan = $bulanIndonesia[intval($tanggalArray[1]) - 1];

    // Ubah format tanggal sesuai keinginan
    $tanggalFormat = $tanggalArray[2] . ' ' . $bulan . ' ' . $tanggalArray[0];

    return $tanggalFormat;
}






?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SKCK</title>
    <link rel="stylesheet" href="skck.css">
    <style>
        /* Gaya tambahan, jika diperlukan */
    </style>
</head>
<body>
    <div class="page-container">    
        <div class="kop-container">
            <div class="logo-container">
                <img src="../gambar/logo surat.png" alt="Logo" 
                style="width: 2.02cm;">
            </div>
            <div class="kop-surat">
                <p>PEMERINTAH KABUPATEN NGANJUK</p>
                <p>KECAMATAN BAGOR</p>
                <p>DESA PESUDUKUH</p>
                <p>Jalan “Utama” Nomor: 01 Telpon: - Kodepos 64461</p>
            </div>
        </div>
        <div class="isi-surat">
            <div class="nomer-surat">
            <p>SURAT KETERANGAN ADAT ISTIADAT</p>
            <p>Nomor :  730 /  ….  / 411.501.03 / 2023.</p>
            </div>
            <p class="isi-surat1">Kami  Kepala Desa Pesudukuh Kecamatan Bagor Kabupaten Nganjuk menerangkan dengan sebenarnya bahwa   :</p>
            <table>
                <tr>
                    
                <tr>
                    <td style="width: 5%;"></td>
                    <td style="width: 33%;">1. Nama</td>
                    <td style="width: 1%;">:</td>
                    <td style="width: auto;"><?php echo $nama;?></td>
                </tr>
                <tr>
                    <td></td>
                    <td>2. NIK</td>
                    <td>:</td>
                    <td><?php echo $nik;?></td>
                </tr>
                <tr>
                    <td></td>
                    <td>3. Tempat/Tanggal Lahir</td>
                    <td>:</td>
                    <td><?php echo $tempat_tanggal_lahir;?></td>
                </tr>
                <tr>
                    <td></td>
                    <td>4. Kebangsaan</td>
                    <td>:</td>
                    <td><?php echo $kebangsaan;?></td>
                </tr>
                <tr>
                    <td></td>
                    <td>5. Agama</td>
                    <td>:</td>
                    <td><?php echo $agama;?></td>
                </tr>
                <tr>
                    <td></td>
                    <td>6. Jenis Kelamin</td>
                    <td>:</td>
                    <td><?php echo $jenis_kelamin;?></td>
                </tr>
                <tr>
                    <td></td>
                    <td>7. Status Perkawinan</td>
                    <td>:</td>
                    <td><?php echo $status;?></td>
                </tr>
                <tr>
                    <td></td>
                    <td>8. Pekerjaan</td>
                    <td>:</td>
                    <td><?php echo $pekerjaan;?></td>
                </tr>
                <tr style="vertical-align: top;">
                    <td></td>
                    <td >9. Tempat Tinggal</td>
                    <td>:</td>
                    <td><?php echo $tinggal?></td>
                </tr><tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>Kecamatan Bagor Kabupaten Nganjuk</td>
                </tr>
                <!-- Tambahkan baris untuk informasi lainnya -->
            </table>
            <p class="keterangan">Sepanjang pengetahuan kami  orang tersebut diatas selama bertempat tinggal di Desa Pesudukuh, Kecamatan Bagor Kabupaten Nganjuk berkelakuan baik, tidak pernah tersangkut perkara polisi.</p>
            <p>Surat keterangan ini berlaku sejak dikeluarkan sampai dengan tanggal<?php echo " ".$tanggal_pengajuan;?> (tiga bulan sejak dikeluarkan)</p>
            <div class="tanda-tangan">
                <table class="ttd">
                    <tr>
                        <td style="width: 55%;"></td>
                        <td>Pesudukuh,<?php echo " ".$tanggal_pengajuan;?></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>Kepala Desa Pesudukuh</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td style="font-weight: bold;">ROMI YUMIANI</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</body>
</html>
