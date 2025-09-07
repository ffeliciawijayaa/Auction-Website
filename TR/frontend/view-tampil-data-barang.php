<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Barang Page</title>
    <link rel="stylesheet" href="../style/style-dashboard-admin.css">
</head>
<body>
    <div class="container">






<?php 

session_start(); 

if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {

    header("Location: view-login-admin.php");
    exit();
}
include "../backend/kelas-auction.php"; 





$act = new Auction();



$dtb = $act->tampilkanBarangUrut();

echo "<div class='sidebar'>";
echo "<img src='../foto/logoO.png' alt='CARENs Auction' class='logo'>";

echo "<div class='sidebar-header'>";
echo "<h2>WELCOME ADMIN</h2>";

if (isset($_GET['logout']) && $_GET['logout'] == 'true') {
   
    session_unset();

    header("Location: ../frontend/view-login-admin.php");
    exit();
}

echo "<a href='?logout=true' class='logout-btn'><img src='../foto/logout.png' alt='Logout' class='logout-logo'></a>"; 
echo "</div>";


echo "<ul>";
echo "<li><a href='view-page-admin.php'><img src='../foto/icon-dasboard.png' alt='' class='logout-logo'>Dashboard</a></li>";
echo "<li><a href='view-verif-pengajuan-barang.php'><img src='../foto/yesno.png' alt='Verifikasi Pengajuan' class='logout-logo'>Verifikasi Pengajuan</a></li>";
echo "<li><a href=''><img src='../foto/icon-data.png' alt='Data Barang' class='logout-logo'>Data Barang</a></li>";
echo "<li><a href='view-tampil-data-user.php'><img src='../foto/icon-user.png' alt='Data User' class='logout-logo'> Data User</a></li>";
echo "</ul>";


echo "</div>"; 


        echo "<div class='content'>";
        echo "<h1>DATA BARANG CAREN's AUCTION</h1>";


echo "<table border='1'>";
echo "<tr>";
    echo "<th>Id</th>";
    echo "<th>Nama Barang</th>";
    echo "<th>Deskripsi Barang</th>";
    echo "<th>Harga Awal</th>";
    echo "<th>Status Lelang</th>";
    echo "</tr>";



foreach($dtb as $d){
    echo "<tr>";
        echo "<td>".$d['id']."</td>";
        echo "<td>".$d['nama_barang']."</td>";
        echo "<td>".$d['deskripsi_barang']."</td>";
        echo "<td>".$d['harga_awal']."</td>";
        echo "<td>".$d['status_lelang']."</td>";
    echo "</tr>";  
}
echo "</table>";

?>

</div> 
</body>
</html>