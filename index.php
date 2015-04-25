<?php 
    //Requerimos la configuracion, de caso contrario no abrira la APP
    require("config.php"); 
if (isset($_COOKIE["id_usuario"]) && isset($_COOKIE["marca_aleatoria_usuario"])){
   //Tengo cookies memorizadas
   //además voy a comprobar que esas variables no estén vacías
   if ($_COOKIE["id_usuario"]!="" || $_COOKIE["marca_aleatoria_usuario"]!=""){
// comenzamos a pedir el password y correo de la DB
$query = "  SELECT 
                ID, 
                password, 
				        salt,
				        correo
            FROM usuarios 
            WHERE 
                ID = :id 
        "; 
        $query_params = array( 
            ':id' => $_COOKIE['id_usuario'] 
        ); 
         
        try{ 
            $stmt = $db->prepare($query); 
            $result = $stmt->execute($query_params); 
        } 
        catch(PDOException $ex){ 
		echo "<div class='panel-body'>
                            <div class='alert alert-warning alert-dismissable'>
                                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>Tenemos problemas al ejecutar la consulta :c El error es el siguiente: 
								</div>" .$ex->getMessage();
		} 
        $row = $stmt->fetch();
		header('Location: panel.php');
   }//FIN IF COOKIE VACIO
} // FIN ISSET COOKIE
    if(!empty($_POST)){ 
        $query = " 
            SELECT 
                ID, 
                password, 
				        salt,
				        correo
            FROM usuarios 
            WHERE 
                correo = :correo 
        "; 
        $query_params = array( 
            ':correo' => $_POST['correo'] 
        ); 
         
        try{ 
            $stmt = $db->prepare($query); 
            $result = $stmt->execute($query_params); 
        } 
        catch(PDOException $ex){ 
		//die("Failed to run query: " . $ex->getMessage()); 
		echo "<div class='panel-body'>
                            <div class='alert alert-warning alert-dismissable'>
                                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>Tenemos problemas al ejecutar la consulta :c El error es el siguiente: 
								</div>" .$ex->getMessage();
		} 

        
		$login_ok = false; 
        $row = $stmt->fetch(); 
		$id_usuario = $row['ID'];
        if($row){ 
            $check_password = hash('sha256', $_POST['password'] . $row['salt']); 
            for($round = 0; $round < 65536; $round++){
                $check_password = hash('sha256', $check_password . $row['salt']);
            } 
            if($check_password === $row['password']){
                $login_ok = true;
            } 
        } 
        if($login_ok){ 
		//INICIO DE LA COOKIE.
		
		if ($_POST["recordar"]=="1"){
      //es que pidió memorizar el usuario
      //1) creo una marca aleatoria en el registro de este usuario
      //alimentamos el generador de aleatorios
      mt_srand (time());
      //generamos un número aleatorio
      $numero_aleatorio = mt_rand(1000000,999999999);
      //2) meto la marca aleatoria en la tabla de usuario
	  

 $query = "UPDATE usuarios SET cookie = :numero WHERE correo = :correo";
        $query_params = array(
			':numero' => $numero_aleatorio,
            ':correo' => $_POST['correo']
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
								</div></div>" .$ex->getMessage();}
								
  // Aqui verificamos que el campo recordar este marcado si es 1, lo recordamos por 1 año, si no por 1 hora.
                if ($_POST["recordar"]=="1"){   
      //3) ahora meto una cookie en la computadora del usuario con el identificador del usuario y la cookie aleatoria
      setcookie("id_usuario", $id_usuario, time()+(60*60*24*365));
      setcookie("marca_aleatoria_usuario", $numero_aleatorio, time()+(60*60*24*365));
                }else{
                  // si recordar es 0 recordamos solo por 1 hora :))
    setcookie("id_usuario", $id_usuario, time()+(60*60));
    setcookie("marca_aleatoria_usuario", $numero_aleatorio, time()+(60*60));
                  }
    // FIN DE LA COOKIE.
    header("Location: index.php"); 
        } 
        else{ 
           //print("Fallo el inicio de sesion."); 
      header("Location: login.php?accion=pass_error"); 
        } 
    } 
	if(isset($_GET['accion'])){

    //chequeamos la accion.
    switch ($_GET['accion']) {
        case 'registrado':
            echo "<div class='modal fade' id='Alerta' tabindex='-1' role='dialog' aria-labeledby='AlertaLabel' aria-hidden='false'>
			 <div class='modal-dialog'>
                 <div class='modal-content'>
						  <div class='modal-header'>
					<button type='button' class='close' data-dismiss='modal' aria-hidden='true'>&times;</button>
							<h3>¡Felicidades!</h3>
						  </div>
						  <div class='modal-body'>
							<p>Te has registrado con exito!</p>
							<p> Ahora puedes acceder al sistema, por medio del panel que aparecera al cerrar esta ventana.</p>
						  </div>
						  <div class='modal-footer'>
<button type='button' class='btn btn-info' data-dismiss='modal'>¡Entiendo!</button>
						   </div>
                                    </div>
                                </div>
                            </div>";
            break;
        case 'pass_error':
							echo "<div class='modal fade' id='Alerta' tabindex='-1' role='dialog' aria-labeledby='AlertaLabel' aria-hidden='false'>
			 <div class='modal-dialog'>
                 <div class='modal-content'>
						  <div class='modal-header'>
					<button type='button' class='close' data-dismiss='modal' aria-hidden='true'>&times;</button>
							<h3>¡Houston, tenemos un problema!</h3>
						  </div>
						  <div class='modal-body'>
							<p> El usuario y la contraseña no coinciden con nuestros registros. Contacta al administrador de sistemas, si has olvidado tus datos de inicio de sesion.</p>
						  </div>
						  <div class='modal-footer'>
<button type='button' class='btn btn-info' data-dismiss='modal'>¡Entiendo!</button>
						   </div>
                                    </div>
                                </div>
                            </div>";
								break;

        case 'log_error':
							echo "<div class='modal fade' id='Alerta' tabindex='-1' role='dialog' aria-labeledby='AlertaLabel' aria-hidden='false'>
			 <div class='modal-dialog'>
                 <div class='modal-content'>
						  <div class='modal-header'>
					<button type='button' class='close' data-dismiss='modal' aria-hidden='true'>&times;</button>
							<h3>¡La página está protegida!</h3>
						  </div>
						  <div class='modal-body'>
							<p>Si quieres ingresar a la pagina anterior, debes entrar con tus datos al sistema primero!</p>
						  </div>
						  <div class='modal-footer'>
<button type='button' class='btn btn-info' data-dismiss='modal'>¡Entiendo!</button>
						   </div>
                                    </div>
                                </div>
                            </div>";
								break;
        case 'salir':
          echo "<div class='modal fade' id='Alerta' tabindex='-1' role='dialog' aria-labeledby='AlertaLabel' aria-hidden='false'>
       <div class='modal-dialog'>
                 <div class='modal-content'>
              <div class='modal-header'>
          <button type='button' class='close' data-dismiss='modal' aria-hidden='true'>&times;</button>
              <h3>¡Ha cerrado sesion correctamente!</h3>
              </div>
              <div class='modal-body'>
              <p>Hemos cerrado todas las conexiones con el sistema.</p>
              </div>
              <div class='modal-footer'>
<button type='button' class='btn btn-info' data-dismiss='modal'>¡Entiendo!</button>
               </div>
                                    </div>
                                </div>
                            </div>";
          break;
								    }
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
<title>SCPS</title>
<meta name="description" content="Sistema de control de profesores y secciones 1.0">
<meta name="viewport" content="width=device-width">
    <!-- Core CSS - Include with every page -->
    <link rel="stylesheet" type="text/css" href="assets/css/introjs.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/introjs-rtl.min.css">
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
  <div class="row">
    <div class="col-xs-8 col-sm-8 col-md-6 col-sm-offset-2 col-md-offset-3">
      <form name="form_login" method="post" action="index.php" role="form" data-step="6" data-intro="Bueno, aqui lo tienes, solo tienes que comenzar a utilizar el sistema, si aun tienes dudas verifica el FAQ. Suerte">
        <fieldset>
          <h1 align="center" data-step="1" data-intro="Bienvenido al tour del panel de login. Vamos a aprender a entrar al sistema!">Conectarse al SCPS.</h1>
          <hr class="colorgraph">
          <div class="form-group">
            <div class="input-group" data-validate="email">
            <input data-step="2" data-intro="En este campo deberas introducir tu correo electronico, recuerda colocar el @ y el dominio, ejemplo: Administrador@Sistema.com" name="correo" for="validate-email" type="email" required="required" class="form-control input-lg" id="correo" placeholder="Correo electronico"><span class="input-group-addon danger"><span class="fa fa-warning fa-fw"></span></span>
            </div>
          </div>
          <div class="form-group">
          <div class="input-group" data-validate="length" data-length="7">
            <input data-step="3" data-intro="Aquí deberas colocar tu contraseña, si tienes problemas contacta al administrador :)" name="password" type="password" required="required" class="form-control input-lg" id="password" placeholder="Contraseña" >
            <span class="input-group-addon danger"><span class="glyphicon glyphicon-remove"></span></span>
          </div></div>
          <span class="button-checkbox">Recordarme?
          <input data-step="4" data-intro="Este campo es crucial, si lo marcas te recordaremos por un dia, pero si no lo marcas, tu conexion solo durara 1 hora, despues de eso seras expulsado del sistema" type="checkbox" name="recordar" id="recordar" checked="checked" value="1">
          </span>
          
          
         <hr class="colorgraph">
          <div class="row">
            <div class="col-xs-6 col-sm-6 col-md-6">
              <input type="submit" name="Submit" value="Entrar" class="btn btn-lg btn-success btn-block">
            </div>
            <div class="col-xs-6 col-sm-6 col-md-6"> <a href="registro.php" target="_self" class="btn btn-lg btn-primary btn-block">Registrarse</a> </div>
          </div>
          <br>
                        <div class="panel panel-default">
                        <div class="panel-heading">
                            ¿Necesitas ayuda?
                        </div>
                        <div class="panel-body">
                            <button class="btn btn-primary btn-lg" data-toggle="modal" data-target="#Ayuda" type="button" data-step="5" data-intro="Si aun tienes problemas, puedes hacer click aqui! Hay informacion que te puede ser de utilidad">
                                ¡Ayuda!
                            </button>
                        <a class="btn btn-primary btn-lg btn-success" href="javascript:void(0);" onclick="javascript:introJs().setOption('showBullets', false).start();">¿Quieres un tour?</a>
                            <div class="modal fade" id="Ayuda" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                            <h4 class="modal-title" id="myModalLabel">Ayuda para loguearse.</h4>
                                        </div>
                                        <div class="modal-body">Entrar al <strong>SCPS</strong> es simple, solamente necesitas utilizar los datos proporcionados por el administrador de sistemas, los cuales constan de un correo electronico del formato "<strong>correo@electronico.com</strong>" y una "<strong>contraseña</strong>". Si necesitas más ayuda contacta con el <em>administrador de sistemas</em>.</br></br> Un ejemplo de un inicio de sesion correcto seria el siguiente.</br></br><h3>Usuario: <label class="label label-info">Miguel@correo.com</label></h3><h3>Contraseña: <label class="label label-primary">MiClaveSecreta</label> </h3>
                                        </div>
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
    <script type="text/javascript" src="assets/js/intro.min.js"></script>
    <!-- Scripts extra -->
    <script src="assets/js/validar.js"></script>  
    <script type="text/javascript">
    $(window).load(function(){
        $('#Alerta').modal('show');
    });
</script>
</body>
</html> 