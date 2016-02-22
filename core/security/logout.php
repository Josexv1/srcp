<?php

if (!defined('SRCP')) {
    die('Logged Hacking attempt!');
}
  $numero_aleatorio = mt_rand(1000000, 999999999);
  $logueado = 'NO';
  $query = 'UPDATE usuarios SET logueado = :logueado WHERE cookie = :usuario';
        $query_params = array(
            ':usuario' => $_COOKIE['session'],
            ':logueado' => $logueado,
        );
        try {
            $stmt = $db->prepare($query);
            $stmt->execute($query_params);
        } catch (PDOException $ex) {//TODO Agregar el error en un evento.
        }
  $login_ok = false;
  $id_usuario = 0;
  $numero_aleatorio = 0;
  setcookie('session', '', 0);
  header('Location: index.php?accion=salir');
