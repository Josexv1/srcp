<?php
     require('config.php'); // requerimos nuestra configuracion
if (isset($_COOKIE["id_usuario"]) && isset($_COOKIE["marca_aleatoria_usuario"])){
   //Tengo cookies memorizadas
   //además voy a comprobar que esas variables no estén vacías
   if ($_COOKIE["id_usuario"]!="" || $_COOKIE["marca_aleatoria_usuario"]!=""){
// 
$query = "  SELECT 
                ID, 
                nombre, 
                apellido, 
                password, 
				salt,
                telefono,
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
        $rows = $stmt->fetch();
   }
}else{
	header('Location: index.php?accion=log_error');
	}
 ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
        <meta charset="utf-8" />
        <title>Programar horarios - SRCP</title>

        <meta name="description" content="overview &amp; stats" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />

        <!-- bootstrap & fontawesome -->
        <link rel="stylesheet" href="assets/css/bootstrap.min.css" />
        <link rel="stylesheet" href="assets/font-awesome/4.2.0/css/font-awesome.min.css" />
        

        <!-- page specific plugin styles -->

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
                                <img class="nav-user-photo" src="assets/avatars/user.jpg" alt="Foto de <?php echo $rows['nombre'] ?>"/>
                                <span class="user-info">
                                   Bienvenido, <?php echo $rows['nombre']?>
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
                            <span class="menu-text"> Panel de control</span>
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
                            <li>
                                <span>Horarios</span>
                            </li>
                            <li class="active">Registrar horarios</li>
                        </ul><!-- /.breadcrumb -->

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
                                Horarios
                                <small>
                                    <i class="ace-icon fa fa-angle-double-right"></i>
                                    Programar horarios.
                                </small>
                            </h1>
                        </div><!-- /.page-header -->


                    <div class="row">
                            <div class="col-xs-12">
                                <!-- PAGE CONTENT BEGINS -->
                                <?php include('dropd.php'); ?>
                                <form action="" method="post">
                                  
                                    <select name="drop_1" id="drop_1">
                                    
                                      <option value="" selected="selected" disabled="disabled">Seleccione una carrera</option>
                                      
                                      <?php principal(); ?>
                                    
                                    </select> 
                                    
                                    <span id="wait_1" style="display: none;">
                                    <img alt="Cargando..." src="assets/img/loading.gif"/>
                                    </span>
                                    <span id="result_1" style="display: none;"></span> 
                                  
                                </form>


                <!-- PAGE CONTENT ENDS -->
                    </div><!-- /.col -->
                </div><!-- /.row -->


 
            </div>
            </div>
            </div>
            </div>
 
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
        <!--<script src="assets/js/additional-methods.min.js"></script>-->

        <!-- ace scripts -->
        <script src="assets/js/ace-elements.min.js"></script>
        <script src="assets/js/ace.min.js"></script>

        <!-- inline scripts related to this page -->

            <script type="text/javascript">
            $(document).ready(function() {
                $('#wait_1').hide();
                $('#drop_1').change(function(){
                  $('#wait_1').show();
                  $('#result_1').hide();
                  $.get("dropd.php", {
                    funcion: "drop_1",
                    drop_var: $('#drop_1').val()
                  }, function(response){
                    $('#result_1').fadeOut();
                    setTimeout("finishAjax('result_1', '"+escape(response)+"')", 400);
                  });
                    return false;
                });
            });

            function finishAjax(id, response) {
              $('#wait_1').hide();
              $('#'+id).html(unescape(response));
              $('#'+id).fadeIn();
            }
            </script>
        
    </body>
</html>
