<?php
include "kelas-auction.php";

$act = new Auction();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['id_barang'])) {
    $id_barang = $_POST['id_barang'];
    $status = $act->akhiriLelang($id_barang);

    if ($status) {
        echo "<script>
            var konfirmasi = confirm('Apakah Anda yakin ingin mengakhiri lelang?');
            if (konfirmasi) {
                alert('Berhasil mengakhiri lelang!');
                window.location.href = '../frontend/view-page-admin.php';
            } else {    
                window.history.back();
            }
        </script>";
    } else {
        echo "<script>
            alert('Gagal Mengakhiri Lelang!');
            window.location.href = '../frontend/view-page-admin.php'; 
            </script>";
            exit();
    }
}
?>