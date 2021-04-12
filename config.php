<?php
    //Used to throw mysqli_sql_exceptions for database errors 
    // instead of a normal PHP warning
    mysqli_report(MYSQLI_REPORT_STRICT);
    
    /* Database credentials. Assuming you are running MySQL
    server with default setting (user 'root' with no password) 
    or use appuser
    */
    define('DB_SERVER', 'localhost');
    define('DB_USERNAME', 'serge'); 
    define('DB_PASSWORD', 'root');
    define('DB_NAME', 'sergeMart');
     
    /* Attempt to connect to MySQL database */
    try{
        $mysqli = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
        }
    catch(mysqli_sql_exception $e){
        throw $e;
        }

?>