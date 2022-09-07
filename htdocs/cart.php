<?php
include ("db/config.php");

if (isset($_POST['submit'],$_POST['idartikel'], $_POST['aantal']) && is_numeric($_POST['idartikel']) && is_numeric($_POST['aantal'])) {
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
    header('location:cart.php');
    exit;
}
if (isset($_GET['remove']) && is_numeric($_GET['remove']) && isset($_SESSION['cart']) && isset($_SESSION['cart'][$_GET['remove']])) {
    unset($_SESSION['cart'][$_GET['remove']]);
}
if (isset($_POST['update']) && isset($_SESSION['cart'])) {
    foreach ($_POST as $k => $v) {
        if (strpos($k, 'aantal') !== false && is_numeric($v)) {
            $id = str_replace('aantal-', '', $k);
            $quantity = (int)$v;
            if (is_numeric($id) && isset($_SESSION['cart'][$id]) && $quantity > 0) {
                $_SESSION['cart'][$id] = $quantity;
            }
        }
    }
    header('location: cart.php');
    exit;
}
if (isset($_POST['placeorder']) && isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
    header('Location: index.php?placeorder');
    exit;
}
$products_in_cart = isset($_SESSION['cart']) ? $_SESSION['cart'] : array();
$products = array();
$subtotal = 0.00;
if ($products_in_cart) {
    $array_to_question_marks = implode(',', array_fill(0, count($products_in_cart), '?'));
    $stmt = $connect->prepare('SELECT * FROM artikel WHERE idartikel IN (' . $array_to_question_marks . ')');
    $stmt->execute(array_keys($products_in_cart));
    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
    foreach ($products as $product) {
        $subtotal += (float)$product['prijs'] * (int)$products_in_cart[$product['idartikel']];
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
            <div id="Winkelmandje"><a href="cart.php?cart">Winkelmandje</a></div>
        </div>

    </div>
    <div id="pg-gegevens">
        <h1>Winkelmandje</h1>
        <div class="cart content-wrapper">
            <form action="cart.php" method="post">
                <table>
                    <thead>
                    <tr>
                        <td colspan="2">Product</td>
                        <td>Price</td>
                        <td>Quantity</td>
                        <td>Total</td>
                    </tr>
                    </thead>
                    <tbody>
                    <?php if (empty($products)): ?>
                        <tr>
                            <td colspan="5" style="text-align:center;">You have no products added in your Shopping Cart</td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($products as $product): ?>
                            <tr>
                                <td class="img">
                                    <a href="cart.php?product&idartikel=<?=$product['idartikel']?>">
                                        <img src="Img/<?=$product['bestand']?>" width="50" height="50" alt="<?=$product['naamproduct']?>">
                                    </a>
                                </td>
                                <td>
                                    <a href="index.php?product&id=<?=$product['idartikel']?>"><?=$product['naamproduct']?></a>
                                    <br>
                                    <a href="index.php?cart&remove=<?=$product['idartikel']?>" class="remove">Remove</a>
                                </td>
                                <td class="price">&euro;<?=$product['prijs']?></td>
                                <td class="quantity">
                                    <input type="number" name="quantity-<?=$product['idartikel']?>" value="<?=$products_in_cart[$product['idartikel']]?>" min="1" max="<?=$product['aantal']?>" placeholder="Quantity" required>
                                </td>
                                <td class="price">&euro;<?=$product['prijs'] * $products_in_cart[$product['idartikel']]?></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                    </tbody>
                </table>
                <div class="subtotal">
                    <span class="text">Subtotal</span>
                    <span class="price">&euro;<?=$subtotal?></span>
                </div>
                <div class="buttons">
                    <input type="submit" value="Update" name="update">
                    <input type="submit" value="Place Order" name="placeorder">
                </div>
            </form>
        </div>

    </div>
    </div>
</div>
</body>
</html>