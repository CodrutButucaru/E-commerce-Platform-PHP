<?php
// verificam daca constantele nu sunt deja deifnite
if (!defined('DB_SERVER')) {
    define('DB_SERVER', 'localhost');
}

if (!defined('DB_USERNAME')) {
    define('DB_USERNAME', 'root');
}

if (!defined('DB_PASSWORD')) {
    define('DB_PASSWORD', '');
}

if (!defined('DB_DATABASE')) {
    define('DB_DATABASE', 'evenimentedb');
}

$connection = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE);

if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}
?>