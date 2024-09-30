<?php
// DB credentials.
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'odb');

// Establish database connection.
try {
    $dbh = new PDO("mysql:host=". DB_HOST. ";dbname=". DB_NAME, DB_USER, DB_PASS, array(
        PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'",
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_EMULATE_PREPARES => false
    ));
} catch (PDOException $e) {
    error_log("Error: ". $e->getMessage());
    // Handle the error, e.g., display a error page or send an email to the admin
}
?>