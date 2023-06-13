<?php
$host='localhost';
$utilisateur='root';
$password='root';
$bdd='vente';
$cnx=mysqli_connect($host,$utilisateur,$password,$bdd);
if(!$cnx){
    echo "No connected";
}

$cnx->set_charset("utf8mb4");
?>