<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengajuan Barang</title>
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
                <li><a href="" class='logout-btn'><img src='../foto/cart.png' alt='Shoping Cart' class='logout-logo'></a></li>
                <li><a href="" class='logout-btn'><img src='../foto/icon-user.png' alt='User' class='logout-logo'></a></li>
                <li><a href="view-form-login.php" class='logout-btn'><img src='../foto/logout.png' alt='Logout' class='logout-logo'></a></li>
            </ul>
        </div>
    </nav>




    <div class="container-pengajuan">
        <h1 >Pengajuan Barang Lelang</h1>
        <form method="post" action="../backend/proses-pengajuan-barang.php" enctype="multipart/form-data">
            <div class="form-group">
                <label for="txtNamaBarang">Nama Barang:</label>
                <input type="text" class="form-control" name="txtNamaBarang" id="txtNamaBarang" required>
            </div>
            <div class="form-group">
                <label for="txtDeskripsiBarang">Deskripsi:</label>
                <input type="text" class="form-control" name="txtDeskripsiBarang" id="txtDeskripsiBarang" required>
            </div>
            <div class="form-group">
                <label for="nmbHargaAwal">Harga Awal:</label>
                <input type="number" class="form-control" name="nmbHargaAwal" id="nmbHargaAwal" required>
            </div>
            <div class="form-group">
                <label for="nmbHargaBuyout">Harga Buyout:</label>
                <input type="number" class="form-control" name="nmbHargaBuyout" id="nmbHargaBuyout" required>
            </div>
            <div class="form-group">
                <label for="imgFotoBarang">Foto Barang:</label>
                <input type="file" class="form-control" name="imgFotoBarang" id="imgFotoBarang" accept="image/*" required>
            </div>
            <input type="hidden" name="txtStatus" value="Pending">
            <button type="submit" class="btn btn-primary">Ajukan</button>
        </form>
    </div>
</body>
</html>