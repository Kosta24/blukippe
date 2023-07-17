<?php
require_once "../../config.php";
if (session_status() === PHP_SESSION_NONE) {
    session_start();
  }

  function getEnti()
  {
    global $link;

    // Costruzione dello statement SQL condizionato
    $sql = "SELECT ente.*,assoctipo.tipo as tipo,tipopagamento.tipo as tipoPagamento FROM ente
            INNER JOIN assoctipo on assoctipo.id = ente.fk_tipo 
            INNER JOIN tipopagamento on tipopagamento.id = ente.fk_tipoPagamento
            WHERE 1=1";
    $bindings = [];

    // Preparazione delle variabili per la ricerca
    $id        = isset($_POST['id']) ? $_POST['id'] : '';
    $nome      = isset($_POST['nome']) ? $_POST['nome'] : '';
    $pIva      = isset($_POST['pIva']) ? $_POST['pIva'] : '';
    $codFisc   = isset($_POST['codFisc']) ? $_POST['codFisc'] : '';
    $SDI       = isset($_POST['SDI']) ? $_POST['SDI'] : '';
    $IBAN      = isset($_POST['IBAN']) ? $_POST['IBAN'] : '';
    $telefono  = isset($_POST['telefono']) ? $_POST['telefono'] : '';
    $cellulare = isset($_POST['cellulare']) ? $_POST['cellulare'] : '';
    $email     = isset($_POST['email']) ? $_POST['email'] : '';
    $pec       = isset($_POST['pec']) ? $_POST['pec'] : '';
    $citta     = isset($_POST['citta']) ? $_POST['citta'] : '';
    $provincia = isset($_POST['provincia']) ? $_POST['provincia'] : '';
    $via       = isset($_POST['via']) ? $_POST['via'] : '';
    $ncivico   = isset($_POST['ncivico']) ? $_POST['ncivico'] : '';
    $cap       = isset($_POST['cap']) ? $_POST['cap'] : '';
    $paese     = isset($_POST['paese']) ? $_POST['paese'] : '';
    $fk_tipo   = isset($_POST['fk_tipo']) ? $_POST['fk_tipo'] : '';
    $fk_tipoPagamento = isset($_POST['fk_tipoPagamento']) ? $_POST['fk_tipoPagamento'] : '';
    $limit   = isset($_POST['limit']) ? $_POST['limit'] : '';


    if (!empty($id)) {
        $sql .= " AND ente.id = ?";
        $bindings[] = $id;
    }
    if (!empty($nome)) {
      $sql .= " AND LOCATE(?,nome) > 0";
      $bindings[] = $nome;
    }
    if (!empty($pIva)) {
      $sql .= " AND LOCATE(?,pIva) > 0";
      $bindings[] = $pIva;
    }
    if (!empty($codFisc)) {
      $sql .= " AND LOCATE(?,codFisc) > 0";
      $bindings[] = $codFisc;
    }
    if (!empty($SDI)) {
      $sql .= " AND LOCATE(?,SDI) > 0";
      $bindings[] = $SDI;
    }
    if (!empty($IBAN)) {
      $sql .= " AND LOCATE(?,IBAN) > 0";
      $bindings[] = $IBAN;
    }
    if (!empty($telefono)) {
      $sql .= " AND LOCATE(?,telefono) > 0";
      $bindings[] = $telefono;
    }
    if (!empty($cellulare)) {
      $sql .= " AND LOCATE(?,cellulare) > 0";
      $bindings[] = $cellulare;
    }
    if (!empty($email)) {
      $sql .= " AND LOCATE(?,email) > 0";
      $bindings[] = $email;
    }
    if (!empty($pec)) {
      $sql .= " AND LOCATE(?,pec) > 0";
      $bindings[] = $pec;
    }
    if (!empty($citta)) {
      $sql .= " AND LOCATE(?,citta) > 0";
      $bindings[] = $citta;
    }
    if (!empty($provincia)) {
      $sql .= " AND LOCATE(?,provincia) > 0";
      $bindings[] = $provincia;
    }
    if (!empty($via)) {
      $sql .= " AND LOCATE(?,via) > 0";
      $bindings[] = $via;
    }
    if (!empty($ncivico)) {
      $sql .= " AND LOCATE(?,ncivico) > 0";
      $bindings[] = $ncivico;
    }
    if (!empty($cap)) { 
      $sql .= " AND LOCATE(?,cap) > 0";
      $bindings[] = $cap;
    }
    if (!empty($paese)) {
      $sql .= " AND LOCATE(?,paese) > 0";
      $bindings[] = $paese;
    }
    if (!empty($fk_tipo)) {
      $sql .= " AND fk_tipo = ?";
      $bindings[] = $fk_tipo;
    }
    if (!empty($fk_tipoPagamento)) {
      $sql .= " AND fk_tipoPagamento = ?";
      $bindings[] = $fk_tipoPagamento;
    }

    $sql .= " ORDER BY id ASC";

    if (!empty($limit) && $limit != 0) {
      $sql .= " LIMIT ?";
      $bindings[] = intval($limit);
    }    

    
    // Preparazione dello statement
    $stmt = $link->prepare($sql);
    if (!empty($bindings)) {
      $types = str_repeat('s', count($bindings)); // 's' indica una stringa, modificare se necessario
      if (!empty($limit)) $types[strlen($types) - 1] = 'i';
      // Unisci i binding e lo statement
      $stmt->bind_param($types, ...$bindings);
    }
    if ($stmt === false) {
        die("Errore nella preparazione dello statement: " . $link->error);
    }
    $stmt->execute();

    // Ottieni risultati
    $result = $stmt->get_result();  
    $array = array();

    $array = mysqli_fetch_all($result, MYSQLI_ASSOC);
    // Chiusura delle risorse
    $stmt->close();
    $link->close();
    return json_encode($array);
  }

  function setEnte($idEnte)
  {
    if (!isset($_SESSION['condVar'])) $_SESSION["condVar"] = array(); 
    $_SESSION["condVar"]["idEnte"] = $idEnte; 

    return json_encode("var set with val ".$idEnte);
  }


  function getSquadre()
  {
    global $link;

    // Costruzione dello statement SQL condizionato
    $sql = "SELECT id, nome, atleti ,reps, fk_referente as referente, fk_tariffaBase as tariffaBase,
                  fk_disciplina as disciplina FROM squadra
            WHERE 1=1 AND fk_ente =".$_SESSION["condVar"]["idEnte"] ;
    $bindings = [];

    // Preparazione delle variabili per la ricerca
    $id        = isset($_POST['id']) ? $_POST['id'] : '';
    $nome      = isset($_POST['nome']) ? $_POST['nome'] : '';
    $atleti      = isset($_POST['atleti']) ? $_POST['atleti'] : '';
    $reps   = isset($_POST['reps']) ? $_POST['reps'] : '';
    $fk_referente       = isset($_POST['fk_referente']) ? $_POST['fk_referente'] : '';
    $fk_tariffaBase      = isset($_POST['fk_tariffaBase']) ? $_POST['fk_tariffaBase'] : '';
    $fk_disciplina  = isset($_POST['fk_disciplina']) ? $_POST['fk_disciplina'] : '';
    $limit   = isset($_POST['limit']) ? $_POST['limit'] : '';


    if (!empty($id)) {
        $sql .= " AND id = ?";
        $bindings[] = $id;
    }
    if (!empty($nome)) {
      $sql .= " AND LOCATE(?,nome) > 0";
      $bindings[] = $nome;
    }
    if (!empty($atleti)) {
      $sql .= " AND atleti= ?";
      $bindings[] = $atleti;
    }
    if (!empty($reps)) {
      $sql .= " AND reps = ?";
      $bindings[] = $reps;
    }
    if (!empty($fk_referente)) {
      $sql .= " AND afk_referente = ?";
      $bindings[] = $fk_referente;
    }
    if (!empty($fk_tariffaBase)) {
      $sql .= " AND fk_tariffaBase = ?";
      $bindings[] = $fk_tariffaBase;
    }
    if (!empty($fk_disciplina)) {
      $sql .= " AND fk_disciplina = ?";
      $bindings[] = $fk_disciplina;
    }
    

    $sql .= " ORDER BY id ASC";

    if (!empty($limit) && $limit != 0) {
      $sql .= " LIMIT ?";
      $bindings[] = intval($limit);
    }    

    
    // Preparazione dello statement
    $stmt = $link->prepare($sql);
    if (!empty($bindings)) {
      $types = str_repeat('s', count($bindings)); // 's' indica una stringa, modificare se necessario
      if (!empty($limit)) $types[strlen($types) - 1] = 'i';
      // Unisci i binding e lo statement
      $stmt->bind_param($types, ...$bindings);
    }
    if ($stmt === false) {
        die("Errore nella preparazione dello statement: " . $link->error);
    }
    $stmt->execute();

    // Ottieni risultati
    $result = $stmt->get_result();  
    $array = array();

    $array = mysqli_fetch_all($result, MYSQLI_ASSOC);
    // Chiusura delle risorse
    $stmt->close();
    $link->close();
    return json_encode($array);
  }

  function setSquadra($idSquadra)
  {
    if (!isset($_SESSION['condVar'])) $_SESSION["condVar"] = array(); 
    $_SESSION["condVar"]["idSquadra"] = $idSquadra; 

    return json_encode("var set with val ".$idSquadra);
  }


  function aggiungiSquadra()
  {
    global $link;

    // Costruzione dello statement SQL condizionato
    $sql = "INSERT INTO squadra (nome, atleti ,reps, fk_referente, fk_tariffaBase , fk_disciplina, fk_ente)
            values(";
    $bindings = [];

    // Preparazione delle variabili per la ricerca
    $nome             = isset($_POST['nome']) ? $_POST['nome'] : '';
    $atleti           = isset($_POST['atleti']) ? $_POST['atleti'] : '';
    $reps             = isset($_POST['reps']) ? $_POST['reps'] : '';
    $fk_referente     = isset($_POST['fk_referente']) ? $_POST['fk_referente'] : '';
    $fk_tariffaBase   = isset($_POST['fk_tariffaBase']) ? $_POST['fk_tariffaBase'] : '';
    $fk_disciplina    = isset($_POST['fk_disciplina']) ? $_POST['fk_disciplina'] : '';

    $sql .= "?,";
    $bindings[] = $nome;

    $sql .= "?,";
    $bindings[] = $atleti;

    $sql .= "?,";
    $bindings[] = $reps;

    $sql .= "?,";
    $bindings[] = $fk_referente;

    $sql .= "?,";
    $bindings[] = $fk_tariffaBase;

    $sql .= "?,";
    $bindings[] = $fk_disciplina;

    $sql .= "?)";
    $bindings[] = $_SESSION["condVar"]["idEnte"];

    // Preparazione dello statement
    $stmt = $link->prepare($sql);
    if (!empty($bindings)) {
      $types = 'siiiiii';
      // Unisci i binding e lo statement
      $stmt->bind_param($types, ...$bindings);
    }
    if ($stmt === false) {
        die("Errore nella preparazione dello statement: " . $link->error);
    }
    $stmt->execute();
    
    return json_encode("Aggiunta Squadra Riuscita");
  }



if ($_POST["function"] == "getEnti") echo getEnti();
if ($_POST["function"] == "setEnte") echo setEnte($_POST["id"]);
if ($_POST["function"] == "getSquadre") echo getSquadre();
if ($_POST["function"] == "setSquadra") echo setSquadra($_POST["id"]);
if ($_POST["function"] == "aggiungiSquadra") echo aggiungiSquadra();
