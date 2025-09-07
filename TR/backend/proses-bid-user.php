<?php
session_start(); 
include "kelas-auction.php";

$act = new Auction();

$id_barang = $_POST['id_barang'];
$bid_amount = $_POST['bid_amount'];
$user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null; 

if ($user_id) {
    $success = $act->ajukanBid($id_barang, $bid_amount, $user_id);
    if ($success) {
        $lelangSelesai = $act->ubahStatusLelangAfterBid($id_barang, $bid_amount);
        if ($lelangSelesai) {
            header("Location: ../frontend/view-page-barang-user.php?");
            exit(); 
        } else {
            header("Location: ../frontend/view-page-detail-barang.php?id=" . $id_barang);
            exit();

        }
    } else {
        echo "<script>
            alert('Gagal mengajukan bid! Pastikan bid mu lebih tinggi dari bid tertinggi!');
            window.location.href = '../frontend/view-page-barang-user.php'; 
            </script>";
            exit();
        
    }
} else {
    echo "<script>
            alert('Anda harus login untuk mengajukan bid!');
            window.location.href = '../frontend/view-login-user.php'; 
            </script>";
            exit();
}
