<?php
include("../koneksi.php");

// $kode_surat = $_GET['kode_surat'];
$kode_surat = "sktm";
$id = $_GET['no_pengajuan'];
// $id = "3";
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
        //bapak
        $namabapak = $row['nama_bapak'];
        $tglbapak = $row['tempat_tanggal_lahir_bapak'];
        $pekerjaanbapak = $row['pekerjaan_bapak'];
        $alamatbapak = $row['alamat_bapak'];

        //ibu
        $namaibu = $row['nama_ibu'];
        $tglibu = $row['tempat_tanggal_lahir_ibu'];
        $pekerjaanibu = $row['pekerjaan_ibu'];
        $alamatibu = $row['alamat_ibu'];

        //anak

        $namaanak = $row['nama_anak'];
        $tglanak = $row['tempat_tanggal_lahir_anak'];
        $jeniskelaminanak = $row['jenis_kelamin_anak'];
        $alamatanak = $row['alamat_anak'];

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
    <title>SKTM</title>
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
        <div class="isi-surat" style="line-height: 1.4;">
            <div class="nomer-surat">
                <p>SURAT  KETERANGAN   TIDAK   MAMPU</p>
                <p>Nomor : 474 / …. / 411.501.03 /
                    <?php
                    $tahun_sekarang = date("Y");
                    echo $tahun_sekarang;
                    ?>.
                </p>
            </div>
            <p class="isi-surat1" style="margin-top: 30px;">Yang bertanda tangan dibawah ini  Kami Kepala  Desa Pesudukuh Kecamatan Bagor Kabupaten  Nganjuk, menerangkan  dengan sebenarnya bahwa  :</p>
            <table style="vertical-align: top; ">
                <tr>

                <tr>
                    <td style="width: 0%;">1</td>
                    <td style="width: 0%;">-</td>
                    <td style="width: 30%;">Nama Bapak</td>
                    <td style="width: 0%;">:</td>
                    <td style="width: auto;">
                        <?php echo $namabapak; ?>
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td>-</td>
                    <td>Tempat Tanggal Lahir</td>
                    <td>:</td>
                    <td>
                        <?php echo $tglbapak; ?>
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td>-</td>
                    <td>Pekerjakan </td>
                    <td>:</td>
                    <td>
                        <?php echo $pekerjaanbapak; ?>
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td>-</td>
                    <td>Alamat</td>
                    <td>:</td>
                    <td>
                        <?php echo $alamatbapak; ?>
                    </td>
                </tr>
                
                <tr>
                    <td>2</td>
                    <td>-</td>
                    <td>Nama Ibu</td>
                    <td>:</td>
                    <td>
                        <?php echo $namaibu; ?>
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td>-</td>
                    <td>Tempat Tanggal Lahir</td>
                    <td>:</td>
                    <td>
                        <?php echo $tglibu; ?>
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td>-</td>
                    <td>pekerjaan</td>
                    <td>:</td>
                    <td>
                        <?php echo $pekerjaanibu; ?>
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td>-</td>
                    <td>Alamat</td>
                    <td>:</td>
                    <td>
                        <?php echo $alamatibu; ?>
                    </td>
                </tr>
                <tr>
                    <td></td>
                </tr>
                <tr >
                    <td colspan="5">benar – benar orang tua dari seorang anak  :</td>
                    
                </tr>
                
                <tr>
                    <td></td>
                    <td>-</td>
                    <td>Nama</td>
                    <td>:</td>
                    <td>
                        <?php echo $namaanak; ?>
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td>-</td>
                    <td>Tempat Tanggal Lahir</td>
                    <td>:</td>
                    <td>
                        <?php echo $tglanak; ?>
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td>-</td>
                    <td>Jenis Kelamin</td>
                    <td>:</td>
                    <td>
                        <?php echo $jeniskelaminanak; ?>
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td>-</td>
                    <td>Alamat</td>
                    <td>:</td>
                    <td>
                        <?php echo $alamatanak; ?>
                    </td>
                </tr>
                <!-- Tambahkan baris untuk informasi lainnya -->
            </table>
            <p class="keterangan">Sehubungan  dengan orang tua dari anak tersebut diatas 
                tidak mampu , maka dengan dibuatnya surat keterangan ini dapatnya dipergunakan 
                untuk melengkapi persyaratan keringanan biaya sekolah.
            </p>
            <p>Demikian surat keterangan ini dibuat dengan sebenarnya  dan  dapatnya dipergunakan bagai-mana mestinya.
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