<?php

if($_SESSION["grado"] == 10000)      include dirname(__FILE__)."/eventi/index.php";
else if($_SESSION["grado"] == 1000) include dirname(__FILE__)."/eventi/index.php";
else if($_SESSION["grado"] == 100) include dirname(__FILE__)."/eventi/index.php";
else if($_SESSION["grado"] == 10) include dirname(__FILE__)."/eventi/index.php";
else if($_SESSION["grado"] == 1) include dirname(__FILE__)."/eventi/index.php";
else echo"No Permission";