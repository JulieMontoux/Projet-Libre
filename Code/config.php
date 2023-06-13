<?php
// On définit les variables
$servername = 'localhost';
$username = 'root';
$password = '';
$database = 'vente';
// On établie la connexion
$mysqli = new mysqli($servername, $username, $password, $database);
// On vérifie la connexion
if($mysqli->connect_error){
    error_log('Connection error: ' . $mysqli->connect_error);
}
?>