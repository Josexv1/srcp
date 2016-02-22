<?php
    // Variables para conectar a la DB MySQL
    $username = 'root';
    $password = '0000';
    $host = 'localhost';
    $dbname = 'proyecto';
     // Opciones de la conexion PDO a MySQL con un Fetch mode en ASSOC!

    $options = array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8');
    try {
        $db = new PDO("mysql:host={$host};dbname={$dbname};charset=utf8", $username, $password, $options);
    } catch (PDOException $ex) {
        echo "<div class='panel-body'>
                    <div class='alert alert-warning alert-dismissable'>
                          <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                          Tenemos problemas al ejecutar la consulta. El error es el siguiente:
                    </div>
                  </div>".$ex->getMessage();
    }
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    header('Content-Type: text/html; charset=utf-8');

    define('INC_DIR', ROOT_DIR.'/core/inc');
    define('STATIC_DIR', ROOT_DIR.'/core/static');
