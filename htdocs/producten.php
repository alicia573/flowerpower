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
        <div><a href="winkelmandje.php">Winkelmandje</a></div>
    </div>
    <div id="pg-gegevens">
        <div id="producten">
            <div>
                <?php

                include('db/config.php');
                $results = $connect->prepare("SELECT * FROM artikel");
                //$results->bindValue(':search'.'%'.$search.'%');
                $results->execute();

                $recently_added_products = $results->fetchAll(PDO::FETCH_ASSOC);

                foreach ($recently_added_products as $product): ?>
                <a href="index.html?page=product&id=<?=$product['idartikel']?>" class="product">
                    <img src="Img/<?=$product['bestand']?>" width="200" height="200" alt="<?=$product['naamproduct']?>">
                    <span class="name"><?=$product['naamproduct']?></span>
                    <span class="price">
                &dollar;<?=$product['prijs']?>
                        <?php if ($product['prijs'] > 0): ?>
                            <span class="rrp">&euro;<?=$product['prijs']?></span>
                        <?php endif; ?>
            </span>
                </a>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>
</body>
</html>