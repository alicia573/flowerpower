<?php
session_start();
if(empty($_SESSION['email']))
{
    header("location:index.php");
    session_destroy();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel = "icon" type = "image/png" href = "Img/logo.png">
    <link rel="stylesheet" href="style.css">
    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <title>Home</title>
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
    <div id="pg-gegevens" style="padding-top:0px">
        <h1 id="Dashboard">Dashboard</h1><br>
        <p>Welkom <?php echo $_SESSION['voornaam'];?></p>
        <a href="logout.php">Logout</a>

        <?php
        include ('db/config.php');
        $results = $connect->prepare("SELECT * FROM factuur ORDER BY idfactuur");
        $results->execute();

        ?>

    </div>
<footer style="bottom: auto">
</footer>
</body>
</html>