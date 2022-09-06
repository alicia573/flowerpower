<?php
include ("db/config.php");
if (isset($_POST['idartikel'], $_POST['aantal']) && is_numeric($_POST['idartikel']) && is_numeric($_POST['aantal'])) {
    $product_id = (int)$_POST['idartikel'];
    $quantity = (int)$_POST['aantal'];
    $stmt = $connect->prepare('SELECT * FROM artikel WHERE idartikel = ?');
    $stmt->execute([$_POST['idartikel']]);
    $product = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($product && $quantity > 0) {
        if (isset($_SESSION['cart']) && is_array($_SESSION['cart'])) {
            if (array_key_exists($product_id, $_SESSION['cart'])) {
                $_SESSION['cart'][$product_id] += $quantity;
            } else {
                $_SESSION['cart'][$product_id] = $quantity;
            }
        } else {
            $_SESSION['cart'] = array($product_id => $quantity);
        }
    }
}
    ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel = "icon" type = "image/png" href = "Img/logo.png">
    <link rel="stylesheet" href="style.css">
    <title>Winkelmandje</title>
</head>
<body>
<div id="wrapper">
    <div id="menu">
        <div id="logowrap">
            <img src="Img/logo.png" id="logo" alt="">
        </div>
        <div id="menu-btn">
            <div id="Home"><a href="index.php">Home</a></div>
            <div id="Producten"><a href="producten.php">Producten</a></div>
            <div id="Contact"><a href="contact.html">Contact</a></div>
            <div id="Login"><a href="login.php">Login</a></div>
            <div id="Winkelmandje"><a href="winkelmandje.php">Winkelmandje</a></div>
        </div>

    </div>
    <div id="pg-gegevens">
        <h1>Winkelmandje</h1>

    </div>
    </div>
</div>
</body>
</html>