<?php

if($_SESSION["grado"] == 10000) echo"Affiliazioni Associazioni Admin";
else if($_SESSION["grado"] == 1000) echo"Affiliazioni Associazioni Resp";
else if($_SESSION["grado"] == 100)  echo"No Permission";
else if($_SESSION["grado"] == 10) echo"No Permission";
else if($_SESSION["grado"] == 1) echo"No Permission";
else echo"No Permission";