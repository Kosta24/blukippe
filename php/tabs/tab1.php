<?php
//Nella tab dici che cosa ogni utente vede nella tab 1
//in questo caso tutti dovranno vedere Gli eventi ma può essere che in futuro tu voglia che utenti diversi vedano cose diverse per ogni tab
if($_SESSION["grado"] == 10000)      include dirname(__FILE__)."/eventi/index.php";
else if($_SESSION["grado"] == 1000) include dirname(__FILE__)."/eventi/index.php";
else if($_SESSION["grado"] == 100) include dirname(__FILE__)."/eventi/index.php";
else if($_SESSION["grado"] == 10) include dirname(__FILE__)."/eventi/index.php";
else if($_SESSION["grado"] == 1) include dirname(__FILE__)."/eventi/index.php";
else echo"No Permission";