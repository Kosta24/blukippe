<?php
if ($_SESSION["subTab"] == 1 || $_SESSION["subTab"] == 2 ){
    if($_SESSION["grado"] == 10000)      include dirname(__FILE__)."/ente/index.php";
    else if($_SESSION["grado"] == 1000) include dirname(__FILE__)."/ente/index.php";
    else if($_SESSION["grado"] == 100) include dirname(__FILE__)."/ente/index.php";
    else if($_SESSION["grado"] == 10) include dirname(__FILE__)."/ente/index.php";
    else if($_SESSION["grado"] == 1) echo"No Permission";
    else echo"No Permission";
}
else if ($_SESSION["subTab"] == 3 || $_SESSION["subTab"] == 4){
    if($_SESSION["grado"] == 10000)      include dirname(__FILE__)."/squadre/index.php";
    else if($_SESSION["grado"] == 1000) include dirname(__FILE__)."/squadre/index.php";
    else if($_SESSION["grado"] == 100) include dirname(__FILE__)."/squadre/index.php";
    else if($_SESSION["grado"] == 10) include dirname(__FILE__)."/squadre/index.php";
    else if($_SESSION["grado"] == 1) echo"No Permission";
    else echo"No Permission";
}
else echo"No Permission";