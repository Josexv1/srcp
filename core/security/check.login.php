<?php
if (! defined ( 'SRCP' )) {
  die ( "Logged Hacking attempt!" );
}
// TODO Revisar si el usuario esta logueado con un identificador, y si no lo esta seleccionarlo como OFFLINE. Resetear el token del login al cabo de expiracion de la cookie.
if (!empty($_POST['login'])){
        $query = "  SELECT  ID,
                            password,
                            salt,
                            correo,
                            nivel,
                            logueado
                    FROM  usuarios
                    WHERE correo = :correo
                 ";
        $query_params = array(
            ':correo' => $_POST['correo']
        );
        try{
            $stmt = $db->prepare($query);
            $result = $stmt->execute($query_params);
        } //fin try
        catch(PDOException $ex){
    echo "<div class='panel-body'>
                    <div class='alert alert-warning alert-dismissable'>
                        <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                        Tenemos problemas al ejecutar la consulta :c El error es el siguiente:
          </div>
        </div>" .$ex->getMessage();
    }//fin catch
        $row = $stmt->fetch();
        if ($row['logueado'] === 'SI') {
      header("Location: index.php?do=login&accion=logueado");
      exit;
    }//fin logueado = si
    $login_ok = false;
    $id_usuario = $row['ID'];
        if($row){
            $check_password = hash('sha512', $_POST['password'] . $row['salt']);
            for($round = 0; $round < 65536; $round++){
                $check_password = hash('sha512', $check_password . $row['salt']);
            }
            if($check_password === $row['password']){
                $login_ok = true;
            }
        } //fin row

  if($login_ok){
      mt_srand (time());
      $numero_aleatorio = mt_rand(1000000,999999999);
      $logueado = 'SI';
      $login_ok = true;
      $query = "UPDATE usuarios
                SET cookie = :numero, logueado = :logueado
                WHERE correo = :correo";
        $query_params = array(
      ':numero' => $numero_aleatorio,
            ':correo' => $_POST['correo'],
            ':logueado' => $logueado
        );
        try {
            $stmt = $db->prepare($query);
            $result = $stmt->execute($query_params);
        }//fin try
        catch(PDOException $ex){
          // error
          }//fin catch
  if ($_POST["recordar"]=="1"){
      setcookie("session", $numero_aleatorio, time()+(60*60*24*365));
  }//fin if recordar
  else{
      setcookie("session", $numero_aleatorio, time()+(60*60));
    }//fin else
    $login_ok = true;
    header("Location: index.php?do=panel");
    } //fin login_ok
    else{
   header("Location: index.php");
    }//fin else login_ok
}//fin post login padre!
?>
