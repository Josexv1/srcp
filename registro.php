<?php
    require("config.php"); //Hacemos un requerimiento el archivo de configuracion.
    if(!empty($_POST))
    {
        // Nos aseguramos de que todos los campos esten correctos, por si se saltan la validacion HTML5
        if(empty($_POST['nombre']))
        {
		echo "<div class='panel-body'>
              <div class='alert alert-warning alert-dismissable'>
                   <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>Porfavor coloca el nombre correctamente.
								</div>";
								header('Location: registro.php?accion=error');
								exit;
		}
        if(empty($_POST['apellido']))
        {
			echo "<div class='panel-body'>
		  		 <div class='alert alert-warning alert-dismissable'>
			      <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>Porfavor coloca el apellido correctamente.
							</div>";
							header('Location: registro.php?accion=error');
							exit;
		}
		if(empty($_POST['correo']))
        {
			echo "<div class='panel-body'>
			  <div class='alert alert-warning alert-dismissable'>
		   <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>Porfavor coloca el correo correctamente.
						</div>";
						header('Location: registro.php?accion=error');
						exit;
	    }
        if(!filter_var($_POST['correo'], FILTER_VALIDATE_EMAIL))
        {
		echo "<div class='panel-body'>
	  <div class='alert alert-warning alert-dismissable'>
	   <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>El correo electronico tiene un formato invalido.
		</div>";
		header('Location: registro.php?accion=error');
		exit;
		}
		if(empty($_POST['telefono']))
        {
		echo "<div class='panel-body'>
	  <div class='alert alert-warning alert-dismissable'>
		   <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>Porfavor coloca el telefono correctamente.
						</div>";
						header('Location: registro.php?accion=error');
						exit;
		}

			//buscamos errores
	if(isset($error)){
	  foreach($error as $error){
				echo "<div class='panel-body'>
                       <div class='alert alert-danger alert-dismissable'>
                       <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>Hemos detectado los siguientes errores:</div>" .$error;
					   header('Location: registro.php?accion=error');
					   exit;
	  }
	}
if(strlen($_POST['password']) < 7){ //verificamos que la clave tenga mas de 7 digitos para que tenga algo de seguridad.
	echo "<div class='panel-body'>
          <div class='alert alert-danger alert-dismissable'>
          <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>La contraseña no puede tener menos de 7 caracteres.</div>";
		  header('Location: registro.php?accion=error');
		  exit;
	}
if(strlen($_POST['telefono']) < 11){ //verificamos que el telefono tenga 11 digitos, formato de venezuela.
	echo "<div class='panel-body'>
          <div class='alert alert-danger alert-dismissable'>
          <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>El telefono debe tener el siguiente formato -> \" 04165001020 \" con 11 caracteres de longitud</div>";
		  header('Location: registro.php?accion=error');
		  exit;
	}

	/*?>if($_POST['password'] != $_POST['passwordConfirm']){
		$error[] = 'Las contraseñas no concuerdan..';
	}*/

        // verificamos si el correo ya está en la base de datos
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
		//die("Fallamos al hacer la busqueda: " . $ex->getMessage());
		// si hay un error en la consulta nos muestra cual fue el error.
		echo "<div class='panel-body'>
        		<div class='alert alert-danger alert-dismissable'>
                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>Tenemos problemas al ejecutar la consulta :c El error es el siguiente:
				</div>" .$ex->getMessage();
				exit;
		}
        $row = $stmt->fetch();
        if($row){
		//die("El correo ya esta en uso");
		//si obtenemos las consultas y el correo es igual al que enviamos, nos nuestra el errror de que ya esta registrado.
				echo "<div class='panel-body'>
                            <div class='alert alert-danger alert-dismissable'>
                                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>El correo electronico ya está en uso. Intenta con otro.
								</div>";
								header('Location: registro.php?accion=error');
								exit;
		}

        /// Si todo pasa enviamos los datos a la base de datos mediante PDO para evitar Inyecciones SQL
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
                nivel,
                logueado
            ) VALUES (
                :nombre,
                :apellido,
                :correo,
                :telefono,
                :direccion,
                :password,
                :salt,
                :cedula,
                :nivel,
                :logueado
            )
        ";

        // Hacemos un salt para la seña y la encriptamos a numeros aleatorios en sha256 por seguridad.
        // Genero una sal aleatorea. En este caso uso mcrypt_create_iv y su
        // resultado lo traduzco a algo un poco mas "legible".
        $salt = str_replace('=', '.', base64_encode(mcrypt_create_iv(20)));
        $password = hash('sha512', $_POST['password'] . $salt);
        //  Incluimos unas 65536 rondas para el hash que queremos mostrar, asi el proceso es lento y hacemos costoso el bruteforce
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
            ':nivel' => $_POST['nivel'],
            ':logueado' => 'NO'
        );
        try {
            $stmt = $db->prepare($query);
            $result = $stmt->execute($query_params);
        }
        catch(PDOException $ex){
		// Si tenemos problemas para ejecutar la consulta imprimimos el error
			echo "<div class='panel-body'>
                     <div class='alert alert-warning alert-dismissable'>
                          <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>Tenemos problemas al ejecutar la consulta :c El error es el siguiente:
								</div>" .$ex->getMessage();}
			// Si todo pasa como deberia ser, referimos al usuario al panel de inicio de sesion con el mensaje de bienvenida.
		header('Location: index.php?accion=registrado');
}

	if(isset($_GET['accion'])){

    //check the action
    switch ($_GET['accion']) {
        case 'error':
            echo "<div class='panel-body'>
                            <div class='alert alert-success alert-dismissable'>
                                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>Hay varios errores en tu registro. Si necesitas ayuda puedes hacer click al boton de Ayuda en el fondo de la página.
								</div>";
            break;
    }

}
?>
<!DOCTYPE html>
<!--[if lt IE 7]>
<html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>
<html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>
<html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]>
<!-->
<html class="no-js">
<!--<![endif]-->
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<title>Sistema.</title>
<meta name="description" content="Sistema SRCP version. 0.0.1">
<meta name="viewport" content="width=device-width">
    <!-- Core CSS - Include with every page -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" />
    <link href="assets/font-awesome/4.2.0/css/font-awesome.css" rel="stylesheet" />
    <style type="text/css">.input-group-addon.primary {
    color: rgb(255, 255, 255);
    background-color: rgb(50, 118, 177);
    border-color: rgb(40, 94, 142);
}
.input-group-addon.success {
    color: rgb(255, 255, 255);
    background-color: rgb(92, 184, 92);
    border-color: rgb(76, 174, 76);
}
.input-group-addon.info {
    color: rgb(255, 255, 255);
    background-color: rgb(57, 179, 215);
    border-color: rgb(38, 154, 188);
}
.input-group-addon.warning {
    color: rgb(255, 255, 255);
    background-color: rgb(240, 173, 78);
    border-color: rgb(238, 162, 54);
}
.input-group-addon.danger {
    color: rgb(255, 255, 255);
    background-color: rgb(217, 83, 79);
    border-color: rgb(212, 63, 58);
}
</style>
      <!-- END CORE CSS -->
