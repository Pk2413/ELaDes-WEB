<?php
include("../koneksi.php");

$kode_surat = $_GET['kode_surat'];
$id = $_GET['no_pengajuan'];
$ttd = $_GET['ttd'];
// echo $ttd;
//query
$query = $conn->prepare("SELECT * FROM `$kode_surat` WHERE no_pengajuan = ?");
// echo $query;
$query->bind_param("i", $id);
// echo $query;
// $result = mysql_query($conn,$query);
$query->execute();
$result = $query->get_result();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        // Lakukan sesuatu dengan data yang diambil
        // Contoh:
        $nama = $row['Nama'];
        $nik = $row['NIK'];
        $jenis_kelamin = $row['Jenis_kelamin'];
        $tempat_tanggal_lahir = $row['Tempat_tanggal_lahir'];
        $Kewarganegaraan = $row['Kewarganegaraan'];
        $agama = $row['Agama'];
        $pekerjaan = $row['Pekerjaan'];
        $Alamat	 = $row['Alamat'];
        $tempat_kerja = $row['Tempat_Kerja'];
        $bagian = $row['Bagian'];
        $tanggal = $row['Tanggal'];
        // $tanggal_ijin = ubahFormatTanggal($tanggal);
        $alasan =$row['Alasan'];

        // ... (Lakukan hal yang sesuai dengan kebutuhan Anda)
    }
} else {
    echo "Tidak ada data yang ditemukan.";
}
//tutup query
// $query->close();
// Tutup koneksi
// $conn->close();

$query = $conn->prepare("SELECT * FROM `pengajuan_surat` WHERE no_pengajuan = ? and kode_surat = ?");
// echo $query;
$query->bind_param("ii", $id, $kode_surat);
// echo $query;
// $result = mysql_query($conn,$query);
$query->execute();
$result = $query->get_result();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $tanggal_masuk = $row['tanggal'];
        $tanggal_pengajuan = ubahFormatTanggal($tanggal_masuk);
    }
} else {
    echo "Tidak ada data yang ditemukan.";
}

// $query->close();

$query = $conn->prepare("SELECT pangkat, nama FROM ttd WHERE id = ?");
$query->bind_param("s", $ttd); // Assuming $ttd is an integer

$query->execute();
$result = $query->get_result();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        // Perform actions with the retrieved data
        $ttd_pangkat = $row['pangkat'];
        $ttd_nama = $row['nama'];

        // ... (Do whatever is needed with the data)
    }
} else {
    echo "Tidak ada data yang ditemukan.";
}

$query->close();
$conn->close();



function ubahFormatTanggal($tanggal1)
{
    // Daftar nama bulan dalam bahasa Indonesia
    $bulanIndonesia = [
        'Januari',
        'Februari',
        'Maret',
        'April',
        'Mei',
        'Juni',
        'Juli',
        'Agustus',
        'September',
        'Oktober',
        'November',
        'Desember'
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
    <title>SURAT IJIN</title>
    <link rel="stylesheet" href="skck.css">
    <style>
        /* Gaya tambahan, jika diperlukan */
    </style>
</head>

<body>
    <div class="page-container">
        <div class="kop-container">
            <div class="logo-container">
                <img src="../gambar/logo surat.png" alt="Logo" style="width: 2.02cm;">
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
                <p>SURAT KETERANGAN  IJIN TIDAK MASUK KERJA</p>
                <p>Nomor : 474 / …. / 411.501.03 /
                    <?php
                    $tahun_sekarang = date("Y");
                    echo $tahun_sekarang;
                    ?>.
                </p>
            </div>
            <p class="isi-surat1">Yang bertanda tangan dibawah ini kami  
                Kepala Desa Pesudukuh Kecamatan Bagor Kabupaten Nganjuk  menerangkan dengan sebanarnya bahwa  :</p>
            <table>
                <tr>

                <tr>
                    <td style="width: 5%;"></td>
                    <td style="width: 33%;">Nama</td>
                    <td style="width: 1%;">:</td>
                    <td style="width: auto;">
                        <?php echo $nama; ?>
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td>NIK</td>
                    <td>:</td>
                    <td>
                        <?php echo $nik; ?>
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td>Jenis Kelamin</td>
                    <td>:</td>
                    <td>
                        <?php echo $jenis_kelamin; ?>
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td>Tempat/Tanggal Lahir</td>
                    <td>:</td>
                    <td>
                        <?php echo $tempat_tanggal_lahir; ?>
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td>Kewarganegaraan</td>
                    <td>:</td>
                    <td>
                        <?php echo $Kewarganegaraan; ?>
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td>Agama</td>
                    <td>:</td>
                    <td>
                        <?php echo $agama; ?>
                    </td>
                </tr>
               
                <tr>
                    <td></td>
                    <td>Pekerjaan</td>
                    <td>:</td>
                    <td>
                        <?php echo $pekerjaan; ?>
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td>Alamat</td>
                    <td>:</td>
                    <td>
                        <?php echo $Alamat; ?>
                    </td>
                </tr>
                <tr style="vertical-align: top;">
                    <td></td>
                    <td>Tempat Kerja</td>
                    <td>:</td>
                    <td>
                        <?php echo $tempat_kerja ?>
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td>Bagian</td>
                    <td>:</td>
                    <td><?php echo $bagian?></td>
                </tr>
                <!-- Tambahkan baris untuk informasi lainnya -->
            </table>
            <p class="keterangan">Sesuai dengan nama yang tertera diatas, surat keterangan / pengantar ini 
                digunakan untuk keperluan ijin tidak masuk kerja pada tanggal <?php echo $tanggal?> .  
                pada tempat kerja yang Bapak/Ibu pimpin karena <?php echo $alasan?>.
            </p>
            <p>Demikian surat keterangan/pengantar ini kami buat untuk dapat dipergunakan sebagaimana mestinya dan penuh tanggung jawab.
            </p>
            <div class="tanda-tangan">
                <table class="ttd">
                    <tr>
                        <td style="width: 55%;"></td>
                        <td>Pesudukuh,
                            <?php echo " " . $tanggal_pengajuan; ?>
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>
                            <?php echo $ttd_pangkat; ?>
                        </td>
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
                        <td style="font-weight: bold;">
                            <?php echo $ttd_nama; ?>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</body>

</html>