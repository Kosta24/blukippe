<?php
require_once "../../config.php";
if (session_status() === PHP_SESSION_NONE) {
  session_start();
}
//Funzioni da Fare
//Controllo Disponibilità
/*Inizia dall'ora: 00 del giorno dell'evento e va fino all'ora+slots dell'evento che vogliamo aggiungere*/
/*Se non trova nulla restituisce 1 altrimenti restituisce 2*/


/*Aggiungi Evento1*/
//Aggiungi Evento2 copia dell'evento1

//modifica evento1
//modifica Evento2

//elimina Evento1(flag annullato)
//elimina evento2

//Ricerca Smart Enti
//Ricerca Squadra

//Get Attività
//Get Disciplina

//Ricerca Smart ora//dopo Aver selezionato l'ora vengono mostrare dinamicamente le ore disponibili
//Calcolo Ore
//Controllo Locali
//Controllo Day Off
//Show Singolo Evento
//Ricerca Eventi Condizionale

//AGGIUNGI EVENTI AL PASSATO SOLO SE GRADO >10



//puoi riutilizzare risultati di un array facendo json_decode
function esempioelaborazione($giorno)
{

  // Convert JSON string to associative array
  $array = json_decode(getFreeHours($giorno), true);
  if ($array[0]["hour"][12] == 6) unset($array[0]);

  return var_dump($array);
}



function aggiungiSquadra()
{
  global $link;

  $slots = 2;
  $giorno = '2023-07-01 10:00:00';
  $disciplina = 'cose';
  $note = 'nessuna nota';
  $pubblico = 0;
  $arbitro = 0;
  $respSicurezza = 0;
  $annullato = 0;
  $riferimento = 1;
  $stato = 1;
  $fk_attivita = 1;
  $fk_locale = 1;
  $fk_squadra1 = 1;

  // Prepare the SQL statement with placeholders
  $sql = "INSERT INTO your_database.evento (slots, giorno, disciplina, note, pubblico, arbitro, respSicurezza, annullato, riferimento, stato, fk_attivita, fk_locale, fk_squadra1)
        VALUES (:slots, :giorno, :disciplina, :note, :pubblico, :arbitro, :respSicurezza, :annullato, :riferimento, :stato, :fk_attivita, :fk_locale, :fk_squadra1)";

  // Prepare the query
  $stmt = $link->prepare($sql);

  // Bind the parameter values
  $stmt->bindParam(':slots', $slots);
  $stmt->bindParam(':giorno', $giorno);
  $stmt->bindParam(':disciplina', $disciplina);
  $stmt->bindParam(':note', $note);
  $stmt->bindParam(':pubblico', $pubblico);
  $stmt->bindParam(':arbitro', $arbitro);
  $stmt->bindParam(':respSicurezza', $respSicurezza);
  $stmt->bindParam(':annullato', $annullato);
  $stmt->bindParam(':riferimento', $riferimento);
  $stmt->bindParam(':stato', $stato);
  $stmt->bindParam(':fk_attivita', $fk_attivita);
  $stmt->bindParam(':fk_locale', $fk_locale);
  $stmt->bindParam(':fk_squadra1', $fk_squadra1);

  // Execute the query
  if ($stmt->execute()) {
    return json_encode("Record inserted successfully");
  } else {
    return json_encode("Error inserting record.");
  }
}


