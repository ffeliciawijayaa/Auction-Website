<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Barang Lelang</title>
    <link rel="stylesheet" href="../style/style-page-user.css">
    
</head>

<body>

    <nav class="navbar">
        <div class="navbar-container">
        <img src='../foto/logoo.png' alt='Shoping Cart' class='logo'>
        <div class="search-bar-container">
            <input type="text" placeholder="Search" class="search-input">
            <button class="search-button"><img src='../foto/search.png' alt='Shoping Cart'></button>
        </div>

            <ul class="navbar-links">
            <li><a href="view-page-barang-user.php" class='logout-btn'><img src='../foto/home-icon.png' alt='Home' class='logout-logo'></a></li>
                <li><a href="view-pembayaran-user.php" class='logout-btn'><img src='../foto/cart.png' alt='Shoping Cart' class='logout-logo'></a></li>
                <li><a href="view-login-user.php" class='logout-btn'><img src='../foto/icon-user.png' alt='User' class='logout-logo'></a></li>
                <li><a href="view-form-login.php" class='logout-btn'><img src='../foto/logout.png' alt='Logout' class='logout-logo'></a></li>
            </ul>
        </div>
    </nav>

    <div class="container-detail-barang">
        <h1>Detail Barang Lelang</h1>
        <?php
        include "../backend/kelas-auction.php";
        $act = new Auction();

        $id_barang = isset($_GET['id']) ? intval($_GET['id']) : 0; 
        
        if ($id_barang > 0) {
            $item = $act->tampilkanDetailBarangById($id_barang);

            $bids = $act->tampilkanBidsByBarangId($id_barang);

            foreach ($item as $i) {
                echo "<h2>" . htmlspecialchars($i['nama_barang']) . "</h2>";
                echo "<p>" . htmlspecialchars($i['deskripsi_barang']) . "</p>";
                echo "<p>Harga Awal: Rp " . number_format($i['harga_awal'], 0, ',', '.') . "</p>";
                echo "<p>Harga Buyout: Rp " . number_format($i['harga_buyout'], 0, ',', '.') . "</p>";
                echo "<img src='../gambar/" . htmlspecialchars($i['foto_barang']) . "' alt='Foto Barang' style='max-width:100%; height:auto;'>";
            }

            echo "<h3>Daftar Bid:</h3>";
            if (count($bids) > 0) {
                echo "<table border='1'>";
                echo "<tr><th>Nama Pengguna</th><th>Bid Amount</th><th>Tanggal Bid</th></tr>";
                foreach ($bids as $bid) {
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($bid['nama']) . "</td>"; 
                    echo "<td>" . htmlspecialchars($bid['bid_amount']) . "</td>";
                    echo "<td>" . htmlspecialchars($bid['created_at']) . "</td>";
                    echo "</tr>";
                }
                echo "</table>";
            } else {
                echo "<p>Tidak ada bid untuk barang ini.</p>";
            }

            $highestBid = $act->getHighestBid($id_barang);
            if ($highestBid) {
                echo "<p>Tawaran Tertinggi: Rp " . number_format($highestBid['bid_amount'], 0, ',', '.') . " oleh " . htmlspecialchars($highestBid['nama_pengguna']) . "</p>";
            } else {
                echo "<p>Tidak ada tawaran untuk barang ini.</p>";
            }
        } else {
            echo "<p>ID barang tidak valid.</p>";
        }
        ?>
        <form method="post" action="../backend/proses-bid-user.php">
            <input type="hidden" name="id_barang" value="<?php echo htmlspecialchars($id_barang); ?>">
            <label for="bid_amount">Masukkan Jumlah Bid:</label>
            <input type="number" name="bid_amount" id="bid_amount" required>
            <button type="submit">Ajukan Bid</button>
        </form>
    </div>
</body>

</html>