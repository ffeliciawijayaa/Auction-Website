<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CAREN's Auction</title>
    <link rel="stylesheet" href="../style/style.css">
</head>
<body>
    <div class="container">
       
        <div class="image-section"></div>

       
        <div class="content-section">
            <div class="role-selection">
                <h1>Welcome to CAREN's Auction</h1>
                <p>Choose Your Role!</p>
            </div>

            <form method="post" action="view-login-user.php">
                <input type="submit" name="user" value="User">
            </form>

            <form method="post" action="view-login-admin.php">
                <input type="submit" name="admin" value="Admin">
            </form>
        </div>
    </div>
</body>
</html>
