<?php

if($_SESSION["grado"] == 10000) echo"Extra Admin";
else if($_SESSION["grado"] == 1000) echo"Extra Resp";
else if($_SESSION["grado"] == 100)  echo"No Permission";
else if($_SESSION["grado"] == 10) echo"No Permission";
else if($_SESSION["grado"] == 1) echo"No Permission";
else echo"No Permission";