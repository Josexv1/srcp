<?php
     require_once 'config.php'; // requerimos nuestra configuracion
if (isset($_COOKIE["id_usuario"]) && isset($_COOKIE["marca_aleatoria_usuario"])){
   //Tengo cookies memorizadas
   //además voy a comprobar que esas variables no estén vacías
   if ($_COOKIE["id_usuario"]!="" || $_COOKIE["marca_aleatoria_usuario"]!=""){
// 
$query = "SELECT nombre, 
                 apellido
          FROM   usuarios 
          WHERE  ID = :id 
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
			</div>" .$ex->getMessage();
		} 
        $row = $stmt->fetchAll();
   }
}else{
	header('Location: index.php?accion=log_error');
	}

	//comienzo del registro de los profesores.
    if(!empty($_POST))
    {
        /** 
         * Nos aseguramos de que escriban todos los campos. por servidor, por si alguien quiere meter datos escondidos.
         * Aqui tenemos las opciones en DIE, pero se piensa cambiar a un modal en versiones siguientes
         * La opcion Die, elimina todos los datos de la pagina y solo muestra ese mensaje.
         */
		if(empty($_POST['cedula']))
        { 
        	//die("Coloque la cedula."); 
        	echo "<div class='panel-body'>
                <div class='alert alert-warning alert-dismissable'>
                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                Error: Coloque su cedula.</div>
			</div>";
		}
        if(empty($_POST['nombre']))
        { 
        echo "<div class='panel-body'>
                <div class='alert alert-warning alert-dismissable'>
                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                Error: Coloque su nombre.</div>
			</div>";
        	}
        if(empty($_POST['apellido']))
        { 
        echo "<div class='panel-body'>
                <div class='alert alert-warning alert-dismissable'>
                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                Error: Coloque su apellido.</div>
			</div>";
		}
        if(empty($_POST['direccion']))
        { 
        echo "<div class='panel-body'>
                <div class='alert alert-warning alert-dismissable'>
                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                Error: Coloque su dirección.</div>
			</div>";
		}
        if(empty($_POST['telefono']))
        { 
        echo "<div class='panel-body'>
                <div class='alert alert-warning alert-dismissable'>
                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                Error: Coloque su teléfono.</div>
			</div>";
		}
		if(empty($_POST['correo']))
        { 
        echo "<div class='panel-body'>
                <div class='alert alert-warning alert-dismissable'>
                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                Error: Coloque su correo.</div>
			</div>";
		}
        if(!filter_var($_POST['correo'], FILTER_VALIDATE_EMAIL))
        { 
        echo "<div class='panel-body'>
                <div class='alert alert-warning alert-dismissable'>
                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                Error: el correo no es valido.</div>
			</div>";
		}
		// Chequeamos si la cedula existe
					
        $query = '  SELECT 1
            		FROM profesores
            		WHERE cedula = :cedula
        		  ';
        $query_params = array( ':cedula' => $_POST['cedula'] );
        try {
            $stmt = $db->prepare($query);
            $result = $stmt->execute($query_params);
        }
        catch(PDOException $ex){ 
        	/**
        	 * Aqui de igual forma cambiaremos a un modal
        	 */
        	die("Fallamos al hacer la busqueda: " . $ex->getMessage()); }
        $row = $stmt->fetch();
        if($row){ 
        	echo "<div class='panel-body'>
                <div class='alert alert-warning alert-dismissable'>
                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                Error: La cédula ya existe.</div>
			</div>";
		}
        $query = "SELECT 1
            	  FROM profesores
            	  WHERE correo = :correo
        		 ";
        $query_params = array(
            ':correo' => $_POST['correo']
        );
        try {
            $stmt = $db->prepare($query);
            $result = $stmt->execute($query_params);
        }
        catch(PDOException $ex){ die("Fallamos al revisar el email.: " . $ex->getMessage());}
        $row = $stmt->fetch();
        if($row){ 
        	//die("Este correo ya esta en uso");  
        	echo "<div class='panel-body'>
                <div class='alert alert-warning alert-dismissable'>
                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                Error: El correo ya esta en uso.</div>
			</div>";
		}
/*
 * Antes de introducir calculamos la edad del profesor
 * 
 */
	$fecha = time() - strtotime($_POST['nacimiento']);
	$edad = floor((($fecha / 3600) / 24) / 360);

        /// Si todo pasa enviamos los datos a la base de datos mediante PDO para evitar Inyecciones SQL
        $query ="	INSERT INTO profesores (
				                nombre,
				                apellido,
								cedula,
				                direccion,
				                telefono,
				                correo,
				                genero,
				                estado,
				                condicion,
				                formacion,
				                especialidad,
				                banco,
				                nr_cuenta,
				                sueldo,
				                seguro_social,
				                edad,
				                nacimiento,
				                f_contratado
				    ) VALUES (
				                :nombre,
				                :apellido,
								:cedula,
				                :direccion,
				                :telefono,
				                :correo,
				                :genero,
				                :estado,
				                :condicion,
				                :formacion,
				                :especialidad,
				                :banco,
				                :nr_cuenta,
				                :sueldo,
				                :seguro,
				                :edad,
				                :nacimiento,
				                :f_contratado
				            )
        		";
            $query_params = array(
            ':nombre' => $_POST['nombre'],
			':apellido' => $_POST['apellido'],
			':cedula' => $_POST['cedula'],
            ':direccion' => $_POST['direccion'],
            ':telefono' => $_POST['telefono'],
            ':correo' => $_POST['correo'],
            ':genero' => $_POST['genero'],
            ':estado' => $_POST['estado'],
            ':condicion' => $_POST['condicion'],
            ':formacion' => $_POST['formacion'],
            ':especialidad' => $_POST['especialidad'],
            ':banco' => $_POST['banco'],
            ':nr_cuenta' => $_POST['nr_cuenta'],
            ':sueldo' => $_POST['sueldo'],
            ':seguro' => $_POST['seguro'],
            ':edad' => $edad,
            ':nacimiento' => $_POST['nacimiento'],
            ':f_contratado' => date('Y-m-d')
            );
        try { 
            $stmt = $db->prepare($query);
            $result = $stmt->execute($query_params);
        }
        catch(PDOException $ex){
		// Si tenemos problemas para ejecutar la consulta imprimimos el error
			echo "<div class='panel-body'>
                     <div class='alert alert-warning alert-dismissable'>
                        <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                        Tenemos problemas al ejecutar la consulta :c El error es el siguiente: 
					</div>
				  </div>" .$ex->getMessage();}
			// Si todo pasa como deberia ser, referimos al usuario al panel de 
			// inicio de sesion con el mensaje de bienvenida.
		header('Location: listar_profesor.php');
}

	if(isset($_GET['accion'])){

    //check the action
    switch ($_GET['accion']) {
        case 'error':
            echo "<div class='panel-body'>
                    <div class='alert alert-success alert-dismissable'>
                      <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                      Hay varios errores en tu registro. 
                      Si necesitas ayuda puedes hacer clic al botón de Ayuda en el fondo de la página.
					</div>
				</div>";
            break;
    }

}

