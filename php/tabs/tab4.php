<?php

if($_SESSION["grado"] == 10000)      include dirname(__FILE__)."/log/index.php";
else if($_SESSION["grado"] == 1000) include dirname(__FILE__)."/other/index.php";
else if($_SESSION["grado"] == 100)   echo"No Permission";
else if($_SESSION["grado"] == 10)  echo"No Permission";
else if($_SESSION["grado"] == 1) echo"No Permission";
else echo"No Permission";