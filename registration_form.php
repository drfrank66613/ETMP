<?php
$dbhost = "localhost";
$dbuser = "root";
$dbpass = "";
$dbname = "etmp";

if(!$con = mysqli_connect($dbhost,$dbuser,$dbpass,$dbname)){

    die("Connection Failed!")
}

if($_SERVER['REQUEST_METHOD'] == "POST"){

    
}

?>