$query = "  SELECT nombre, 
                   apellido
            FROM   usuarios 
            WHERE  ID = :id 
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
				</div>" .$ex->getMessage();
		echo "</div>";
		} 
        $row = $stmt->fetch();
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<meta charset="utf-8" />
		<title>Registro de profesores - SRCP</title>

		<meta name="description" content="Registro de profesores" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />

		<!-- bootstrap & fontawesome -->
		<link rel="stylesheet" href="assets/css/bootstrap.min.css" />
		<link rel="stylesheet" href="assets/font-awesome/4.2.0/css/font-awesome.min.css" />

		<!-- page specific plugin styles -->
		<link rel="stylesheet" href="assets/css/bootstrap-multiselect.min.css" />
		<link rel="stylesheet" href="assets/css/datepicker.min.css" />
		<style type="text/css">
		/*
		Inicio del wizard del registro de profesores.
		 */
				.stepwizard-step p {
				    margin-top: 10px;
				}

				.stepwizard-row {
				    display: table-row;
				}

				.stepwizard {
				    display: table;
				    width: 100%;
				    position: relative;
				}

				.stepwizard-step button[disabled] {
				    opacity: 1 !important;
				    filter: alpha(opacity=100) !important;
				}

				.stepwizard-row:before {
				    top: 14px;
				    bottom: 0;
				    position: absolute;
				    content: " ";
				    width: 100%;
				    height: 1px;
				    background-color: #ccc;
				    z-order: 0;

				}

				.stepwizard-step {
				    display: table-cell;
				    text-align: center;
				    position: relative;
				}

				.btn-circle {
				  width: 30px;
				  height: 30px;
				  text-align: center;
				  padding: 6px 0;
				  font-size: 12px;
				  line-height: 1.428571429;
				  border-radius: 15px;
				}
		</style>

		<!-- text fonts -->
		<link rel="stylesheet" href="assets/fonts/fonts.googleapis.com.css" />

		<!-- ace styles -->
		<link rel="stylesheet" href="assets/css/ace.min.css" class="ace-main-stylesheet" id="main-ace-style" />

		<!--[if lte IE 9]>
			<link rel="stylesheet" href="assets/css/ace-part2.min.css" class="ace-main-stylesheet" />
		<![endif]-->

		<!--[if lte IE 9]>
		  <link rel="stylesheet" href="assets/css/ace-ie.min.css" />
		<![endif]-->

		<!-- inline styles related to this page -->

		<!-- ace settings handler -->
		<script src="assets/js/ace-extra.min.js"></script>

		<!-- HTML5shiv and Respond.js for IE8 to support HTML5 elements and media queries -->

		<!--[if lte IE 8]>
		<script src="assets/js/html5shiv.min.js"></script>
		<script src="assets/js/respond.min.js"></script>
		<![endif]-->
	</head>

	<body class="no-skin">
		<div id="navbar" class="navbar navbar-default">
			<div class="navbar-container" id="navbar-container">
				<button type="button" class="navbar-toggle menu-toggler pull-left" id="menu-toggler" data-target="#sidebar">
					<span class="sr-only">Toggle sidebar</span>

					<span class="icon-bar"></span>

					<span class="icon-bar"></span>

					<span class="icon-bar"></span>
				</button>

				<div class="navbar-header pull-left">
					<a href="index.php" class="navbar-brand">
						<small>
							<i class="fa fa-leaf"></i>
							Sistema de control y registro de profesores.
						</small>
					</a>
				</div>
				<!--menu-->
				<div class="navbar-buttons navbar-header pull-right" role="navigation">
					<ul class="nav ace-nav">
						<li class="light-blue">
							<a data-toggle="dropdown" href="#" class="dropdown-toggle">
								<img class="nav-user-photo" src="assets/avatars/user.jpg" alt="Foto de <?php echo $row['nombre'] ?>" />
								<span class="user-info">
								Bienvenido, <?php echo $row['nombre']?>
								</span>
								<i class="ace-icon fa fa-caret-down"></i>
							</a>
							<ul class="user-menu dropdown-menu-right dropdown-menu dropdown-yellow dropdown-caret dropdown-close">
								<li>
									<a href="configuracion.php">
										<i class="ace-icon fa fa-cog"></i>
										Configuración
									</a>
								</li>

								<li>
									<a href="#">
										<i class="ace-icon fa fa-user"></i>
										Perfil
									</a>
								</li>

								<li class="divider"></li>

								<li>
									<a href="salir.php">
										<i class="ace-icon fa fa-power-off"></i>
										Cerrar sesión
									</a>
								</li>
							</ul>
						</li>
					</ul>
				</div>
			</div><!-- /.navbar-container -->
		</div>

		<div class="main-container" id="main-container">
			<div id="sidebar" class="sidebar responsive">
				<ul class="nav nav-list">
					<li class="active">
						<a href="index.php">
							<i class="menu-icon fa fa-tachometer"></i>
							<span class="menu-text">Panel de control</span>
						</a>

						<b class="arrow"></b>
					</li>

					<li class="">
						<a href="#" class="dropdown-toggle">
							<i class="menu-icon fa  fa-mortar-board"></i>
							<span class="menu-text">
								Profesores
							</span>

							<b class="arrow fa fa-angle-down"></b>
						</a>

						<b class="arrow"></b>

						<ul class="submenu">
							<li class="">
								<a href="registro_profesor.php">
									<i class="menu-icon fa fa-caret-right"></i>

									Registrar profesor
								</a>
								</li>

							<li class="">
								<a href="listar_profesor.php">
									<i class="menu-icon fa fa-caret-right"></i>
									Listar profesores
								</a>

								<b class="arrow"></b>
							</li>

							<li class="">
								<a href="editar_profesor.php">
									<i class="menu-icon fa fa-caret-right"></i>
									Editar profesor
								</a>

								<b class="arrow"></b>
							</li>

						</ul>
					</li>
				</ul>
				<ul class="nav nav-list">
					<li class="">
						<a href="#" class="dropdown-toggle">
							<i class="menu-icon fa fa-list"></i>
							<span class="menu-text"> Secciones </span>

							<b class="arrow fa fa-angle-down"></b>
						</a>

						<b class="arrow"></b>

						<ul class="submenu">
							<li class="">
								<a href="registro_seccion.php">
									<i class="menu-icon fa fa-caret-right"></i>
									Registrar secciones
								</a>

								<b class="arrow"></b>
							</li>

							<li class="">
								<a href="editar_seccion.php">
									<i class="menu-icon fa fa-caret-right"></i>
									Editar secciones
								</a>

								<b class="arrow"></b>
							</li>
						</ul>
					</li>
				<ul class="nav nav-list">
					<li class="">
						<a href="#" class="dropdown-toggle">
							<i class="menu-icon fa  fa-calendar"></i>
							<span class="menu-text"> Horarios </span>

							<b class="arrow fa fa-angle-down"></b>
						</a>

						<b class="arrow"></b>

						<ul class="submenu">
							<li class="">
								<a href="registrar_horario.php">
									<i class="menu-icon fa fa-caret-right"></i>
									Programar horarios
								</a>

								<b class="arrow"></b>
							</li>

							<li class="">
								<a href="editar_horario.php">
									<i class="menu-icon fa fa-caret-right"></i>
									Editar horarios
								</a>

								<b class="arrow"></b>
							</li>
						</ul><!-- /.nav-list -->

				<div class="sidebar-toggle sidebar-collapse" id="sidebar-collapse">
					<i class="ace-icon fa fa-angle-double-left" data-icon1="ace-icon fa fa-angle-double-left" data-icon2="ace-icon fa fa-angle-double-right"></i>
				</div>
			</div>

			<div class="main-content">
				<div class="main-content-inner">
					<div class="breadcrumbs" id="breadcrumbs">
						<ul class="breadcrumb">
							<li>
								<i class="ace-icon fa fa-home home-icon"></i>
								<a href="index.php">Inicio</a>
							</li>
							<li>Profesores</li>
							<li class="active">Registro de profesores</li>
						</ul>
						<!-- /.breadcrumb -->

						<div class="nav-search" id="nav-search">
							<form class="form-search">
								<span class="input-icon">
									<input type="text" placeholder="Buscar..." class="nav-search-input" id="nav-search-input" autocomplete="off" />
									<i class="ace-icon fa fa-search nav-search-icon"></i>
								</span>
							</form>
						</div><!-- /.nav-search -->
					</div>
						<div class="page-header">
							<h1>
								Profesores
								<small>
									<i class="ace-icon fa fa-angle-double-right"></i>
									Registro de nuevos profesores.
								</small>
							</h1>
						</div><!-- /.page-header -->

						<div class="row">
							<div class="col-xs-12">
								<!-- PAGE CONTENT BEGINS -->
