<?php

include('../koneksi.php');
// $id = $_GET['id'];
$id;
$kode_surat = $_GET['kode_surat'];
$no_pengajuan = $_GET['no_pengajuan'];
$ttd = $_GET['ttd'];
$update = $_GET['print'];
echo $update;

$query = $conn->prepare("SELECT * FROM `pengajuan_surat` WHERE no_pengajuan = ? and kode_surat = ?");
$query->bind_param("ii", $no_pengajuan, $kode_surat);
$query->execute();
$result = $query->get_result();
// Ambil nilai dari parameter URL
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $id = $row['id'];
    }





    if ($kode_surat == "skck") {
        header("Location: skck.php?no_pengajuan=" . htmlentities($no_pengajuan) . "&kode_surat=" . htmlentities($kode_surat) . "&ttd=" . htmlentities($ttd));

        // ... (kode lainnya)

        if ($update == "true") {
            update($id);
        } else {

        }
        // Setelah selesai mencetak, update status di database

    } elseif ($kode_surat == "surat_ijin") {
        header("Location: surat_ijin.php?no_pengajuan=" . htmlentities($no_pengajuan) . "&kode_surat=" . htmlentities($kode_surat) . "&ttd=" . htmlentities($ttd));

        // ... (kode lainnya)
        if ($update == "true") {
            update($id);
        }

        // Setelah selesai mencetak, update status di database

    } elseif ($kode_surat == "sktm") {
        header("Location: sktm.php?no_pengajuan=" . htmlentities($no_pengajuan) . "&kode_surat=" . htmlentities($kode_surat) . "&ttd=" . htmlentities($ttd));

        if ($update == "true") {
            update($id);
        }

    } else {
        echo "Tidak ada data yang ditemukan.";
    }

    // ... (tutup koneksi dan kode lainnya)


} else {
    header("Location: ../404.html");
}

// Hentikan eksekusi setelah melakukan redirect
exit();
function update($id)
{
    require('../Koneksi.php');
    $updateQuery = $conn->prepare("UPDATE laporan SET status = 'Selesai' WHERE id = ?");
    $updateQuery->bind_param("i", $id);
    $updateQuery->execute();
    $updateQuery->close();
}


?>