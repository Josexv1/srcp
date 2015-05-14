	<?php 
    require("config.php"); 
if (isset($_COOKIE["id_usuario"]) && isset($_COOKIE["marca_aleatoria_usuario"])){
   //Tengo cookies memorizadas
   //además voy a comprobar que esas variables no estén vacías
   if ($_COOKIE["id_usuario"]!="" || $_COOKIE["marca_aleatoria_usuario"]!=""){
// 
$query = "  SELECT  ID, 
                	password,
					salt,
					correo,
            FROM 	usuarios 
            WHERE 	ID = :id 
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
                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                Tenemos problemas al ejecutar la consulta :c El error es el siguiente: 
				</div>
			 " .$ex->getMessage();
		echo "</div>";
				} 
        $row = $stmt->fetch();
		header('Location: panel.php');
   } // Terminamos de probar la cookie
} // Fin del isset de la cookie.
    if(!empty($_POST)){ 
        $query = "  SELECT	ID, 
		                	password,
		                	salt,
		                	correo
		            FROM 	usuarios 
		            WHERE	correo = :correo 
        "; 
        $query_params = array( 
            ':correo' => $_POST['correo'] 
        ); 
         
        try{ 
            $stmt = $db->prepare($query); 
            $result = $stmt->execute($query_params); 
        } 
        catch(PDOException $ex){ 
		echo "<div class='panel-body'>
                    <div class='alert alert-warning alert-dismissable'>
                        <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                        Tenemos problemas al ejecutar la consulta :c El error es el siguiente: 
					</div>
			  </div>" .$ex->getMessage();
		} 
        
		$login_ok = false; 
        $row = $stmt->fetch(); 
		$id_usuario = $row['ID'];
        if($row){ 
            $check_password = hash('sha512', $_POST['password'] . $row['salt']); 
            for($round = 0; $round < 65536; $round++){
                $check_password = hash('sha512', $check_password . $row['salt']);
            } 
            if($check_password === $row['password']){
                $login_ok = true;
            } 
        } 

        if($login_ok){ 
	  //INICIO DE LA COOKIE.
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
        catch(PDOException $ex){ /*die("Fallamos al realizar la accion: " . $ex->getMessage());*/ 
		// Si tenemos problemas para ejecutar la consulta imprimimos el error
			echo "<div class='panel-body'>
                    <div class='alert alert-warning alert-dismissable'>
                          <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                          Tenemos problemas al ejecutar la consulta :c El error es el siguiente: 
					</div>
				  </div>" .$ex->getMessage();}
						
	  // Aqui verificamos que el campo recordar este marcado si es 1, lo recordamos por 1 año, si no por 1 hora.
	if ($_POST["recordar"]=="1"){		
  	//3) ahora meto una cookie en la computadora del usuario con el identificador del usuario y la cookie aleatoria
  		setcookie("id_usuario", $id_usuario, time()+(60*60*24*365));
  		setcookie("marca_aleatoria_usuario", $numero_aleatorio, time()+(60*60*24*365));
	}else{
	    setcookie("id_usuario", $id_usuario, time()+(60*60));
  		setcookie("marca_aleatoria_usuario", $numero_aleatorio, time()+(60*60));
  	}
	// FIN DE LA COOKIE.
	header("Location: index.php"); 
    } 
    else{ 
       //print("Fallo el inicio de sesion."); 
		header("Location: index.php?accion=pass_error"); 
    } 
    } 
	
	if(isset($_GET['accion'])){

    //chequeamos la accion.
    switch ($_GET['accion']) {
        case 'registrado':
            echo "
        <div class='modal fade' id='Alerta' tabindex='-1' role='dialog' aria-labeledby='AlertaLabel' aria-hidden='false'>
			<div class='modal-dialog'>
                <div class='modal-content'>
					<div class='modal-header'>
						<button type='button' class='close' data-dismiss='modal' aria-hidden='true'>&times;</button>
						<h3>¡Felicidades!</h3>
					</div>
					<div class='modal-body'>
						<p>Te has registrado con éxito!</p>
						<p> Ahora puedes acceder al sistema, por medio del panel que aparecerá al cerrar esta ventana.</p>
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
              <h3>¡Ha cerrado sesión correctamente!</h3>
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
?> 
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<meta charset="utf-8" />
		<title>Entrar al sistema - SRCP</title>

		<meta name="description" content="Panel de inicio de sesion" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />

		<!-- bootstrap & fontawesome -->
		<link rel="stylesheet" href="assets/css/bootstrap.min.css" />
		<link rel="stylesheet" href="assets/font-awesome/4.2.0/css/font-awesome.min.css" />

		<!-- text fonts -->
		<link rel="stylesheet" href="assets/fonts/fonts.googleapis.com.css" />

		<!-- ace styles -->
		<link rel="stylesheet" href="assets/css/ace.min.css" />

		<!--[if lte IE 9]>
			<link rel="stylesheet" href="assets/css/ace-part2.min.css" />
		<![endif]-->
		<link rel="stylesheet" href="assets/css/ace-rtl.min.css" />

		<!--[if lte IE 9]>
		  <link rel="stylesheet" href="assets/css/ace-ie.min.css" />
		<![endif]-->

		<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->

		<!--[if lt IE 9]>
		<script src="assets/js/html5shiv.min.js"></script>
		<script src="assets/js/respond.min.js"></script>
		<![endif]-->
	</head>

	<body class="login-layout blur-login">
		<div class="main-container">
			<div class="main-content">
				<div class="row">
					<div class="col-sm-10 col-sm-offset-1">
						<div class="login-container">
							<div class="center">
								<h1>
									<i class="ace-icon fa fa-leaf green"></i>
									<span class="red">Sistema </span>
									<span class="white" id="id-text2">Registro y Control de Profesores</span>
								</h1>
								<h4 class="blue" id="id-company-text">&copy; José Suárez</h4>
							</div>

							<div class="space-6"></div>

							<div class="position-relative">
								<div id="login-box" class="login-box visible widget-box no-border">
									<div class="widget-body">
										<div class="widget-main">
											<h4 class="header blue lighter bigger">
												<i class="ace-icon fa fa-coffee green"></i>
												Por favor introduzca sus datos
											</h4>

											<div class="space-6"></div>

											<form name="form_login" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" role="form">
												<fieldset>
												<label class="block clearfix">
														<span class="block input-icon input-icon-left">
															<input onkeyup="this.value=this.value.toUpperCase()" type="email" name="correo" id="correo" required class="form-control" placeholder="Correo electronico" />
															<i class="ace-icon fa fa-user"></i>
														</span>
														<small class="errorText"><?php echo ($_POST["correo"] == "") ? "Este campo es requerido" : ""; ?></small>
													</label>

													<label class="block clearfix">
														<span class="block input-icon input-icon-left">
															<input type="password" name="password" id="password" class="form-control" placeholder="Contraseña" required />
															<i class="ace-icon fa fa-lock"></i>
														</span>
													</label>

													<div class="space"></div>

													<div class="clearfix">
														<label class="inline">
															<input type="checkbox" class="ace" name="recordar" id="recordar" checked="checked" value="1" />
															<span class="lbl"> Recordarme? </span>
														</label>

														<button type="submit" class="width-35 pull-right btn btn-sm btn-primary">
															<i class="ace-icon fa fa-key"></i>
															<span class="bigger-110">Entrar</span>
														</button>
													</div>

													<div class="space-4"></div>
												</fieldset>
											</form>

											<div class="social-or-login center">
												<span class="bigger-110">Usa las redes sociales</span>
											</div>

											<div class="space-6"></div>

											<div class="social-login center">
												<a class="btn btn-primary">
													<i class="ace-icon fa fa-facebook"></i>
												</a>

												<a class="btn btn-info">
													<i class="ace-icon fa fa-twitter"></i>
												</a>

												<a class="btn btn-danger">
													<i class="ace-icon fa fa-google-plus"></i>
												</a>
											</div>
										</div><!-- /.widget-main -->

										<div class="toolbar clearfix">
											<div>
												<a href="#" data-target="#forgot-box" class="forgot-password-link">
													<i class="ace-icon fa fa-arrow-left"></i>
													¿Olvidaste tu clave?
												</a>
											</div>

											<div>
												<a href="#" data-target="#signup-box" class="user-signup-link">
													Me quiero registrar
													<i class="ace-icon fa fa-arrow-right"></i>
												</a>
											</div>
										</div>
									</div><!-- /.widget-body -->
								</div><!-- /.login-box -->

								<div id="forgot-box" class="forgot-box widget-box no-border">
									<div class="widget-body">
										<div class="widget-main">
											<h4 class="header red lighter bigger">
												<i class="ace-icon fa fa-key"></i>
												Recuperar contraseña
											</h4>

											<div class="space-6"></div>
											<p>
												Coloque su correo electrónico para recibir las instrucciones.
											</p>

											<form>
												<fieldset>
													<label class="block clearfix">
														<span class="block input-icon input-icon-right">
															<input onkeyup="this.value=this.value.toUpperCase()" type="email" class="form-control" placeholder="Correo" />
															<i class="ace-icon fa fa-envelope"></i>
														</span>
													</label>

													<div class="clearfix">
														<button type="button" class="width-35 pull-right btn btn-sm btn-danger">
															<i class="ace-icon fa fa-lightbulb-o"></i>
															<span class="bigger-110">Enviar!</span>
														</button>
													</div>
												</fieldset>
											</form>
										</div><!-- /.widget-main -->

										<div class="toolbar center">
											<a href="#" data-target="#login-box" class="back-to-login-link">
												Regresar al panel de inicio de sesión
												<i class="ace-icon fa fa-arrow-right"></i>
											</a>
										</div>
									</div><!-- /.widget-body -->
								</div><!-- /.forgot-box -->

								<div id="signup-box" class="signup-box widget-box no-border">
									<div class="widget-body">
										<div class="widget-main">
											<h4 class="header green lighter bigger">
												<i class="ace-icon fa fa-users blue"></i>
												Registrar nuevo usuario.
											</h4>

											<div class="space-6"></div>
											<p> Rellene con sus datos para registrarse. </p>

											<form action="index.php" method="post" role="form" name="form_registro">
												<fieldset>

													<label class="block clearfix">
														<span class="block input-icon input-icon-right">
															<input onkeyup="this.value=this.value.toUpperCase()" type="text" class="form-control" placeholder="Nombre" id="nombre" required />
															<i class="ace-icon fa fa-user"></i>
														</span>
													</label>

													<label class="block clearfix">
														<span class="block input-icon input-icon-right">
															<input onkeyup="this.value=this.value.toUpperCase()" type="text" class="form-control" placeholder="Apellido" id="apellido" required />
															<i class="ace-icon fa fa-user"></i>
														</span>
													</label>
													<label class="block clearfix">
														<span class="block input-icon input-icon-right">
															<input onkeyup="this.value=this.value.replace(/[^0-9]/g,'');" type="text" class="form-control" placeholder="Cedula" required />
															<i class="ace-icon fa fa-credit-card"></i>
														</span>
													</label>

													<label class="block clearfix">
														<span class="block input-icon input-icon-right">
															<input onkeyup="this.value=this.value.toUpperCase()" type="email" class="form-control" placeholder="Correo" required />
															<i class="ace-icon fa fa-envelope"></i>
														</span>
													</label>

													<label class="block clearfix">
														<span class="block input-icon input-icon-right">
															<input onkeyup="this.value=this.value.replace(/[^0-9]/g,'');" type="text" class="form-control" placeholder="Telefono" required />
															<i class="ace-icon fa fa-phone"></i>
														</span>
													</label>

													<label class="block clearfix">
														<span class="block input-icon input-icon-right">
															<input type="password" class="form-control" placeholder="Contraseña" required />
															<i class="ace-icon fa fa-lock"></i>
														</span>
													</label>

													<label class="block clearfix">
														<span class="block input-icon input-icon-right">
															<input onkeyup="this.value=this.value.toUpperCase()" type="text" class="form-control" placeholder="Direccion" required />
															<i class="ace-icon fa fa-globe"></i>
														</span>
													</label>

													<label class="block">
														<input type="checkbox" class="ace" required/>
														<span class="lbl">
															Acepto los 
															<a href="#">Términos y condiciones</a>
														</span>
													</label>

													<div class="space-24"></div>

													<div class="clearfix">
														<button type="reset" class="width-30 pull-left btn btn-sm">
															<i class="ace-icon fa fa-refresh"></i>
															<span class="bigger-110">Limpiar</span>
														</button>

														<button type="submit" name="registro" id="registro" class="width-65 pull-right btn btn-sm btn-success">
															<span class="bigger-110">Registrar</span>

															<i class="ace-icon fa fa-arrow-right icon-on-right"></i>
														</button>
													</div>
												</fieldset>
											</form>
										</div>

										<div class="toolbar center">
											<a href="#" data-target="#login-box" class="back-to-login-link">
												<i class="ace-icon fa fa-arrow-left"></i>
												Regresar al panel de inicio de sesión.
											</a>
										</div>
									</div><!-- /.widget-body -->
								</div><!-- /.signup-box -->
							</div><!-- /.position-relative -->

							<div class="navbar-fixed-top align-right">
								<br />
								&nbsp;
								<a id="btn-login-dark" href="#">Dark</a>
								&nbsp;
								<span class="blue">/</span>
								&nbsp;
								<a id="btn-login-blur" href="#">Blur</a>
								&nbsp;
								<span class="blue">/</span>
								&nbsp;
								<a id="btn-login-light" href="#">Light</a>
								&nbsp; &nbsp; &nbsp;
							</div>
						</div>
					</div><!-- /.col -->
				</div><!-- /.row -->
			</div><!-- /.main-content -->
		</div><!-- /.main-container -->

		<!-- basic scripts -->
        <script src="assets/js/jquery.gritter.min.js"></script>

		<!--[if !IE]> -->
		<script src="assets/js/jquery.2.1.1.min.js"></script>

		<!-- <![endif]-->

		<!--[if IE]>
<script src="assets/js/jquery.1.11.1.min.js"></script>
<![endif]-->

		<!--[if !IE]> -->
		<script type="text/javascript">
			window.jQuery || document.write("<script src='assets/js/jquery.min.js'>"+"<"+"/script>");
		</script>
		<script src="assets/js/bootstrap.min.js"></script>

		<!-- <![endif]-->

		<!--[if IE]>
<script type="text/javascript">
 window.jQuery || document.write("<script src='assets/js/jquery1x.min.js'>"+"<"+"/script>");
</script>
<![endif]-->
		<script type="text/javascript">
			if('ontouchstart' in document.documentElement) document.write("<script src='assets/js/jquery.mobile.custom.min.js'>"+"<"+"/script>");
		</script>

		<!-- inline scripts related to this page -->
		<script type="text/javascript">
			jQuery(function($) {
			 $(document).on('click', '.toolbar a[data-target]', function(e) {
				e.preventDefault();
				var target = $(this).data('target');
				$('.widget-box.visible').removeClass('visible');//hide others
				$(target).addClass('visible');//show target
			 });
			});
			// automatic modal
			    $(window).load(function(){
        		$('#Alerta').modal('show');
    			});
			
			
			//you don't need this, just used for changing background
			jQuery(function($) {
			 $('#btn-login-dark').on('click', function(e) {
				$('body').attr('class', 'login-layout');
				$('#id-text2').attr('class', 'white');
				$('#id-company-text').attr('class', 'blue');
				
				e.preventDefault();
			 });
			 $('#btn-login-light').on('click', function(e) {
				$('body').attr('class', 'login-layout light-login');
				$('#id-text2').attr('class', 'grey');
				$('#id-company-text').attr('class', 'blue');
				
				e.preventDefault();
			 });
			 $('#btn-login-blur').on('click', function(e) {
				$('body').attr('class', 'login-layout blur-login');
				$('#id-text2').attr('class', 'white');
				$('#id-company-text').attr('class', 'light-blue');
				
				e.preventDefault();
			 });
			 
			});
		</script>
	</body>
<?php
    if(isset($_POST['registro'])) 
    {
        // Nos aseguramos de que todos los campos esten correctos, por si se saltan la validacion HTML5
        if(empty($_POST['nombre']))
        { 
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
            ':nivel' => $_POST['nivel']            
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
?>
</html>
