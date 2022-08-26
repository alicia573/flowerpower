<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-sweetalert/1.0.1/sweetalert.min.js"></script>
<script src="https://cdn.bootcss.com/jquery/3.3.1/jquery.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.2.2/jquery.form.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">

<?php
include ('db/config.php');
$connect = new PDO("mysql:host=$host; dbname=$dbname", $db_user, $db_pass);
$connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

if(isset($_POST['submit'])) {

    $voornaam = $_POST['voornaam'];
    $achternaam = $_POST['achternaam'];
    $stad = $_POST['stad'];
    $adres = $_POST['adres'];
    $postcode = $_POST['postcode'];
    $telefoonnummer = $_POST['telefoonnummer'];
    $email = $_POST['email'];
    $wachtwoord = $_POST['wachtwoord'];
    $wachtwoord = password_hash($wachtwoord, PASSWORD_BCRYPT, array("cost" => 12));

    $insert = $connect->prepare("INSERT INTO flowerpower.klant
        (voornaam,achternaam,stad,adres,postcode,telefoonnummer,email,wachtwoord)
        values(:voornaam,:achternaam,:stad,:adres,:postcode,:telefoonnummer,:email,:wachtwoord)");
    $insert->bindParam(':voornaam', $voornaam);
    $insert->bindParam(':achternaam', $achternaam);
    $insert->bindParam(':stad', $stad);
    $insert->bindParam(':adres', $adres);
    $insert->bindParam(':postcode', $postcode);
    $insert->bindParam(':telefoonnummer', $telefoonnummer);
    $insert->bindParam(':email', $email);
    $insert->bindParam(':wachtwoord', $wachtwoord);
    $check = $connect->prepare( "SELECT 1 FROM klant WHERE email = ?");
    $user = $check->execute([$email]);
    $user = $check->fetch();


    if($user){
        echo '<script type="text/javascript">
            $(document).ready(function(){
            
              swal({
                    title: "Fout",
                    text: "Er is al een account aangemaakt met deze email",
                    type: "failed"
                }).then(function() {
                    window.location = "Register.php";
                });
              }); 
            </script>';
    }
    else{
        if($insert->execute()){
            header('location:register_confirmed.html');
        }else{
            echo'Some kind of a error';
        }
    }
}

?>