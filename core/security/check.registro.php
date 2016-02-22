<?php
if (! defined ( 'SRCP' )) {
    die ( "Logged Hacking attempt!" );
}
if (!empty($_POST['registro']))
    {
  /*// TODO implementar bien las validaciones.
  // Nos aseguramos de que todos los campos esten correctos, por si se saltan la validacion HTML5
        if(empty($_POST['nombre']))
        {
    echo "ERROR: del nombre";
                header('Location: registro.php?accion=error');
                exit;
    }
        if(empty($_POST['apellido']))
        {
      echo "ERROR del apellido";
              header('Location: registro.php?accion=error');
              exit;
    }
    if(empty($_POST['correo']))
        {
      echo "ERROR del correo";
            header('Location: registro.php?accion=error');
            exit;
      }
        if(!filter_var($_POST['correo'], FILTER_VALIDATE_EMAIL))
        {
    echo "Este correo no es valido";
    header('Location: registro.php?accion=error');
    exit;
    }
    if(empty($_POST['telefono']))
        {
    echo "ERROR DEL TELEFONO";
            header('Location: registro.php?accion=error');
            exit;
    }
if(strlen($_POST['password']) < 7){ //verificamos que la clave tenga mas de 7 digitos para que tenga algo de seguridad.
  echo "ERROR: La contraseña no puede tener menos de 7 caracteres";
      header('Location: registro.php?accion=error');
      exit;
  }
if(strlen($_POST['telefono']) < 11){ //verificamos que el telefono tenga 11 digitos, formato de venezuela.
  echo "Error el telefono debe tener 11 caracteres.";
      header('Location: registro.php?accion=error');
      exit;
  }

  if($_POST['password'] != $_POST['repassword']){
    echo "Las contraseñas no concuerdan";
  }  */
        $query = "
            SELECT 1
            FROM usuarios
            WHERE correo = :correo
        ";
        $query_params = array( ':correo' => $_POST['correo'] );
        try {
            $stmt = $db->prepare($query);
            $result = $stmt->execute($query_params);
        }
        catch(PDOException $ex){
		echo "<div class='panel-body'>
        		<div class='alert alert-danger alert-dismissable'>
                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>Tenemos problemas al ejecutar la consulta :c El error es el siguiente:
				</div>" .$ex->getMessage();
				exit;
		}
        $row = $stmt->fetch();
        if($row){
				echo "<div class='panel-body'>
                <div class='alert alert-danger alert-dismissable'>
                    <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>El correo electronico ya está en uso. Intenta con otro.
					</div>";
					header('Location: index.php?accion=error');
					exit;
		}
        // TESTING NIVEL 1 = ADMINISTRADOR.
        $nivel = 1;
        $query = "
            INSERT INTO usuarios (
                nombre,
                apellido,
				correo,
                telefono,
                direccion,
                password,
                salt,
                cedula,
                nivel
            ) VALUES (
                :nombre,
                :apellido,
                :correo,
                :telefono,
                :direccion,
                :password,
                :salt,
                :cedula,
                :nivel
            )
        ";
        $salt = str_replace('=', '.', base64_encode(mcrypt_create_iv(20)));
        $password = hash('sha512', $_POST['password'] . $salt);
        for($round = 0; $round < 65536; $round++){
         $password = hash('sha512', $password . $salt);
          }
        $query_params = array(
            ':nombre' => $_POST['nombre'],
			':apellido' => $_POST['apellido'],
            ':correo' => $_POST['correo'],
            ':telefono' => $_POST['telefono'],
            ':direccion' => $_POST['direccion'],
            ':password' => $password,
            ':salt' => $salt,
			':cedula' => $_POST['cedula'],
            ':nivel' => $nivel
        );
        try {
            $stmt = $db->prepare($query);
            $result = $stmt->execute($query_params);
        }
        catch(PDOException $ex){
			echo "<div class='panel-body'>
                     <div class='alert alert-warning alert-dismissable'>
                          <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                          Tenemos problemas al ejecutar la consulta :c El error es el siguiente:
					</div>" .$ex->getMessage();}
		header('Location: index.php?accion=registrado');
}
?>
