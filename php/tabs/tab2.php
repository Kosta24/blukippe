<?php

if($_SESSION["grado"] == 10000)      include dirname(__FILE__)."/registro/index.php";
else if($_SESSION["grado"] == 1000) include dirname(__FILE__)."/registro/index.php";
else if($_SESSION["grado"] == 100) include dirname(__FILE__)."/registro/index.php";
else if($_SESSION["grado"] == 10) include dirname(__FILE__)."/enti/index.php";
else if($_SESSION["grado"] == 1) echo"No Permission";
else echo"No Permission";