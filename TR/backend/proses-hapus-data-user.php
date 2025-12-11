<?php 

include "kelas-auction.php";

$act = new Auction();

$id = $_GET["id"];
 
$status = $act->hapusDataUser($id);

if($status==true) {

    echo "<script>
            var konfirmasi = confirm('Apakah Anda yakin ingin menghapus user ini?');
            if (konfirmasi) {
                alert('Berhasil menghapus user!');
                window.location.href = '../frontend/view-tampil-data-user.php';
            } else {    
                window.history.back();
            }
        </script>";
    
    
}
else echo "<script>alert('Gagal menghapus data!');</script>";
?>