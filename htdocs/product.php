<?php
include('db/config.php');

if (isset($_GET['idartikel'])) {
    $results = $connect->prepare('SELECT * FROM artikel WHERE idartikel = ?');
    $results->execute([$_GET['idartikel']]);
    $product = $results->fetch(PDO::FETCH_ASSOC);
    if (!$product) {
        exit('Product does not exist!');
    }
} else {
    exit('Product does not exist!');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel = "icon" type = "image/png" href = "Img/logo.png">
    <link rel="stylesheet" href="style.css">
    <title>Contact</title>
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
            <div id="Winkelmandje"><a href="cart.php">Winkelmandje</a></div>
        </div>

    </div>
    <div id="pg-gegevens">
        <div class="product content-wrapper">
            <img src="Img/<?=$product['bestand']?>" width="500" height="500" alt="<?=$product['naamproduct']?>">
            <div>
                <h1 class="name"><?=$product['naamproduct']?></h1>
                <span class="price">
            &dollar;<?=$product['prijs']?>
        </span>
                <form action="cart.php" method="post">
                    <input type="number" name="aantal" value="1" min="1" max="<?=$product['aantal']?>" placeholder="Quantity" required>
                    <input type="hidden" name="idartikel" value="<?=$product['idartikel']?>">
                    <input type="submit" value="In winkelwagen">
                </form>
                <div class="description"><p style="font-stretch: expanded">Omschrijving</p>
                    <?=$product['omschrijving']?>
                </div>
            </div>
        </div>

    </div>
</div>
</body>
</html>