function getEventi()
{
  global $link;

  $limit       = isset($_POST['limit'])      ? trim($_POST['limit']) : '';
  $disciplina  = isset($_POST['disciplina']) ? trim($_POST['disciplina']) : '';
  $stato       = isset($_POST['stato'])      ? trim($_POST['stato']) : '';
  $locale      = isset($_POST['locale'])     ? trim($_POST['locale']) : '';
  $pubblico    = isset($_POST['pubblico'])     ? trim($_POST['pubblico']) : '';
  $arbitro     = isset($_POST['arbitro'])     ? trim($_POST['arbitro']) : '';
  $sicurezza   = isset($_POST['sicurezza'])     ? trim($_POST['sicurezza']) : '';
  $annullato   = isset($_POST['annullato'])     ? trim($_POST['annullato']) : '';
  $attivita    = isset($_POST['attivita'])   ? trim($_POST['attivita']) : '';
  $ente        = isset($_POST['ente'])       ? trim($_POST['ente']) : '';
  $month       = isset($_POST['month'])       ? trim($_POST['month']) : '';

  if ($pubblico === "true")   $pubblico = 1;
  if ($pubblico === "false")  $pubblico = 0;
  if ($arbitro  === "true")    $arbitro = 1;
  if ($arbitro  === "false")   $arbitro = 0;
  if ($sicurezza === "true")  $sicurezza = 1;
  if ($sicurezza === "true")  $sicurezza = 0;
  if ($annullato === "true")  $annullato = 1;
  if ($annullato === "false") $annullato = 0;

  // Costruzione dello statement SQL condizionato
  $sql = "SELECT evento.id,giorno,slots,attivita.nome as attivita1,disciplina, ente1.nome as ente11, ente2.nome as ente21, evento.fk_locale, locale.nome as nomeLocale, note, arbitro,pubblico,respSicurezza,annullato,evento.fk_attivita,squadra1.fk_ente,squadra2.fk_ente, ente1.colore as colore FROM evento
            INNER JOIN squadra as squadra1 on squadra1.id = evento.fk_squadra1
            INNER JOIN ente as ente1 on ente1.id = squadra1.fk_ente
            INNER JOIN squadra as squadra2 on squadra2.id = evento.fk_squadra2
            INNER JOIN ente as ente2 on ente2.id = squadra2.fk_ente
            INNER JOIN locale on locale.id = evento.fk_locale
            INNER JOIN attivita on attivita.id = evento.fk_attivita
            WHERE 1=1 ";
  $bindings = [];
  $types = "";

  if (!empty($month)) {
    $sql .= " AND (MONTH(giorno) >= ?-1 AND MONTH(giorno) <= ?+1)";
    $bindings[] = intval($month);
    $bindings[] = intval($month);
    $types .= "ii";
  }

  if (!empty($ente)) {
    $sql .= " AND (squadra1.fk_ente = ? OR squadra2.fk_ente = ?)";
    $bindings[] = intval($ente);
    $bindings[] = intval($ente);
    $types .= "ii";
  }

  if (!empty($attivita)) {
    $sql .= " AND evento.fk_attivita = ?";
    $bindings[] = intval($attivita);
    $types .= "i";
  }

  if (!empty($annullato)) {
    $sql .= " AND evento.annullato = ?";
    $bindings[] = intval($annullato);
    $types .= "i";
  }

  if (!empty($arbitro)  && $sicurezza != 0) {
    $sql .= " AND evento.arbitro = ?";
    $bindings[] = intval($arbitro);
    $types .= "i";
  }

  if (!empty($pubblico)  && $sicurezza != 0) {
    $sql .= " AND evento.pubblico = ?";
    $bindings[] = intval($pubblico);
    $types .= "i";
  }

  if (!empty($sicurezza)  && $sicurezza != 0) {
    $sql .= " AND evento.respSicurezza = ?";
    $bindings[] = intval($sicurezza);
    $types .= "i";
  }


  if (!empty($disciplina)) {
    $sql .= " AND evento.disciplina = ?";
    $bindings[] = intval($disciplina);
    $types .= "s";
  }


  if (!empty($locale)) {
    $sql .= " AND evento.fk_locale = ?";
    $bindings[] = intval($locale);
    $types .= "i";
  }

  if (!empty($stato)) {
    $sql .= " AND evento.stato = ?";
    $bindings[] = intval($stato);
    $types .= "i";
  } else $sql .= " AND evento.stato = 1";

  $sql .= " ORDER BY giorno ASC";

  if (!empty($limit) && $limit != 0) {
    $sql .= " LIMIT ?";
    $bindings[] = intval($limit);
    $types .= "i";
  }


  // Preparazione dello statement
  $stmt = $link->prepare($sql);
  if (!empty($bindings)) {
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

function getEventiCalendario()
{
  $array = json_decode(getEventi(), true);
  for ($i = 0; $i < count($array); $i++) {
    $array[$i]["slots"]  = date('Y-m-d H:i:s', strtotime("+" . (60 * floatval($array[$i]["slots"])) . " minutes", strtotime($array[$i]["giorno"])));
    $array[$i]["slots"]  = str_replace(' ', 'T', $array[$i]["slots"]);
    $array[$i]["giorno"] = str_replace(' ', 'T', $array[$i]["giorno"]);
  }
  return json_encode($array);
}
//input, il giorno selezionato dall'utente nel quale intende aggiungere un evento
//Calcola tutte le ore che sono occupate e restituisce le ore libere di quella giornata
function getFreeHours($giorno)
{

  global $link;

  $sql = " CREATE TEMPORARY TABLE temp_slots (
              id INT AUTO_INCREMENT PRIMARY KEY,
              giorno TIMESTAMP,
              locale INT(10),
              slot FLOAT(5,2)
          );
  
          INSERT INTO temp_slots (giorno, slot)
          SELECT giorno, slots
          FROM evento
          WHERE LOCATE('" . $giorno . "', giorno) > 0 AND evento.stato = 1 AND evento.fk_locale = 1;
          
          WITH RECURSIVE slot_times AS (
              SELECT id, giorno AS slot_time, 1 AS slot1
              FROM temp_slots
              UNION ALL
              SELECT temp_slots.id, DATE_ADD(slot_times.slot_time, INTERVAL 1 HOUR), slot1 + 1
              FROM slot_times
              INNER JOIN temp_slots ON slot_times.id = temp_slots.id
              WHERE slot1 < temp_slots.slot
          )

             
            SELECT hour
            FROM (
              SELECT DATE_ADD(DATE('" . $giorno . "'), INTERVAL (HOUR.number) HOUR) AS hour
              FROM (
                SELECT 6 AS number UNION ALL
                SELECT 7 UNION ALL
                SELECT 8 UNION ALL
                SELECT 9 UNION ALL
                SELECT 10 UNION ALL
                SELECT 11 UNION ALL
                SELECT 12 UNION ALL
                SELECT 13 UNION ALL
                SELECT 14 UNION ALL
                SELECT 15 UNION ALL
                SELECT 16 UNION ALL
                SELECT 17 UNION ALL
                SELECT 18 UNION ALL
                SELECT 19 UNION ALL
                SELECT 20 UNION ALL
                SELECT 21 UNION ALL
                SELECT 22 UNION ALL
                SELECT 23
              ) AS HOUR
            ) AS subquery
            WHERE hour NOT IN(SELECT slot_time as HOUR FROM slot_times)
            order by hour ASC;";

  // Prepare the query
  // Execute the multiple statements
  if (mysqli_multi_query($link, $sql)) {
    $array = array();

    // Process each result set
    do {
      $result = mysqli_store_result($link);
    } while (mysqli_next_result($link));

    $array = mysqli_fetch_all($result, MYSQLI_ASSOC);
  } else {
    $link->close();
    return "error";
  }

  $link->close();
  return json_encode($array);
}

function getBusyHours($giorno, $id)
{
  $link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

  $sql = "CREATE TEMPORARY TABLE temp_slots (
                id INT AUTO_INCREMENT PRIMARY KEY,
                giorno TIMESTAMP,
                slot FLOAT(5,2),
               fk_locale int(10)
            );

            INSERT INTO temp_slots (giorno, temp_slots.slot,fk_locale)
            SELECT giorno, evento.slots, evento.fk_locale
            FROM evento
            WHERE LOCATE('" . $giorno . "', giorno) > 0 AND evento.stato = 1";

  if ($id != "") $sql = $sql . " AND evento.id =" . $id;
  $sql = $sql . ";";

  $sql = $sql . "WITH RECURSIVE slot_times AS (
                SELECT id, giorno AS slot_time, 1 AS slot1,temp_slots.fk_locale
                , temp_slots.slot as slot2
                FROM temp_slots
                UNION ALL
                SELECT temp_slots.id, DATE_ADD(slot_times.slot_time, INTERVAL 1 HOUR), slot1 + 1,temp_slots.fk_locale, slot_times.slot2-1.0
                FROM slot_times
                INNER JOIN temp_slots ON slot_times.id = temp_slots.id
                WHERE slot1 < temp_slots.slot
            )

          SELECT SUBSTRING(slot_time,12) as slot_time,
            CASE
                  WHEN slot2 >= 1 THEN 1.0
                  ELSE 0.5
                END AS durata, slot_times.fk_locale as locale
                FROM slot_times
                LEFT JOIN temp_slots ON slot_times.id = temp_slots.id
                WHERE temp_slots.id IS NOT NULL
                ORDER BY slot_time ASC;";

  if (mysqli_multi_query($link, $sql)) {
    $array = array();

    // Process each result set
    do {
      $result = mysqli_store_result($link);
    } while (mysqli_next_result($link));

    $array = mysqli_fetch_all($result, MYSQLI_ASSOC);
  } else {
    $link->close();
    return "error";
  }

  $link->close();
  return json_encode($array);
}


