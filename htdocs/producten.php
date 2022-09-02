<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel = "icon" type = "image/png" href = "Img/logo.png">
    <link rel="stylesheet" href="style.css">
    <title>Producten</title>
</head>
<body>
<div id="wrapper">
    <div id="logowrap">
        <img src="Img/logo.png" id="logo" alt="">
    </div>
    <div id="menu">
        <div id="Home"><a href="index.html">Home</a></div>
        <div id="Producten"><a href="producten.php">Producten</a></div>
        <div id="Contact"><a href="contact.html">Contact</a></div>
        <div id="Login"><a href="login.php">Login</a></div>
        <div><a href="winkelmandje.html">Winkelmandje</a></div>
    </div>
    <div id="pg-gegevens">
        <div id="producten">
            <div>
                <?php

                include ('db/config.php');
                $results = $connect->prepare("SELECT * FROM artikel ORDER BY idartikel DESC LIMIT 4");
                $recently_added_products= $connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


                foreach ($connect as $artikel): ?>
                    <a href="producten.php?page=product&id=<?=$artikel['idartikel']?>" class="product">
                        <img src="Img/<?=$artikel['bestand']?>" width="200" height="200" alt="<?=$artikel['naamproduct']?>">
                        <span class="name"><?=$artikel['naamproduct']?></span>
                        <span class="price">
                &euro;<?=$artikel['prijs']?>
            </span>
                    </a>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>
</body>
</html>