<?php
if ($_SESSION["subTab"] == 1){
    if($_SESSION["grado"] == 10000)     include dirname(__FILE__)."/10000.php";
    else if($_SESSION["grado"] == 1000) include dirname(__FILE__)."/1000.php";
    else if($_SESSION["grado"] == 100) include dirname(__FILE__)."/100.php";
    else if($_SESSION["grado"] == 10) include dirname(__FILE__)."/10.php";
    else if($_SESSION["grado"] == 1) echo"No Permission";
    else echo"No Permission";
}
else if ($_SESSION["subTab"] == 2){
    if($_SESSION["grado"] == 10000)     include dirname(__FILE__)."/10000Singola.php";
    else if($_SESSION["grado"] == 1000) include dirname(__FILE__)."/1000Singola.php";
    else if($_SESSION["grado"] == 100) include dirname(__FILE__)."/100Singola.php";
    else if($_SESSION["grado"] == 10) include dirname(__FILE__)."/10Singola.php";
    else if($_SESSION["grado"] == 1) echo"No Permission";
    else echo"No Permission";
}
else echo"No Permission";

