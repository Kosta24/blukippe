<?php

if($_SESSION["grado"] == 10000) echo"Registro Admin";
else if($_SESSION["grado"] == 1000) echo"Registro Resp";
else if($_SESSION["grado"] == 100) echo"Registro Mod";
else if($_SESSION["grado"] == 10) echo"No Permission";
else if($_SESSION["grado"] == 1) echo"No Permission";
else echo"No Permission";