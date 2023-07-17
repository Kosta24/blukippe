<?php
if ($_SESSION["subTab"] == 1){
    if($_SESSION["grado"] == 10000)      include dirname(__FILE__)."/utenti/index.php";
    else if($_SESSION["grado"] == 1000) include dirname(__FILE__)."/extra/index.php";
    else echo"No Permission";
}
else if ($_SESSION["subTab"] == 2){
    if($_SESSION["grado"] == 10000)      include dirname(__FILE__)."/extra/index.php";
    else if($_SESSION["grado"] == 1000) include dirname(__FILE__)."/tariffe/index.php";
    else echo"No Permission";
}
else if ($_SESSION["subTab"] == 3){
    if($_SESSION["grado"] == 10000)      include dirname(__FILE__)."/tariffe/index.php";
    else if($_SESSION["grado"] == 1000) include dirname(__FILE__)."/locali/index.php";
    else echo"No Permission";
}
else if ($_SESSION["subTab"] == 4){
    if($_SESSION["grado"] == 10000)      include dirname(__FILE__)."/locali/index.php";
    else if($_SESSION["grado"] == 1000) include dirname(__FILE__)."/attivita/index.php";
    else echo"No Permission";
}
else if ($_SESSION["subTab"] == 5){
    if($_SESSION["grado"] == 10000)      include dirname(__FILE__)."/attivita/index.php";
    else if($_SESSION["grado"] == 1000) include dirname(__FILE__)."/affiliazioni/index.php";
    else echo"No Permission";
}
else if ($_SESSION["subTab"] == 6){
    if($_SESSION["grado"] == 10000)      include dirname(__FILE__)."/affiliazioni/index.php";
    else if($_SESSION["grado"] == 1000) include dirname(__FILE__)."/affiliazioniFamiglie/index.php";
    else echo"No Permission";
}
else if ($_SESSION["subTab"] == 7){
    if($_SESSION["grado"] == 10000)      include dirname(__FILE__)."/affiliazioniFamiglie/index.php";
    else if($_SESSION["grado"] == 1000) include dirname(__FILE__)."/discipline/index.php";
    else echo"No Permission";
}
else if ($_SESSION["subTab"] == 8){
    if($_SESSION["grado"] == 10000)      include dirname(__FILE__)."/discipline/index.php";
    else echo"No Permission";
}
else echo"No Permission";