<html lang="en">
<head>
    <link rel = "icon" type = "image/png" href = "../Img/logo.png">
    <link rel="stylesheet" href="../style.css">
    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js">
    </script>
    <title>Klanten info</title>
</head>
<body>
<div id="wrapper">
    <?php
    include ('config.php');
    session_start();
    if(isset($_SESSION["username"]))
    {
        echo '<a href="../medewerkerArea.php" style="text-decoration: none; color: black"><h2 >Medewerker Area</h2 ></a>';
        echo '<h4>Welcome  '.$_SESSION["username"].'</h4>';
        echo '<a href="../logout.php"><button type="button">Logout</button></a>';
        echo '<a href="../medewerkerArea.php"><button type="button">Terug</button></a>';


    }
    else
    {
        header("location:../logout.php");
        echo'error';
    }
    $search = isset($_POST['search']) ? $_POST['search'] : FALSE;
    $results = $connect->prepare("SELECT * FROM klant WHERE klant.voornaam LIKE '$search%' ");
    $send = $results->execute();
    ?>

    <form id="search_column" action="" method="POST">
        <label for="search" id="search_text">Zoeken:
            <input id="search" name="search" type="text" placeholder="Zoek op naam..." value="" onclick="search_func(e)" required>
            <button id="btn-search" name="btn-search">Search</button>
        </label>
    </form>

    <div id="table_clients">

        <table id="table">
            <tr id="table_">
                <th>ID</th>
                <th>Voornaam</th>
                <th>Achternaam</th>
                <th>Stad</th>
                <th>Adres</th>
                <th>Postcode</th>
                <th>Telefoonnummer</th>
                <th>Email</th>
                <th>Wachtwoord</th>
            </tr>

            <?php
            $results = $connect->prepare("SELECT * FROM klant WHERE voornaam LIKE '$search%' ");
            //$results->bindValue(':search'.'%'.$search.'%');
            $send = $results->execute();

            while($row = $results->fetch(PDO::FETCH_ASSOC)){
            extract($row);
            ?>
            <tbody id="table_info">
            <tr >
                <td><?php echo $row['ID']; ?></td>
                <td><?php echo $row['voornaam']; ?></td>
                <td><?php echo $row['achternaam']; ?></td>
                <td><?php echo $row['plaats']; ?></td>
                <td><?php echo $row['adres']; ?></td>
                <td><?php echo $row['postcode']; ?></td>
                <td><?php echo $row['telefoonnummer']; ?></td>
                <td><?php echo $row['email']; ?></td>
                <td><?php echo $row['wachtwoord']; }?></td>

            </tr>
            </tbody>
        </table>
    </div>
</div>
</body>
<script>
    function search_func(e){
        e = e || window.event;
        if(e.keyCode === 12)
        {
            document.getElementById('search').click();
            return false;
        }
        return true;
    }

</script>
</html>