function getDiscipline()
{
  global $link;
  // Select query
  $sql = "SELECT * FROM disciplina";

  // Execute the query
  $result = $link->query($sql);
  $array = array();

  $array = mysqli_fetch_all($result, MYSQLI_ASSOC);

  $link->close();
  return json_encode($array);
}

function getLocali()
{
  global $link;
  // Select query
  $sql = "SELECT * FROM locale";

  // Execute the query
  $result = $link->query($sql);
  $array = array();

  $array = mysqli_fetch_all($result, MYSQLI_ASSOC);

  $link->close();
  return json_encode($array);
}

function getAttivita()
{
  global $link;
  // Select query
  $sql = "SELECT * FROM attivita";

  // Execute the query
  $result = $link->query($sql);
  $array = array();

  $array = mysqli_fetch_all($result, MYSQLI_ASSOC);

  $link->close();
  return json_encode($array);
}


function getEnti()
{
  global $link;
  // Select query
  $sql = "SELECT * FROM ente";

  // Execute the query
  $result = $link->query($sql);
  $array = array();

  $array = mysqli_fetch_all($result, MYSQLI_ASSOC);

  $link->close();
  return json_encode($array);
}


function smartSearch()
{
  global $link;
  $array = array();

  if (!is_int($_POST['limit']) != "integer") $_POST['limit'] = 0;
  if ($_POST['limit'] == 0) $_POST['limit'] = "999999999";


  $sql = "SELECT id,nome, LENGTH(nome) as lun from ente
              where LOCATE(?,nome) > 0
          group by nome
          order by  lun asc,nome asc
          Limit ?";
  //ricerca per corrispondenza
  //ordine per lunghezza inferiore

  $limit = mysqli_real_escape_string($link, $_POST['limit']);
  $written = mysqli_real_escape_string($link, $_POST["written"]);

  $stmt = $link->prepare($sql);
  $stmt->bind_param("si", $written, $limit);
  $stmt->execute();
  $result = $stmt->get_result();
  $array = $result->fetch_all(MYSQLI_ASSOC);
  mysqli_close($link);
  return json_encode($array);
}

