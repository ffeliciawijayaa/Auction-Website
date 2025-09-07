<?php
session_start();
include "kelas-auction.php";

$act = new Auction();

$id_barang = $_POST['id_barang'];
$user_id = $_SESSION['user_id']; 

$status = $act->prosesPembayaran($id_barang, $user_id);

if ($status) {


    echo "<script>
            alert('Pembayaran berhasil!!');
            window.location.href = '../frontend/view-page-barang-user.php'; 
            </script>";
            exit();
    
} else {
    echo "<script>
            alert('Gagal melakukan pembayaran! Pastikan Anda adalah pemenang lelang!');
            window.history.back();
            </script>";
            exit();
   
}
?>