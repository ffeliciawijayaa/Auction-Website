<?php 
include "kelas-auction.php";

$act = new Auction();

$a = $_GET["id"];


$status = $act->pengajuanDiterima($a);

if ($status==true) {
    
    echo "<script>
            var konfirmasi = confirm('Apakah Anda yakin ingin menerima pengajuan?');
            if (konfirmasi) {
                alert('Berhasil menerima pengajuan!');
                window.location.href = '../frontend/view-verif-pengajuan-barang.php';
            } else {    
                window.history.back();
            }
        </script>";

}
else {
    echo "<script>alert('Gagal!'); window.history.back(); </script>";
    
}
?>