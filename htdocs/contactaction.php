<?php

include ('db/config.php');
if(isset($_POST['submit'])) {
    $message="yes";
    $voornaam = $_POST['voornaam'];
    $tussenvoegsel = $_POST['tussenvoegsel'];
    $achternaam = $_POST['achternaam'];
    $onderwerp = ['onderwerp'];
    $bericht = ['bericht'];
    $email= ['email'];


    $stmt = $connect->prepare("INSERT INTO mailbox (idbericht,voornaam,tussenvoegsel,achternaam,onderwerp,bericht,email,datum) 
        VALUES(:idbericht,:voornaam, :tussenvoegsel,:achternaam,:onderwerp, :bericht,:email,now())");
    $stmt->bindParam(":idbericht", $idbericht);
    $stmt->bindParam(":voornaam", $voornaam);
    $stmt->bindParam(":tussenvoegsel", $tussenvoegsel);
    $stmt->bindParam(":achternaam", $achternaam);
    $stmt->bindParam(":onderwerp", $onderwerp);
    $stmt->bindParam(":bericht", $bericht);
    $stmt->bindParam(":email", $email);
    $stmt->execute();
}
if(isset($_POST['submit'])){
    header('Location: emailHasBeenSent.html?send=true');

}


