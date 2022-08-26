<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-sweetalert/1.0.1/sweetalert.min.js"></script>
    <script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</head>
</html>
<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();
include ('db/config.php');

$connect = new PDO("mysql:host=$host; dbname=$dbname", $db_user, $db_pass);
$connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

if (isset($_POST["login"])) {
    $wachtwoord = $_POST['wachtwoord'];
    $email = $_POST['email'];

    $check = $connect->prepare("SELECT 1 FROM klant WHERE email = ?");
    $user = $check->execute([$email]);
    $user = $check->fetch(PDO::FETCH_ASSOC);
    $query = "SELECT * FROM klant WHERE email = :email";
    $select = $connect->prepare($query);
    $select->bindValue(':email', $email);
    $select->execute();
    $data = $select->fetch(PDO::FETCH_ASSOC);
    if($user){
        if(!$data){
            echo '<script type="text/javascript">
                $(document).ready(function(){

                    swal({
                            title: "Fout",
                            text: "email is fout",
                            type: "failed"
                        }).then(function() {
                        window.location = "login.php";
                    });
                      }); 
                    </script>';
        }else {
            $vaidatePassword = password_verify($wachtwoord,$data['wachtwoord']);
            if($vaidatePassword){
                $_SESSION['email'] = $data['email'];
                $_SESSION['voornaam'] = $data['voornaam'];
                header("location:profile.php");
            }else{
                echo '<script type="text/javascript">
                      $(document).ready(function(){
            
                      swal({
                            title: "Fout",
                            text: "Wachtwoord is niet juist",
                            type: "failed"
                        }).then(function() {
                            window.location = "KlantenInloggen.php";
                        });
                      }); 
                    </script>';
            }

        }
    }else{
        echo '<script type="text/javascript">
                      $(document).ready(function(){
           
                      swal({
                            title: "Fout",
                            text: "Er is geen account met deze mail.",
                            type: "failed"
                        }).then(function() {
                            window.location = "login.php";
                        });
                      }); 
                    </script>';
    }
}
?>