<?php
/* Database credentials. Assuming you are running MySQL
server with default setting (user 'root' with no password) */
define('DB_SERVER', 'localhost');//localhost
define('DB_USERNAME', 'root');//username che di base è root
define('DB_PASSWORD', '');//nessuna
define('DB_NAME', 'calendario_annuale_palestra');//nome del data
//define('DB_PORT', '3306');
 
/* Attempt to connect to MySQL database */
//$link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME,DB_PORT);
    $link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
 
// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}



?>