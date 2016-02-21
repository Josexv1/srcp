<?php
if (! defined ( 'SRCP' )) {
  die ( "Logged Hacking attempt!" );
}
  $numero_aleatorio = mt_rand(1000000,999999999);
  $logueado = 'NO';
  $query = "UPDATE usuarios SET logueado = :logueado WHERE ID = :usuario";
        $query_params = array(
            ':usuario' => $_COOKIE['id_usuario'],
            ':logueado' => $logueado
        );
        try {
            $stmt = $db->prepare($query);
            $result = $stmt->execute($query_params);
        }
        catch(PDOException $ex){//error
        }
  $login_ok=false;
  $id_usuario=0;
  $numero_aleatorio=0;
  setcookie( "session", "", 0 );
  header("Location: index.php");
  die();
