<?php
session_start();
unset($_SESSION["loggedin"]);
unset($_SESSION["username"]);
unset($_SESSION["userId"]);
header("location: /food-ordering-system/index.php");
?>