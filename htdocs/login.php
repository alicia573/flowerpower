<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel = "icon" type = "image/png" href = "Img/logo.png">
    <link rel="stylesheet" href="style.css">
    <title>Login</title>
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
        <div><a href="winkelmandje.html">Winkelmandje</a></div>
    </div>
    <div id="pg-gegevens">
        <h3>Login</h3>
        <div id="line"></div>
        <h4>Vul deze formulier in te loggen.</h4>
        <?php
        if(isset($error_message))
        {
            echo '<label class="text-danger">'.$error_message.'</label>';
        }
        ?>
        <form action="clients_login.php" method="POST" name="myForm" autocomplete="off">
            <label>Email
                <input type="email" name="email" class="text-box" required>
            </label>
            <label>Wachtwoord
                <input type="password" name="wachtwoord" class="text-box"  required>
            </label>
            <button type="submit" name="login" onclick="submitForm()" id="login-btn-client">Login</button>
        </form>

        <p>Heb je nog geen account dan kun je hier<a href="register.php" style="text-decoration: none; color: blue;"> Registreren.</a></p>
    </div>
</div>
<script type="text/javascript">
    function submitForm(){
        document.getElementsByName('email').value='';
        document.getElementsByName('wachtwoord').value='';
    }
</script>
    </div>


</div>
</body>
</html>