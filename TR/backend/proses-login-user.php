<?php 
session_start(); 
include "kelas-auction.php";

$act = new Auction();

$a = $_POST["user"];
$b = $_POST["password"];

$userData = $act->cekLoginUser  ($a, $b);
if ($userData) {
    $_SESSION['user_id'] = $userData['id'];
    header("Location: ../frontend/view-page-barang-user.php");
    exit(); 
} else {
    echo "<script>
            alert('Username/Password salah!');
            window.location.href = '../frontend/view-login-user.php'; 
          </script>";
    exit();
}
?>