function getSquadre()
{
  global $link;
  $array = array();

  $sql = "SELECT * from squadra
              where fk_ente = ?";
  //ricerca per corrispondenza
  //ordine per lunghezza inferiore

  $written = mysqli_real_escape_string($link, $_POST["value"]);

  $stmt = $link->prepare($sql);
  $stmt->bind_param("s", $written);
  $stmt->execute();
  $result = $stmt->get_result();
  $array = $result->fetch_all(MYSQLI_ASSOC);
  mysqli_close($link);
  return json_encode($array);
}


function checkGiornoDayOff($giorno)
{
}

function checkLocali($richiesto, $occupato)
{
  if ($richiesto == 1) return -1;
  if ($richiesto == 2 && !in_array($occupato, [7])) return -1;
  if ($richiesto == 3 && !in_array($occupato, [5, 6, 7])) return -1;
  if ($richiesto == 4 && !in_array($occupato, [5])) return -1;
  if ($richiesto == 5 && !in_array($occupato, [3, 4, 7])) return -1;
  if ($richiesto == 6 && !in_array($occupato, [3])) return -1;
  if ($richiesto == 7 && !in_array($occupato, [2, 3, 5])) return -1;
  return 0;
}


function checkOrari($giorno, $ora, $slots, $fullDCheck, $locale)
{
  //se full day aggiungere un controllo per vedere se ci sono occupate dopo l'ora iniziale

  $array = json_decode(getBusyHours($giorno, ""), true);
  //slot_time
  //durata
  //locale
  $ora =  strtotime($ora);
  $arrayTimes = array();
  if (isset($array)) for ($i = 0; $i < count($array); $i++) $arrayTimes[$i] = $array[$i]["slot_time"];


  $i = 0;
  //se l'evento è full day controllare che non ci sia qualcun altro che usa la palestra dopo di loro
  if ($fullDCheck == true) {
    for ($i = 0; $i < count($array); $i++)
      if (strtotime($array[$i]["slot_time"]) >= strtotime($ora) && checkLocali($locale, $array[$i]["locale"]) == -1) return -2;
  } else {
    //se l'evento non è full day controlla che a partire dalla durata non sia in conflitto con nessun altro evento già presente
    //se ci sono altri eventi inseriti controlla che il locale sia compatibile
    for ($i = 0; $i < $slots; $i++) {
      $temp_hour = date('H:i:s', strtotime("+" . (60 * $i) . " minutes", $ora));
      //se l'ora temporanea viene trovata nell'array controlla se c'è conflitto di locali
      if (in_array($temp_hour, $arrayTimes) && checkLocali($locale, $array[array_search($temp_hour, $arrayTimes)]["locale"]) == -1) return -3;
    }
  }

  return 0;
}

