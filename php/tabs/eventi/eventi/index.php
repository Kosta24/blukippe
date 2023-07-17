<?php

if($_SESSION["grado"] == 10000)     include dirname(__FILE__)."/10000.php";
else if($_SESSION["grado"] == 1000) include dirname(__FILE__)."/1000.php";
else if($_SESSION["grado"] == 100) include dirname(__FILE__)."/100.php";
else if($_SESSION["grado"] == 10) include dirname(__FILE__)."/10.php";
else if($_SESSION["grado"] == 1) include dirname(__FILE__)."/1.php";
else echo"No Permission";
