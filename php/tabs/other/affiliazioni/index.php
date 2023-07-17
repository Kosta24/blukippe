<?php

if($_SESSION["grado"] == 10000) echo"Affiliazioni Admin";
else if($_SESSION["grado"] == 1000) echo"Affiliazioni Resp";
else if($_SESSION["grado"] == 100)  echo"No Permission";
else if($_SESSION["grado"] == 10) echo"No Permission";
else if($_SESSION["grado"] == 1) echo"No Permission";
else echo"No Permission";