<?php
    // Variables para conectar a la DB MySQL
    $username = "root";
    $password = "";
    $host = "localhost";
    $dbname = "proyecto";
     // Opciones de la conexion PDO a MySQL con un Fetch mode en ASSOC!

    $options = array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8');
    try { $db = new PDO("mysql:host={$host};dbname={$dbname};charset=utf8", $username, $password, $options); }
    catch(PDOException $ex){ die("Fallamos al conectarnos a la base de datos, el error es el siguiente: " . $ex->getMessage());}
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    header('Content-Type: text/html; charset=utf-8');

?>