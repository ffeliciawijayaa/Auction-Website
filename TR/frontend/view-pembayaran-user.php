<html>

<head>
    <title>Pembayaran CAREN's Auction</title>
    <link rel="stylesheet" href="../style/style-page-user.css">
    <style>
        .btn-bayar-btn {
            display: inline-block;
            background-color: #1e2a47;
            color: white;
            padding: 10px 20px;
            font-size: 16px;
            font-weight: bold;
            border: none;
            border-radius: 5px;
            margin-top: 20px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .container-detail-barang button:hover {
            background-color: #457b9d;
        }
    </style>

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
                <li><a href="" class='logout-btn'><img src='../foto/cart.png' alt='Shoping Cart' class='logout-logo'></a></li>
                <li><a href="view-login-user.php" class='logout-btn'><img src='../foto/icon-user.png' alt='User' class='logout-logo'></a></li>
                <li><a href="view-form-login.php" class='logout-btn'><img src='../foto/logout.png' alt='Logout' class='logout-logo'></a></li>
            </ul>
        </div>
    </nav>

    <div class="grid-container">
        <?php
        include '../backend/kelas-auction.php';
        session_start(); 

        $act = new Auction();
        $db = $act->tampilkanBarangSold();

        $user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;

        foreach ($db as $barang) {
            $highestBid = $act->getHighestBid($barang['id']);

            if ($barang['status_lelang'] === 'sold' && $highestBid && $highestBid['user_id'] == $user_id) {
                echo '<div class="grid-item">';
                echo '<a href="view-page-detail-barang.php?id=' . $barang['id'] . '">';
                $gambar = base64_encode($barang['foto_barang']);
                echo '<img src=' . htmlspecialchars($barang['foto_barang']) . ' alt="Gambar ' . htmlspecialchars($barang['nama_barang']) . '">';
                echo '</a>';
                echo '<div class="item-name">' . htmlspecialchars($barang['nama_barang']) . '</div>';
                echo '<div class="item-description">' . htmlspecialchars($barang['deskripsi_barang']) . '</div>';
                $finalPrice = ($highestBid) ? $highestBid['bid_amount'] : $barang['harga_awal'];
                echo '<div class="item-price">Rp ' . number_format($finalPrice, 0, ',', '.') . '</div>';

                echo '<form method="post" action="../backend/proses-bayar.php">';
                echo '<input type="hidden" name="id_barang" value="' . $barang['id'] . '">';
                echo '<button type="submit" class="btn-bayar-btn">Bayar</button>';
                echo '</form>';
                echo '</div>'; 
            }
        }

        ?>
    </div>
</body>

</html>