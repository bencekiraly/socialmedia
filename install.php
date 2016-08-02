<?php
$mysql_host = "localhost";
$mysql_database = "social";
$mysql_user = "root";
$mysql_password = "";

// Create connection

$connect = new mysqli($mysql_host, $mysql_user, $mysql_password);

$createdb = "CREATE DATABASE $mysql_database";
mysqli_query($connect, $createdb);


# MySQL with PDO_MYSQL  
$db = new PDO("mysql:host=$mysql_host;dbname=$mysql_database", $mysql_user, $mysql_password);

$query = file_get_contents("dbframe.sql");

$stmt = $db->prepare($query);

if ($stmt->execute()){
     echo "Siker!<br/>";
}else{ 
     echo "Hiba!<br/>";
}
    echo "Felhasználó1 email: teszt@elek.hu<br/>";
    echo "Felhasználó1 jelszó: teszt<br/>";
    echo "Felhasználó2 email: segit@elek.hu<br/>";
    echo "Felhasználó2 jelszó: segit<br/>";
 
?>