</head>
<body>
<div class="container">
  <div class="row" style="margin-top:0px">
    <div class="col-xs-12 col-sm-8 col-md-6 col-sm-offset-2 col-md-offset-3">
    <form action="registro.php" method="post" role="form" class="form-horizontal" name="form_registro">
    <fieldset>
          <h1 align="center">Registro del sistema.</h1>
          <hr class="colorgraph">
    <div class="form-group">
    <div class="input-group">
    <input type="text" name="nombre" class="form-control input-lg" placeholder="Nombre" id="nombre" onkeyup="this.value=this.value.toUpperCase()" required/><span class="input-group-addon danger"><span class="glyphicon glyphicon-remove"></span></span>
    </div></div>
    <div class="form-group">
    <div class="input-group">
    <input class="form-control input-lg" type="text" name="apellido" placeholder="Apellido" id="apellido" required/><span class="input-group-addon danger"><span class="glyphicon glyphicon-remove"></span></span>
    </div></div>
    <div class="form-group">
    <div class="input-group" data-validate="length" data-length="8">
    <input class="form-control input-lg" type="text" name="cedula" placeholder="Cédula" id="cedula" required/><span class="input-group-addon danger"><span class="glyphicon glyphicon-remove"></span></span>
    </div></div>
    <div class="form-group">
    <div class="input-group" data-validate="email">
    <input type="email" name="correo" class="form-control input-lg" placeholder="Tu@Correo.com" id="correo" required/><span class="input-group-addon danger"><span class="glyphicon glyphicon-remove"></span></span>
    </div></div>
    <div class="form-group">
    <div class="input-group" data-validate="length" data-length="7">
    <input class="form-control input-lg" type="password" name="password" placeholder="Contraseña" id="password" required/><span class="input-group-addon danger"><span class="glyphicon glyphicon-remove"></span></span>
    </div></div>
    <div class="form-group">
    <div class="input-group" data-validate="number">
    <input class="form-control input-lg" type="tel" name="telefono" placeholder="04169004050" id="telefono" required/><span class="input-group-addon danger"><span class="glyphicon glyphicon-remove"></span></span>
    </div></div>
    <div class="form-group">
    <div class="input-group">
    <input class="form-control input-lg" type="text" name="direccion" placeholder="Direccion" id="direccion" required/><span class="input-group-addon danger"><span class="glyphicon glyphicon-remove"></span></span>
    </div></div>
    <div class="form-group">
    <div class="input-group">
    <input class="form-control input-lg" type="text" name="nivel" placeholder="Nivel" id="nivel" required/><span class="input-group-addon danger"><span class="glyphicon glyphicon-remove"></span></span>
    </div></div>
     <div class="col-xs-6 col-sm-6 col-md-6">
    <a href="index.php"><input class="btn btn-lg btn-primary btn-block" value="Ir al login" /></a>
    </div>
    <div class="col-xs-6 col-sm-6 col-md-6">
    <input type="submit" name="enviar" value="Registrarse" class="btn btn-lg btn-success btn-block">
    </div></br></br></br>
    <div class="panel panel-default">
                        <div class="panel-heading">
                            ¿Necesitas ayuda?
                        </div>
                        <div class="panel-body">
                            <button class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal" type="button">
                                ¡Ayuda!
                            </button>
                            <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                            <h4 class="modal-title" id="myModalLabel">Ayuda para registrarse.</h4>
                                        </div>
                                        <div class="modal-body">Para registrarse solo debes colocar los datos solicitados. En cada campo veras una referencia de como deberia estar relleno el campo.</br></br> Recuerda que para el campo de CORREO, debes introducir un correo valido <h5>Ejemplo: <label class="label label-primary">Miguel@hotmail.com</label> </h5> Para la contraseña esta debe tener minimo 7 caracteres, y pueden ser numeros, letras y simbolos.</br></br> Para el campo del telefono deberas introducir todos los numeros seguidos incluidos el codigo de area.</br></br><h5>Numero de telefono: <label class="label label-info">04249876644</label> </h5></br>Esperamos que esta ayúda te sirva.</br></br>Si necesitas mas asistencia, puedes contactar con el administrador de sistemas.</div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-info" data-dismiss="modal">¡Entiendo!</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

</fieldset>
</form>

    </div>
  </div>
</div>
    <!-- Core Scripts - Include with every page -->
    <script src="assets/js/jquery.2.1.1.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <!-- Scripts extra -->
    <script src="assets/js/validar.js"></script>
    <script type="text/javascript">
    $(window).load(function(){
        $('#Alerta').modal('show');
    });
</script>
</body>
</html>
