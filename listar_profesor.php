<?php
     require_once 'config.php'; // requerimos nuestra configuracion
if (isset($_COOKIE["id_usuario"]) && isset($_COOKIE["marca_aleatoria_usuario"])){
   //Tengo cookies memorizadas
   //además voy a comprobar que esas variables no estén vacías
   if ($_COOKIE["id_usuario"]!="" || $_COOKIE["marca_aleatoria_usuario"]!=""){
// 
$query = "  SELECT 
                nombre
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
                    <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                    Tenemos problemas al ejecutar la consulta :c El error es el siguiente: 
				</div>
            </div>" .$ex->getMessage();
		} 
        $row = $stmt->fetch();
   }
}else{
	header('Location: index.php?accion=log_error');
	}
    $query = "  SELECT  ID,
                        cedula,
                        nombre,
                        apellido,
                        condicion,
                        telefono
                FROM    profesores 
             "; 
        try{ 
            $stmt = $db->prepare($query); 
            // Aqui ejecutamos sin parametros porque no tenemos arreglo :)
            $result = $stmt->execute(); 
        } 
        catch(PDOException $ex){ 
        echo "<div class='panel-body'>
                <div class='alert alert-warning alert-dismissable'>
                    <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                    Tenemos problemas al ejecutar la consulta :c El error es el siguiente: 
                </div>
            </div>" .$ex->getMessage();
        } 
        $rows = $stmt->fetchAll();
 ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
        <meta charset="utf-8" />
        <title>Listar profesor - SRCP</title>

        <meta name="description" content="Listar profesores" />
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
                            <i class="fa fa-leaf "></i>
                            Sistema de control y registro de profesores.
                        </small>
                    </a>
                </div>
                <!--menu top-->
                                <div class="navbar-buttons navbar-header pull-right" role="navigation">
                    <ul class="nav ace-nav">
                        <li class="light-blue">
                            <a data-toggle="dropdown" href="#" class="dropdown-toggle">
                                <img class="nav-user-photo" src="assets/avatars/user.jpg" alt="Foto de <?php echo $row['nombre']?>" />
                                <span class="user-info">
                                   Bienvenido, <?php echo $row['nombre']?>
                                </span>

                                <i class="ace-icon fa fa-caret-down"></i>
                            </a>

                            <ul class="user-menu dropdown-menu-right dropdown-menu dropdown-yellow dropdown-caret dropdown-close">
                                <li>
                                    <a href="configuracion.php">
                                        <i class="ace-icon fa fa-cog"></i>
                                        Configuracion
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
                                        Cerrar sesion
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
            <!-- /.navbar-container Menu Top -->
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
                            <li class="active">Registro de profesores</li>
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
                                Principal
                                <small>
                                    <i class="ace-icon fa fa-angle-double-right"></i>
                                    Registro de nuevos profesores.
                                </small>
                            </h1>
                        </div><!-- /.page-header -->
                        <!-- PAGE CONTENT BEGINS -->
                                <div class="row">
                                    <div class="col-xs-12">
                                        <div class="clearfix">
                                            <div class="pull-right tableTools-container"></div>
                                        </div>
                                        <div class="table-header">
                                            Profesores registrados
                                        </div>

                                        <!-- div.table-responsive -->

                                        <!-- div.dataTables_borderWrap -->
                                        <div>
                                            <table id="dynamic-table" class="table table-striped table-bordered table-hover">
                                                <thead>
                                                    <tr>
                                                        <th class="center">
                                                            <label class="pos-rel">
                                                                <input type="checkbox" class="ace" />
                                                                <span class="lbl"></span>
                                                            </label>
                                                        </th>
                                                        <th>Cedula</th>
                                                        <th>Nombre</th>
                                                        <th>Apellido</th>
                                                        <th>Condicion</th>
                                                        <th>Telefono</th>
                                                        <th>Acciones</th>
                                                    </tr>
                                                </thead>

                                                <tbody>
                                                <?php foreach ($rows as $row) {?>
                                                    <tr>
                                                        <td></td>
                                                        <td><?php echo $row['cedula']; ?></td>
                                                        <td><?php echo $row['nombre']; ?></td>
                                                        <td><?php echo $row['apellido']; ?></td>
                                                        <td><?php echo $row['condicion'];?></td>
                                                        <td><?php echo $row['telefono']?></td>
                                                        <td>
                                                            <div class="hidden-sm hidden-xs btn-group">
                                                            <a href="perfil.php?id=<?PHP echo $row['ID']?>">
                                                            <button class="btn btn-xs btn-info" title="Perfil">
                                                            <i class="ace-icon fa fa-user bigger-120"></i>
                                                            </button></a>
                                                            </div>

                                                            <div class="hidden-sm hidden-xs btn-group">
                                                            <a href="perfil.php?id=<?PHP echo $row['ID']?>&queja=si">
                                                            <button class="btn btn-xs btn-warning" title="Poner una queja" data-toggle="modal" data-target="#Quejas">
                                                            <i class="ace-icon fa fa-flag bigger-120"></i>
                                                            </button></a>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                <?php } ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div><!-- PAGE CONTENT ENDS -->
            </div>
            </div>
            </div></div>
 
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
        <script src="assets/js/bootbox.min.js"></script>
        <script src="assets/js/jquery.dataTables.min.js"></script>
        <script src="assets/js/jquery.dataTables.bootstrap.min.js"></script>
        <script src="assets/js/dataTables.tableTools.min.js"></script>
        <script src="assets/js/dataTables.colVis.min.js"></script>

        <!-- ace scripts -->
        <script src="assets/js/ace-elements.min.js"></script>
        <script src="assets/js/ace.min.js"></script>

        <!-- inline scripts related to this page -->
                <script type="text/javascript">
            jQuery(function($) {
                //initiate dataTables plugin
                var oTable1 = 
                $('#dynamic-table')
                //.wrap("<div class='dataTables_borderWrap' />")   //if you are applying horizontal scrolling (sScrollX)
                .dataTable( {
                    bAutoWidth: false,
                    "aoColumns": [
                      { "bSortable": false },
                      null, null,null, null, null,
                      { "bSortable": false }
                    ],
                    "aaSorting": [],
            
                    //,
                    //"sScrollY": "200px",
                    //"bPaginate": false,
            
                    //"sScrollX": "100%",
                    //"sScrollXInner": "120%",
                    //"bScrollCollapse": true,
                    //Note: if you are applying horizontal scrolling (sScrollX) on a ".table-bordered"
                    //you may want to wrap the table inside a "div.dataTables_borderWrap" element
            
                    //"iDisplayLength": 50
                } );
                //oTable1.fnAdjustColumnSizing();
            
            
                //TableTools settings
                TableTools.classes.container = "btn-group btn-overlap";
                TableTools.classes.print = {
                    "body": "DTTT_Print",
                    "info": "tableTools-alert gritter-item-wrapper gritter-info gritter-center white",
                    "message": "tableTools-print-navbar"
                }
            
                //initiate TableTools extension
                var tableTools_obj = new $.fn.dataTable.TableTools( oTable1, {
                    "sSwfPath": "assets/swf/copy_csv_xls_pdf.swf",
                    
                    "sRowSelector": "td:not(:last-child)",
                    "sRowSelect": "multi",
                    "fnRowSelected": function(row) {
                        //check checkbox when row is selected
                        try { $(row).find('input[type=checkbox]').get(0).checked = true }
                        catch(e) {}
                    },
                    "fnRowDeselected": function(row) {
                        //uncheck checkbox
                        try { $(row).find('input[type=checkbox]').get(0).checked = false }
                        catch(e) {}
                    },
            
                    "sSelectedClass": "success",
                    "aButtons": [
                        {
                            "sExtends": "copy",
                            "sToolTip": "Copiar al portapapeles",
                            "sButtonClass": "btn btn-white btn-primary btn-bold",
                            "sButtonText": "<i class='fa fa-copy bigger-110 pink'></i>",
                            "fnComplete": function() {
                                this.fnInfo( '<h3 class="no-margin-top smaller">Tabla copiada</h3>\
                                    <p>Copiadas '+(oTable1.fnSettings().fnRecordsTotal())+' Tablas</p>',
                                    1500
                                );
                            }
                        },
                        
                        {
                            "sExtends": "csv",
                            "sToolTip": "Exportar a CSV",
                            "sButtonClass": "btn btn-white btn-primary  btn-bold",
                            "sButtonText": "<i class='fa fa-file-excel-o bigger-110 green'></i>"
                        },
                        
                        {
                            "sExtends": "pdf",
                            "sToolTip": "Exportar a PDF",
                            "sButtonClass": "btn btn-white btn-primary  btn-bold",
                            "sButtonText": "<i class='fa fa-file-pdf-o bigger-110 red'></i>"
                        },
                        
                        {
                            "sExtends": "print",
                            "sToolTip": "Imprimir",
                            "sButtonClass": "btn btn-white btn-primary  btn-bold",
                            "sButtonText": "<i class='fa fa-print bigger-110 grey'></i>",
                            
                            "sMessage": "<div class='navbar navbar-default'><div class='navbar-header pull-left'><a class='navbar-brand' href='#'><small>Listado de profesores</small></a></div></div>",
                            
                            "sInfo": "<h3 class='no-margin-top'>Vista de impresion</h3>\
                                      <p>Por favor, utilize la funcion de imprimir del navegador para imprimir este documento, Normalmente es CTRL+P\
                                      <br />Presione <b>escape</b> cuando termine, para regresar</p>",
                        }
                    ]
                } );
                //we put a container before our table and append TableTools element to it
                $(tableTools_obj.fnContainer()).appendTo($('.tableTools-container'));
                
                //also add tooltips to table tools buttons
                //addding tooltips directly to "A" buttons results in buttons disappearing (weired! don't know why!)
                //so we add tooltips to the "DIV" child after it becomes inserted
                //flash objects inside table tools buttons are inserted with some delay (100ms) (for some reason)
                setTimeout(function() {
                    $(tableTools_obj.fnContainer()).find('a.DTTT_button').each(function() {
                        var div = $(this).find('> div');
                        if(div.length > 0) div.tooltip({container: 'body'});
                        else $(this).tooltip({container: 'body'});
                    });
                }, 200);
                
                
                
                //ColVis extension
                var colvis = new $.fn.dataTable.ColVis( oTable1, {
                    "buttonText": "<i class='fa fa-search'></i>",
                    "aiExclude": [0, 6],
                    "bShowAll": true,
                    //"bRestore": true,
                    "sAlign": "right",
                    "fnLabel": function(i, title, th) {
                        return $(th).text();//remove icons, etc
                    }
                    
                }); 
                
                //style it
                $(colvis.button()).addClass('btn-group').find('button').addClass('btn btn-white btn-info btn-bold')
                
                //and append it to our table tools btn-group, also add tooltip
                $(colvis.button())
                .prependTo('.tableTools-container .btn-group')
                .attr('title', 'Mostrar/Ocultar columnas').tooltip({container: 'body'});
                
                //and make the list, buttons and checkboxed Ace-like
                $(colvis.dom.collection)
                .addClass('dropdown-menu dropdown-light dropdown-caret dropdown-caret-right')
                .find('li').wrapInner('<a href="javascript:void(0)" />') //'A' tag is required for better styling
                .find('input[type=checkbox]').addClass('ace').next().addClass('lbl padding-8');
            
            
                
                /////////////////////////////////
                //table checkboxes
                $('th input[type=checkbox], td input[type=checkbox]').prop('checked', false);
                
                //select/deselect all rows according to table header checkbox
                $('#dynamic-table > thead > tr > th input[type=checkbox]').eq(0).on('click', function(){
                    var th_checked = this.checked;//checkbox inside "TH" table header
                    
                    $(this).closest('table').find('tbody > tr').each(function(){
                        var row = this;
                        if(th_checked) tableTools_obj.fnSelect(row);
                        else tableTools_obj.fnDeselect(row);
                    });
                });
                
                //select/deselect a row when the checkbox is checked/unchecked
                $('#dynamic-table').on('click', 'td input[type=checkbox]' , function(){
                    var row = $(this).closest('tr').get(0);
                    if(!this.checked) tableTools_obj.fnSelect(row);
                    else tableTools_obj.fnDeselect($(this).closest('tr').get(0));
                });
                
            
                
                
                    $(document).on('click', '#dynamic-table .dropdown-toggle', function(e) {
                    e.stopImmediatePropagation();
                    e.stopPropagation();
                    e.preventDefault();
                });
                
                
                //And for the first simple table, which doesn't have TableTools or dataTables
                //select/deselect all rows according to table header checkbox
                var active_class = 'active';
                $('#simple-table > thead > tr > th input[type=checkbox]').eq(0).on('click', function(){
                    var th_checked = this.checked;//checkbox inside "TH" table header
                    
                    $(this).closest('table').find('tbody > tr').each(function(){
                        var row = this;
                        if(th_checked) $(row).addClass(active_class).find('input[type=checkbox]').eq(0).prop('checked', true);
                        else $(row).removeClass(active_class).find('input[type=checkbox]').eq(0).prop('checked', false);
                    });
                });
                
                //select/deselect a row when the checkbox is checked/unchecked
                $('#simple-table').on('click', 'td input[type=checkbox]' , function(){
                    var $row = $(this).closest('tr');
                    if(this.checked) $row.addClass(active_class);
                    else $row.removeClass(active_class);
                });
            
                
            
                /********************************/
                //add tooltip for small view action buttons in dropdown menu
                $('[data-rel="tooltip"]').tooltip({placement: tooltip_placement});
                
                //tooltip placement on right or left
                function tooltip_placement(context, source) {
                    var $source = $(source);
                    var $parent = $source.closest('table')
                    var off1 = $parent.offset();
                    var w1 = $parent.width();
            
                    var off2 = $source.offset();
                    //var w2 = $source.width();
            
                    if( parseInt(off2.left) < parseInt(off1.left) + parseInt(w1 / 2) ) return 'right';
                    return 'left';
                }
            
            })
        </script>
    </body>
</html>