function linkEvents($corrente, $passato)
{
  $link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
  //qui prende tutti i dati e fa due ricerche nel db
  //1 per prendere l'elemento che è appena stato aggiunto al db
  //2 per prendere l'elemento precedente 
  $repeatCadenza    = isset($_POST['repeatCadenza']) ? $_POST['repeatCadenza'] : '';
  $currDate         = date('Y-m-d', strtotime("+" . (((int)$repeatCadenza) * $corrente) . " days", strtotime($_POST["dateSelect"])));
  $precDate         = date('Y-m-d', strtotime("+" . (((int)$repeatCadenza) * $passato)  . " days", strtotime($_POST["dateSelect"])));

  $hourSelect = $_POST["hourSelect"];
  $locale     = $_POST["localiSelect"];
  $giornoCurr = $currDate . " " . $hourSelect;
  $giornoPrec = $precDate . " " . $hourSelect;

  $array = array();

  //Get idCurr
  $sql = "SELECT id from evento
            where LOCATE(?, giorno) > 0 and fk_locale = ?";

  $stmt = $link->prepare($sql);
  $stmt->bind_param("si", $giornoCurr, $locale);
  $stmt->execute();
  $result = $stmt->get_result();
  $array = $result->fetch_all(MYSQLI_ASSOC);

  $idCurr = $array[0]["id"];

  //get idOld
  $sql = "SELECT id from evento
            where LOCATE(?, giorno) > 0 and fk_locale = ?";

  $stmt = $link->prepare($sql);
  $stmt->bind_param("si", $giornoPrec, $locale);
  $stmt->execute();
  $result = $stmt->get_result();
  $array = $result->fetch_all(MYSQLI_ASSOC);

  $idPrec = $array[0]["id"];


  // Query SQL con statement preparato per modificare il record
  $sql = "UPDATE evento SET fk_nextEvento = ? WHERE id = ?";

  $stmt = $link->prepare($sql);

  // Binding dei parametri
  $stmt->bind_param("si", $idCurr, $idPrec);

  // Esecuzione dello statement preparato
  if ($stmt->execute()) {
    return;
  } else {
    echo "Errore durante la modifica del record: " . $stmt->error;
  }
}


