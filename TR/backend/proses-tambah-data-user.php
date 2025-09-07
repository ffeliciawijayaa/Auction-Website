<?php 
include "kelas-auction.php";

$act = new Auction();

$a = $_POST["txtNama"];
$b = $_POST["txtPassword"];
$c = $_POST["txtNorek"];

$status = $act->simpanLogin($a, $b, $c);
if ($status==true) header("Location:../frontend/view-form-login.php");
else {
    echo "<script>alert('Gagal melakukan register!');</script>";
}

?>