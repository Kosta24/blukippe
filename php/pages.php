


<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
  }

if (!isset($_SESSION['subTab'])) $_SESSION["subTab"] = 1;

//cambia la subpage se viene selezionata
if(isset($_POST['subTab'])){
  $_SESSION["subTab"] = (int)$_POST['subTab'];
  //se si torna alla pagina principale di una tab
  if(isset($_SESSION["condVar"]) && $_SESSION["subTab"] == 1)unset($_SESSION["condVar"]);
}
if(isset($_POST['tab'])){
  //cancella la subpage solo se si sta cambiando pagina
  if(isset($_SESSION["tab"]) && $_SESSION["tab"] != $_POST['tab'] )$_SESSION["subTab"] = 1;
  //se si cambia pagina o subpagina allora la variabile condizionale viene cancellata   || $_SESSION["subTab"] != $_POST['subTab']
  if(isset($_SESSION["condVar"]) && ($_SESSION["tab"] != $_POST['tab'] || $_SESSION["subTab"] == 1))unset($_SESSION["condVar"]);
  //if(isset($_SESSION["condVar"]) && ($_SESSION["tab"] == $_POST['tab'] && $_SESSION["subTab"] == 1))unset($_SESSION["condVar"]);
  $_SESSION["tab"] = $_POST['tab'];
}  

if (isset($_POST['tab']) && $_POST['tab'] == "tab1") include dirname(__FILE__)."/tabs/tab1.php";
if (isset($_POST['tab']) && $_POST['tab'] == "tab2") include dirname(__FILE__)."/tabs/tab2.php";
if (isset($_POST['tab']) && $_POST['tab'] == "tab3") include dirname(__FILE__)."/tabs/tab3.php";
if (isset($_POST['tab']) && $_POST['tab'] == "tab4") include dirname(__FILE__)."/tabs/tab4.php";
if (isset($_POST['tab']) && $_POST['tab'] == "tab5") include dirname(__FILE__)."/tabs/tab5.php";
if (isset($_POST['subTab'])) include dirname(__FILE__)."/tabs//".$_SESSION["tab"].".php";//quando cambi subpage ricarica la tab



/*if(isset($_POST['function']) && $_POST['function']=="nascondi"){
  echo "";
}*/

/*if(isset($_POST['function']) && $_POST['function']=="modifica"){
  echo crea_modifica();
}*/