//calcola quanti slots devi calcolare per occupare tutta la giornata in caso d ifull day
function getSlotsFullDay($ora)
{
  $timestamp = strtotime($ora);

  // Ottieni l'ora e i minuti dalla data
  $hours = date('H', $timestamp);
  $minutes = date('i', $timestamp);

  // Calcola il numero di ore come frazione dei minuti totali in un'ora
  $hoursFloat = $hours + ($minutes / 60);
  $slots = 24.0 - $hoursFloat;
  return $slots;
}


function addEvent($repeated, $repeated_prec)
{
  $link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
  //AGGIUNGI EVENTI AL PASSATO SOLO SE GRADO >10
  $return = 0;

  $repeatCheck        = $_POST["repeatCheck"];
  $fullDCheck         = $_POST["fullDCheck"];
  $localiSelect       = $_POST["localiSelect"];
  $disciplineSelect   = $_POST["disciplineSelect"];
  $attivitaSelect     = $_POST["attivitaSelect"];
  $arbitroCheck       = $_POST["arbitroCheck"];
  $pubblicoCheck      = $_POST["pubblicoCheck"];
  $respSicurezzaCheck = $_POST["respSicurezzaCheck"];
  $squadra1Select     = $_POST["squadra1Select"];
  $squadra2Select     = $_POST["squadra2Select"];
  $noteText           = $_POST["noteText"];
  $repeatCadenza      = isset($_POST['repeatCadenza']) ? $_POST['repeatCadenza'] : '';
  $repeatEndDate      = isset($_POST['repeatEndDate']) ? $_POST['repeatEndDate'] : '';
  $dateSelect         = date('Y-m-d', strtotime("+" . (((int)$repeatCadenza) * $repeated) . " days", strtotime($_POST["dateSelect"])));
  $hourSelect         = $_POST["hourSelect"];
  $slotsSelect        = $_POST["slotsSelect"];

  if ($repeatCheck === "true") $repeatCheck = 1;
  if ($repeatCheck === "false") $repeatCheck = 0;
  if ($fullDCheck === "true") $fullDCheck = 1;
  if ($fullDCheck === "false") $fullDCheck = 0;
  if ($arbitroCheck === "true") $arbitroCheck = 1;
  if ($arbitroCheck === "false") $arbitroCheck = 0;
  if ($pubblicoCheck === "true") $pubblicoCheck = 1;
  if ($pubblicoCheck === "false") $pubblicoCheck = 0;
  if ($respSicurezzaCheck === "true") $respSicurezzaCheck = 1;
  if ($respSicurezzaCheck === "false") $respSicurezzaCheck = 0;

  //return json_encode($fullDCheck);
  //return var_dump(getBusyHours($dateSelect,""));
  $giorno = $dateSelect . " " . $hourSelect;
  if ($squadra2Select == "") $squadra2Select = $squadra1Select;
  //checkGiornoDayOff($dateSelect);//funzione che controlla che il giorno nel quale si vuole inserire non sia un giorno di day off
  //check Che l'ora non sia durante qualcos'altro se lo è allora controllare i locali
  $returnCheckOrari = checkOrari($dateSelect, $hourSelect, $slotsSelect, $fullDCheck, $localiSelect);
  if ($returnCheckOrari < 0) $return = $returnCheckOrari;
  if ($fullDCheck) $slotsSelect = getSlotsFullDay($hourSelect);
  if ($return < 0 && $repeated == 0) return json_encode($return); //se è la prima volta che si ripete allora si assicura ce non ci siano errori

  //ESEGUE LA QUERY SOLO SE NON CI SONO STATI ERRORI
  if ($return >= 0) {
    //fare una cosa che se è full day calcola il numero di slots da mettere quindi fare 24-ora di inizio
    $sql = "insert into evento(riferimento,giorno,slots,fk_locale,disciplina,fk_attivita,arbitro,pubblico,respSicurezza,fk_squadra1,fk_squadra2,note,stato) values
    (?,?,?,?,?,?,?,?,?,?,?,?,1)";
  } else { //se c'è stato un errore aggiungi comunque l'evento al db ma con codice 2
    $sql = "insert into evento(riferimento,giorno,slots,fk_locale,disciplina,fk_attivita,arbitro,pubblico,respSicurezza,fk_squadra1,fk_squadra2,note,stato) values
    (?,?,?,?,?,?,?,?,?,?,?,?,2)";
  }

  // Preparazione dello statement
  $stmt = $link->prepare($sql);

  $types = 'isdisiiiiiis';
  $stmt->bind_param($types, ...[
    $repeatCheck, $giorno, $slotsSelect,
    $localiSelect, $disciplineSelect, $attivitaSelect,
    $arbitroCheck, $pubblicoCheck, $respSicurezzaCheck,
    $squadra1Select, $squadra2Select, $noteText
  ]);

  if ($stmt === false) {
    die("Errore nella preparazione dello statement: " . $link->error);
  }
  $stmt->execute();



  //controlla se la data è minore allora ripete
  if ($repeatCheck) {
    if ($repeated > 0 && $return >= 0) linkEvents($repeated, $repeated_prec);
    $timestamp1 = strtotime($dateSelect);
    $timestamp2 = strtotime($repeatEndDate);

    if (strtotime("+$repeatCadenza days", $timestamp1) <= $timestamp2) {
      //se $return è 0 allora aggiungi al precedente il riferimento al precedente
      //se $return è != 0 ma la data+cadenza è ancora minore della data di fine allora provi ad andare avanti e ti salvi la cadenza precedente
      //es sei sulla 4, ma ti da errore allora vai alla 5 avendo la 3 come precedente
      //se $return !=0 allora aggiungi comunque l'evento ma lo aggiungi con stato 2
      if ($return >= 0) $return = (int)addEvent($repeated + 1, $repeated); //se tutto è ok allora manda il successivo
      else $return = (int)addEvent($repeated + 1, $repeated_prec);       //se ci sono stati errori allora salta questo 
    } else {
      mysqli_close($link);
      $return = $repeated;
    }
  } else {
    mysqli_close($link);
    $return = 0;
  }

  return json_encode($return);
}

if ($_POST["function"] == "getFreeHours") echo getFreeHours($_POST["inputDate"]);
if ($_POST["function"] == "getDiscipline") echo getDiscipline();
if ($_POST["function"] == "smartSearch") echo smartSearch();
if ($_POST["function"] == "getSquadre") echo getSquadre();
if ($_POST["function"] == "getLocali") echo getLocali();
if ($_POST["function"] == "getAttivita") echo getAttivita();
if ($_POST["function"] == "addEvent") echo addEvent(0, 0);
if ($_POST["function"] == "getEventi") echo getEventi();
if ($_POST["function"] == "getEnti") echo getEnti();
if ($_POST["function"] == "getEventiCalendario") echo getEventiCalendario();
