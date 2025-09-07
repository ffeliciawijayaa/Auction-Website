<?php 
include "kelas-auction.php";

$act = new Auction();

$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);

if ($id === false || $id === null) {
    echo "<script>alert('ID tidak valid!'); window.history.back();</script>";
    exit;
}

$status = $act->hapusDataPengajuan($id);

if ($status === true) {
    echo "<script>
    var konfirmasi = confirm('Apakah Anda yakin ingin menolak barang ini?');
    if (konfirmasi) {
        alert('Berhasil melakukan penolakan!');
        window.location.href = '../frontend/view-verif-pengajuan-barang.php';
    } else {    
        window.history.back();
    }
    </script>";
} else {
    echo "<script>alert('Gagal!'); window.history.back();</script>";
}
?>