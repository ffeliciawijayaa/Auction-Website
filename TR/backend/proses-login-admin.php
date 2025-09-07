<?php
include "kelas-auction.php";

$act = new Auction();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['username']) && !empty($_POST['password'])) {

    $a = trim($_POST['username']);
    $b = trim($_POST['password']);

    $status = $act->cekLoginAdmin($a, $b);

    if ($status) {
     
        session_start(); 
        $_SESSION['admin_logged_in'] = true; 
        $_SESSION['username'] = $a; 

        header("Location: ../frontend/view-page-admin.php"); 
        exit();
    } else {
        echo "<script>
            alert('Username/Password salah!');
            window.location.href = '../frontend/view-login-admin.php'; 
            </script>";
    }
} else {
    echo "<script>
        alert('Gagal Login!');
        window.location.href = '../frontend/view-login-admin.php'; 
        </script>";
    exit();
}
?>