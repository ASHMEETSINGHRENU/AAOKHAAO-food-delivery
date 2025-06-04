<?php
$server = "localhost";
$usernames = "root";
$password = "";
$database = "fos_db";

$conn = mysqli_connect($server, $usernames, $password, $database);
if (!$conn){
    die("Error". mysqli_connect_error());
}

?>
