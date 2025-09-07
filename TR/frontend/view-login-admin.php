

<html>
<head>
    <title>Login as Admin</title>
    <link rel="stylesheet" href="../style/style-login.css">
</head>
    <body>
    <div class="login-container">
        <div class="login-left">
            <img src="../foto/gambar-mobil-2.jpeg" alt="">
        </div>
        <div class="login-right">
        <?php
            include "../backend/kelas-auction.php";
        
            
            
            echo "<form action='../backend/proses-login-admin.php' method='POST'>";
            echo "<h1>Login as Admin</h1>";
            echo "<p>Please enter your login details</p>";

            echo "Username:";
            echo "<input type='text' id='username' name='username' required>";
            echo "<br><br>";
            echo "Password:";
            echo "<input type='password' id='password' name='password' required>";
            echo "<br><br>";
            echo "<input type='hidden' name='role' value='admin'>";
            echo "<input type='submit' name='' value='Login'>";
            echo "</form>";
        ?>
        </div>
        </div>
    </body>
</html>