<div class="stepwizard">
    <div class="stepwizard-row setup-panel">
        <div class="stepwizard-step">
            <a href="#step-1" type="button" class="btn btn-primary btn-circle">1</a>
            <p>Datos personales</p>
        </div>
        <div class="stepwizard-step">
            <a href="#step-2" type="button" class="btn btn-default btn-circle" disabled="disabled">2</a>
            <p>Datos academicos</p>
        </div>
        <div class="stepwizard-step">
            <a href="#step-3" type="button" class="btn btn-default btn-circle" disabled="disabled">3</a>
            <p>Datos financieros</p>
        </div>
    </div>
</div>
<form role="form" name="form_registro_profesor" method="post" action="registro_profesor.php">
    <div class="step-content pos-rel">
		  <div class="active setup-content" id="step-1">
		<div class="col-xs-12">
            <div class="col-md-12">
            </br>
            	<div class="form-group">
					<label class="control-label col-xs-12 col-sm-3 no-padding-right" for="cedula">Cédula:</label>

					<div class="col-xs-12 col-sm-9">
						<div class="clearfix">
							<input type="text" onkeyup="this.value=this.value.replace(/[^0-9]/g,'');" name="cedula" id="cedula" class="col-xs-12 col-sm-4 input-large" required="required" />
						</div>
					</div>
				</div>
   				<div class="form-group">
					<label class="control-label col-xs-12 col-sm-3 no-padding-right" for="nombre">Nombre:</label>

					<div class="col-xs-12 col-sm-9">
						<div class="clearfix">
							<input type="text" name="nombre" id="nombre" class="col-xs-12 col-sm-6 input-large" required="required"/>
						</div>
					</div>
				</div>

				<div class="form-group">
					<label class="control-label col-xs-12 col-sm-3 no-padding-right" for="apellido">Apellido:</label>

					<div class="col-xs-12 col-sm-9">
						<div class="clearfix">
							<input type="text" name="apellido" id="apellido" class="col-xs-12 col-sm-4 input-large" required="required"/>
						</div>
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-xs-12 col-sm-3 no-padding-right" for="direccion">Dirección:</label>

					<div class="col-xs-12 col-sm-9">
						<div class="clearfix">
							<input type="text" id="direccion" name="direccion" class="col-xs-12 col-sm-5 input-large" required="required"/>
						</div>
					</div>
				</div>

				<div class="form-group">
					<label class="control-label col-xs-12 col-sm-3 no-padding-right" for="telefono" >Numero de Teléfono:</label>

					<div class="col-xs-12 col-sm-9">
						<div class="input-group">
							<input onkeyup="this.value=this.value.replace(/[^0-9]/g,'');" type="tel" id="telefono" name="telefono" class="col-xs-12 col-sm-5 input-large" required="required"/>
					</div>
				</div>

				<div class="form-group">
					<label class="control-label col-xs-12 col-sm-3 no-padding-right" for="url">Correo:</label>

					<div class="col-xs-12 col-sm-9">
						<div class="clearfix">
						<div class="input-group">
							<input type="email" id="correo" name="correo" class="col-xs-12 col-sm-8 input-large" required="required"/>
						</div>
					</div>
				</div>
				</div>

				<div class="form-group">
					<label class="control-label col-xs-12 col-sm-3 no-padding-right">Genero</label>

					<div class="col-xs-12 col-sm-9">
						<label class="line-height-1 blue">
								<input name="genero" value="Masculino" type="radio" class="ace" />
								<span class="lbl"> Masculino</span>
							</label>
							<label class="line-height-1 blue">
								<input name="genero" value="Femenino" type="radio" class="ace" />
								<span class="lbl"> Femenino</span>
							</label>
						</div>
					</div>

					<div class="form-group">
					<label class="col-sm-3 control-label no-padding-right">Estado</label>
						<div class="col-sm-9">
							<div class="pos-rel">
								<input id="estado" name="estado" class="typeahead scrollable" type="text" placeholder="Estados de Venezuela" required="required"/>
							</div>
						</div>
					</div>
				<div class="form-group">
					<label class="control-label col-xs-12 col-sm-3 no-padding-right" for="condicion">Condición</label>

					<div class="col-xs-12 col-sm-9">
						<div class="clearfix">
							<input list="condicion" name="condicion" required="required" class="col-xs-12 col-sm-5 input-large" autocomplete="off">
						    <datalist id="condicion">
						        <option value="Tiempo completo"></option>
						        <option value="Tiempo parcial"></option>
						        <option value="Pago por hora"></option>
						        <option value="Otro"></option>
						    </datalist>
						</div>
					</div>
				</div>
					<div class="form-group">
						<label class="control-label col-xs-12 col-sm-3 no-padding-right" for="nacimiento">Fecha de nacimiento</label>
						<div class="col-xs-12 col-sm-9">
						<div class="clearfix">
							<div class="input-group">
								<span class="block input-icon input-icon-right">
									<input class="col-xs-12 col-sm-6 input-large date-picker" id="id-date-picker-1" name="nacimiento" type="text" data-date-format="yyyy-mm-dd" required="required"/>
										<i class="ace-icon fa fa-calendar"></i>
								</span>
							</div>
							</div>
						</div>
					</div><!-- Fin del Form Group-->
			<button class="btn btn-primary nextBtn btn-lg pull-right" type="button" >Siguiente</button>
            </div>
        </div>
    </div>
    </div>
    <div class="row setup-content" id="step-2">
        <div class="col-xs-12">
            <div class="col-md-12">												                
								<div class="form-group">
								<label class="control-label col-xs-12 col-sm-3 no-padding-right" for="formacion">Titulación</label>

												<div class="col-xs-12 col-sm-9">
													<div class="clearfix col-sm-4">
														<select id="formacion" name="formacion" class="form-control" required="required">
															<option value="Ingeniero">Ingeniero</option>
															<option value="Licenciado">Licenciado</option>
															<option value="Magister">Magister</option>
															<option value="Doctor">Doctor</option>
														</select>
													</div>
												</div>
											</div>

											<div class="form-group">
												<label class="control-label col-xs-12 col-sm-3 no-padding-right" for="especialidad">Especialidad</label>

												<div class="col-xs-12 col-sm-9">
													<div class="clearfix col-sm-4">
														<select class="form-control" id="especialidad" name="especialidad" required="required">
															<option value="Ingeniero">Matemática</option>
															<option value="Licenciado">Sistemas</option>
															<option value="Magister">Informática</option>
															<option value="Doctor">Eléctrica</option>
														</select>
													</div>
												</div>
											</div>

											<div class="form-group">
											<label class="control-label col-xs-12 col-sm-3 no-padding-right" for="materias_impartidas">Materias impartidas</label>
											<div class="col-xs-12 col-sm-9">
												<select id="especialidad" class="multiselect" multiple="">
												<option value="Ingeniero">Matemática</option>
												<option value="Licenciado">Sistemas</option>
												<option value="Magister">Informática</option>
												<option value="Doctor">Eléctrica</option>
												</select>
											</div>
											</div>
											 <button class="btn btn-primary nextBtn btn-lg pull-right" type="button" >Siguiente</button>
									            </div>
									        </div>
									    </div>
									    <div class="row setup-content" id="step-3">
									        <div class="col-xs-12">
									            <div class="col-md-12">
									                <h3> Datos financieros</h3>

											<div class="form-group">
												<label class="control-label col-xs-12 col-sm-3 no-padding-right" for="banco">Banco</label>

												<div class="col-xs-12 col-sm-9">
													<div class="clearfix col-sm-4">
														<select class="form-control" id="banco" name="banco" required="required">
															<option value="Banco de Venezuela">Banco de Venezuela</option>
															<option value="Mercantil">Mercantil</option>
															<option value="Banco del tesoro">Banco del tesoro</option>
															<option value="Bicentenario">Bicentenario</option>
														</select>
													</div>
												</div>
											</div>
											<div class="form-group">
												<label class="control-label col-xs-12 col-sm-3 no-padding-right" for="nr_cuenta">Numero de cuenta:</label>

												<div class="col-xs-12 col-sm-9">
													<div class="clearfix">
														<input type="text" onkeyup="this.value=this.value.replace(/[^0-9]/g,'');" name="nr_cuenta" id="nr_cuenta" class="col-xs-12 col-sm-4" required="required"/>
													</div>
												</div>
											</div>
											<div class="form-group">
												<label class="control-label col-xs-12 col-sm-3 no-padding-right" for="seguro">Numero de seguro social:</label>

												<div class="col-xs-12 col-sm-9">
													<div class="clearfix">
														<input type="text" onkeyup="this.value=this.value.replace(/[^0-9]/g,'');" name="seguro" id="seguro" class="col-xs-12 col-sm-4" required="required"/>
													</div>
												</div>
											</div>
											<div class="form-group">
												<label class="control-label col-xs-12 col-sm-3 no-padding-right" for="sueldo">Sueldo actual:</label>

												<div class="col-xs-12 col-sm-9">
													<div class="clearfix">
														<input type="text" onkeyup="this.value=this.value.replace(/[^0-9]/g,'');" name="sueldo" id="sueldo" class="col-xs-12 col-sm-4" required="required"/>
													</div>
												</div>
											</div>
									                <button class="btn btn-success btn-lg pull-right" type="submit">Guardar!</button>
									            </div>
									        </div>
									    </div>
									</form>
									</div>
								<!-- PAGE CONTENT ENDS -->
							</div><!-- /.col -->
						</div><!-- /.row -->
					</div><!-- /.page-content -->
				</div>
			</div><!-- /.main-content -->

			<div class="footer">
				<div class="footer-inner">
					<div class="footer-content">
						<span class="bigger-120">
							<span class="blue bolder">Sistema</span>
							&copy; 2015
						</span>

						&nbsp; &nbsp;
						<span class="action-buttons">
							<a href="#">
								<i class="ace-icon fa fa-twitter-square light-blue bigger-150"></i>
							</a>

							<a href="#">
								<i class="ace-icon fa fa-facebook-square text-primary bigger-150"></i>
							</a>

							<a href="#">
								<i class="ace-icon fa fa-rss-square orange bigger-150"></i>
							</a>
						</span>
					</div>
				</div>
			</div>

			<a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-sm btn-inverse">
				<i class="ace-icon fa fa-angle-double-up icon-only bigger-110"></i>
			</a>
		</div><!-- /.main-container -->

		<!-- basic scripts -->

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

		<!-- <![endif]-->

		<!--[if IE]>
