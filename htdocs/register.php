<!doctype html>
<html lang="en">
<head>
    <link rel = "icon" type = "image/png" href = "Img/logo.png">
    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <title>Registreren</title>
    <link rel="stylesheet" href="style.css" ">
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
    <h2>Maak een account aan</h2>
    <h4>Vul deze formulier in om een account aan te maken.</h4>
    <form action="clients_config.php" method="post" id="register_form" autocomplete="off">
        <div class="reg-box">
            <label>Voornaam</label>
                <input type="text" name="voornaam" class="text-box" autocomplete="off" required>
        </div>
        <div class="reg-box">
            <label>Achternaam</label>
                <input type="text" name="achternaam" class="text-box" autocomplete="off" required>

        </div>
        <div class="reg-box">
            <label>Stad</label>
                <input type="text" name="plaats" class="text-box" autocomplete="off" required>

        </div>
        <div class="reg-box">
            <label>Adres</label>
                <input type="text" name="adres" class="text-box" autocomplete="off"required>

        </div>
        <div class="reg-box">
            <label >Postcode </label>
                <input type="text" name="postcode" class="text-box" autocomplete="off" required>

        </div>
        <div class="reg-box">
            <label>Telefoonnummer</label>
                <input type="tel" name="telefoonnummer" class="text-box" autocomplete="off" required>

        </div>
        <div class="reg-box">
            <label>Email</label>
                <input type="email" name="email" class="text-box" autocomplete="off" required>

        </div>
        <div class="reg-box">
            <label>Wachtwoord</label>
                <input type="password" name="wachtwoord" class="text-box" autocomplete="off" required>

        </div>
        <div class="reg-box">
            <button type="submit" name="submit" id="login-btn-client">Verstuur</button>
        </div>
    </form>
    <p>Heb je al een account dan kun je hier<a href="login.php" style="text-decoration: none; color: blue;"> Inloggen.</a></p>

</div>
</body>

</html>