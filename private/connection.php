<?php 
    define('HOST', 'localhost');
    define('DBNAME', 'db_financias');
    define('USERNAME', 'root');
    define('PASSWORD', '');
    $conn = new PDO("mysql:host=".HOST.";dbname=".DBNAME.";charset=utf8", USERNAME, PASSWORD);
?>