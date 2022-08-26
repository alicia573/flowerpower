<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel = "icon" type = "image/png" href = "Img/logo.png">
    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <link rel="stylesheet" href="style.css">
    <title>Medewerker Area</title>

</head>
<body>
<div id="wrapper">
    <?php
    //Login Success.php
    session_start();
    if(isset($_SESSION["username"]))
    {
        echo '<a href="../medewerkerArea.php" style="text-decoration: none; color: black"><h2 >Medewerker Area</h2 ></a>';
        echo '<h4>Welcome '.$_SESSION["username"].'</h4>';
        echo '<a href="Logout.php"><button type="button">Logout</button></a>';
    }
    else
    {
        header("location:logout.php");
        echo'error';

    }
    ?>
    <button id="buttonPost"><a href="test/postToClientArea.php">Post informatie voor klanten.</a></button>
    <button id="buttonClientsInformation"><a href="test/clientsInformation.php">Klanten gegevens</a></button>

</div>
</body>
</html>