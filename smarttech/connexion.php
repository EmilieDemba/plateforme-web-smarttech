<?php
$servername = "localhost";  
$username = "root";         
$password = "";             
$dbname = "smarttech_db";      

// Créer la connexion avec MySQLi
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Vérifier si la connexion a échoué
if (!$conn) {
    die("Échec de la connexion : " . mysqli_connect_error());
}
?>

