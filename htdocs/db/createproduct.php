<?php

include ('config.php');
if(isset($_POST['submit'])) {
    $message="yes";
    $naamproduct = $_POST['naamproduct'];
    $prijs = $_POST['prijs'];
    $omschrijving = $_POST['omschrijving'];
    $bestand = $_FILES['bestand']['name'];

    $allowTypes = array('jpg', 'png', 'jpeg', 'gif', 'pdf');

    move_uploaded_file($_FILES["bestand"]["tmp_name"], "../../htdocs/Img/" . $_FILES["bestand"]["name"]);
    $stmt = $connect->prepare("INSERT INTO artikel (idartikel,naamproduct,omschrijving,prijs,bestand,upload_date) 
        VALUES(:idartikel,:naamproduct, :omschrijving,:prijs,:bestand,now())");
    $stmt->bindParam(":idartikel", $idartikel);
    $stmt->bindParam(":naamproduct", $naamproduct);
    $stmt->bindParam(":omschrijving", $omschrijving);
    $stmt->bindParam(":prijs", $prijs);
    $stmt->bindParam(":bestand", $bestand);
    $stmt->execute();
}
if(isset($_POST['submit'])){
    $id = $_GET["posted"];
    echo $id;


}
$search = isset($_POST['search']) ? $_POST['search'] : FALSE;
$results = $connect->prepare("SELECT * FROM artikel WHERE artikel.naamproduct LIKE '$search%' ");
$send = $results->execute();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel = "icon" type = "image/png" href = "../Img/logo.png">
    <link rel="stylesheet" href="../style.css">
    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <title>Artikelen sturen Dashboard</title>
</head>
<body>
<div id="wrapper">
    <?php
    session_start();
    if(isset($_SESSION["username"]))
    {
        echo '<a href="../medewerkerArea.php" style="text-decoration: none; color: black"><h2 >Medewerker Area</h2 ></a>';
        echo '<h4>Welcome '.$_SESSION["username"].'</h4>';
    }
    else
    {
        header("location:../Medewerkerlogin.php");
        echo'error';

    }
    ?>
    <form id="article-form" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data">

        <label>Naamproduct:
            <input type="text" name="naamproduct" class="text-box" required>
        </label>
        <label>Omschrijving:
            <textarea name="omschrijving" class="text-area" required></textarea>
        </label>
        <label>Prijs:
            <textarea name="prijs" class="text-area" required></textarea>
        </label>
        <label>Bestanden:
            <input type="file" name="bestand" multiple>
        </label><br>
        <button name="submit" type="submit">Post</button>
    </form>
    <form id="search_column" action="" method="POST">
        <label for="search" id="search_text">Zoeken:
            <input id="search" name="search" type="text" placeholder="Zoek op naam..." value="" onclick="search_func(e)" required>
            <button id="btn-search" name="btn-search">Search</button>
        </label>
    </form>
    <div id="table_clients">
        <?php
        include ('config.php');
        ?>
        <table id="table">
            <tr id="table_">
                <th>idartikel</th>
                <th>naamproduct</th>
                <th>omschrijving</th>
                <th>prijs</th>
                <th>bestand</th>
                <th>upload_date</th>
            </tr>

            <?php
            while($row = $results->fetch(PDO::FETCH_ASSOC)){
            extract($row);
            ?>
            <tbody id="table_info">
            <tr >
                <td><?php echo $row['idartikel']; ?></td>
                <td><?php echo $row['naamproduct']; ?></td>
                <td><?php echo $row['omschrijving']; ?></td>
                <td><?php echo $row['prijs']; ?></td>
                <td><?php echo $row['bestand']; ?></td>
                <td><?php echo $row['upload_date']; }?></td>
            </tr>
            </tbody>
        </table>
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