<script type="text/javascript">
 window.jQuery || document.write("<script src='assets/js/jquery1x.min.js'>"+"<"+"/script>");
</script>
<![endif]-->
		<script type="text/javascript">
			if('ontouchstart' in document.documentElement) document.write("<script src='assets/js/jquery.mobile.custom.min.js'>"+"<"+"/script>");
		</script>
		<script src="assets/js/bootstrap.min.js"></script>

		<!-- page specific plugin scripts -->
		<script src="assets/js/validar.js"></script>
		<script src="assets/js/typeahead.jquery.min.js"></script>
		<!--<script src="assets/js/additional-methods.min.js"></script>-->
		<script src="assets/js/bootbox.min.js"></script>
		<script src="assets/js/jquery.maskedinput.min.js"></script>
		<script src="assets/js/bootstrap-multiselect.min.js"></script>
		<script src="assets/js/bootstrap-datepicker.min.js"></script>
		<!-- ace scripts -->
		<script src="assets/js/ace-elements.min.js"></script>
		<script src="assets/js/ace.min.js"></script>

		<!-- inline scripts related to this page -->
		<script type="text/javascript">
				// Multiselect!! !
				$('.multiselect').multiselect({
				 enableFiltering: true,
				 buttonClass: 'btn btn-white btn-primary',
				 templates: {
					button: '<button type="button" class="multiselect dropdown-toggle" data-toggle="dropdown"></button>',
					ul: '<ul class="multiselect-container dropdown-menu"></ul>',
					filter: '<li class="multiselect-item filter"><div class="input-group"><span class="input-group-addon"><i class="fa fa-search"></i></span><input class="form-control multiselect-search" type="text"></div></li>',
					filterClearBtn: '<span class="input-group-btn"><button class="btn btn-default btn-white btn-grey multiselect-clear-filter" type="button"><i class="fa fa-times-circle red2"></i></button></span>',
					li: '<li><a href="javascript:void(0);"><label></label></a></li>',
					divider: '<li class="multiselect-item divider"></li>',
					liGroup: '<li class="multiselect-item group"><label class="multiselect-group"></label></li>'
				 }
				});
				// wizard
				$(document).ready(function () {

					    var navListItems = $('div.setup-panel div a'),
					            allWells = $('.setup-content'),
					            allNextBtn = $('.nextBtn');

					    allWells.hide();

					    navListItems.click(function (e) {
					        e.preventDefault();
					        var $target = $($(this).attr('href')),
					                $item = $(this);

					        if (!$item.hasClass('disabled')) {
					            navListItems.removeClass('btn-primary').addClass('btn-default');
					            $item.addClass('btn-primary');
					            allWells.hide();
					            $target.show();
					            $target.find('input:eq(0)').focus();
					        }
					    });

					    allNextBtn.click(function(){
					        var curStep = $(this).closest(".setup-content"),
					            curStepBtn = curStep.attr("id"),
					            nextStepWizard = $('div.setup-panel div a[href="#' + curStepBtn + '"]').parent().next().children("a"),
					            curInputs = curStep.find("input[type='text'],input[type='url']"),
					            isValid = true;

					        $(".form-group").removeClass("has-error");
					        for(var i=0; i<curInputs.length; i++){
					            if (!curInputs[i].validity.valid){
					                isValid = false;
					                $(curInputs[i]).closest(".form-group").addClass("has-error");
					            }
					        }

					        if (isValid)
					            nextStepWizard.removeAttr('disabled').trigger('click');
					    });

					    $('div.setup-panel div a.btn-primary').trigger('click');
					});

				//typeahead.js
				//example taken from plugin's page at: https://twitter.github.io/typeahead.js/examples/
				var substringMatcher = function(strs) {
					return function findMatches(q, cb) {
						var matches, substringRegex;
					 
						// an array that will be populated with substring matches
						matches = [];
					 
						// regex used to determine if a string contains the substring `q`
						substrRegex = new RegExp(q, 'i');
					 
						// iterate through the pool of strings and for any string that
						// contains the substring `q`, add it to the `matches` array
						$.each(strs, function(i, str) {
							if (substrRegex.test(str)) {
								// the typeahead jQuery plugin expects suggestions to a
								// JavaScript object, refer to typeahead docs for more info
								matches.push({ value: str });
							}
						});
			
						cb(matches);
					}
				 }
			
				 $('input.typeahead').typeahead({
					hint: true,
					highlight: true,
					minLength: 1
				 }, {
					name: 'states',
					displayKey: 'value',
					source: substringMatcher(ace.vars['VE_STATES'])
				 });


				 //datepicker plugin
				//link
				$('.date-picker').datepicker({
					autoclose: true,
					todayHighlight: true
				})
				//Mostrar el datepicker al hacer click en el icono
				.next().on(ace.click_event, function(){
					$(this).prev().focus();
				});
			
				//o cambiarlo a un range-picker
				$('.input-daterange').datepicker({autoclose:true});
			
			
				//to translate the daterange picker, please copy the "examples/daterange-fr.js" contents here before initialization
				$('input[name=date-range-picker]').daterangepicker({
					'applyClass' : 'btn-sm btn-success',
					'cancelClass' : 'btn-sm btn-default',
					locale: {
						applyLabel: 'Apply',
						cancelLabel: 'Cancel',
					}
				})
				.prev().on(ace.click_event, function(){
					$(this).next().focus();
				});
		</script>
	</body>
</html>
