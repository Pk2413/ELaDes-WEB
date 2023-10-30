<?php

include('../koneksi.php');
$kode_surat = $_GET['kode_surat'];
$no_pengajuan = $_GET['no_pengajuan'];

$query = $conn->prepare("SELECT * FROM `pengajuan_surat` WHERE no_pengajuan = ? and kode_surat = ?");
$query->bind_param("ii", $no_pengajuan, $kode_surat);
$query->execute();
$result = $query->get_result();
// Ambil nilai dari parameter URL
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $id = $row['id'];
    }
    


if ($kode_surat == "skck"){
    header("Location: skck.php?no_pengajuan=" . htmlentities($no_pengajuan) . "&kode_surat=" . htmlentities($kode_surat));
    
// ... (kode lainnya)


    // Setelah selesai mencetak, update status di database
    $updateQuery = $conn->prepare("UPDATE laporan SET status = 'Selesai' WHERE id = ?");
    $updateQuery->bind_param("i", $id);
    $updateQuery->execute();
    $updateQuery->close();
} else {
    echo "Tidak ada data yang ditemukan.";
}

// ... (tutup koneksi dan kode lainnya)


} else {
    header("Location: ../404.html");
}

// Hentikan eksekusi setelah melakukan redirect
exit();
?>
