<?php
session_start();
if(empty($_SESSION['email']))
{
    header("location:index.html");
    session_destroy();
}
?>
<!DOCTYPE html>
<a href="Logout.php">Logout</a>
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
    <div id="logowrap">
        <img src="Img/logo.png" id="logo">
    </div>
    <div id="menu">
        <div id="Home"><a href="index.html">Home</a></div>
        <div id="Producten"><a href="producten.html">Producten</a></div>
        <div id="Contact"><a href="contact.html">Contact</a></div>
        <div id="Login"><a href="login.php">Login</a></div>
        <div><a href="winkelmandje.html"></a>Winkelmandje</div>
    </div>
    <p>Welkom <?php echo $_SESSION['voornaam'];?></p>

    <h1 id="Dashboard">Dashboard</h1><br>
    <?php
    include ('db/config.php');
    $results = $connect->prepare("SELECT * FROM factuur ORDER BY idfactuur");
    $results->execute();

    ?>
</div>
<footer style="bottom: auto">
    <p>&copy; Copyright 2021</p>
</footer>
</body>
</html>