<?php
$host = "localhost";
$db_user = "id15916792_alicia573";
$db_pass = "FDFn/?o6?v@K7)G*";
$dbname = "id15916792_flowerpower";

try {
    $connect = new PDO("mysql:host=$host; dbname=$dbname", $db_user, $db_pass);
    $connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

}
catch(PDOException $e)
{
    die($e);
}

?>
