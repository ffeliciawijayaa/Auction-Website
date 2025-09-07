


<html>
<head>
    <title>Register | CAREN's Auction</title>
    <link rel="stylesheet" href="../style/style-login.css">
</head>
    <body>
    <div class="login-container">
        <div class="login-left">
            <img src="../foto/gambar-mobil-lagi.jpeg" alt="">
        </div>
        <div class="login-right">
        <?php
            include "../backend/kelas-auction.php";
        
            
            
            echo "<form action='../backend/proses-tambah-data-user.php' method='POST'>";
            echo "<h1>Register</h1>";
            echo "<p>Please enter your identity</p>";

            

            echo "Username:";
            echo "<input type='text' id='username' name='txtNama' required>";
            
            echo "Password:";
            echo "<input type='password' id='password' name='txtPassword' required>";
            
            echo "No. Rekening:";
            echo "<input type='text' id='norek' name='txtNorek' required>";
            
      
    
            echo "<input type='submit' name='' value='Register'>";
            echo "</form>";
        ?>
        </div>
        </div>
    </body>
</html>

