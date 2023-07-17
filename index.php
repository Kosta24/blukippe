<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
  }
if(!isset($_SESSION['tab']))$_SESSION['tab'] = 'tab1';
if(!isset($_SESSION['subTab']))$_SESSION['subTab'] = 1;
$_SESSION["grado"] = 10000;


include "php/header.php";
include "php/body.php";

echo "<br>";
echo var_dump($_SESSION)."<br>";
echo var_dump($_SESSION["subTab"]);
include "php/footer.php";

















