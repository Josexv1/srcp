<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Listar profesor - SRCP</title>
        <?php
            if (!defined('SRCP')) {
                die('Logged Hacking attempt!');
            }
        $data = getDataBySession($_COOKIE['session'], $db);
        include INC_DIR.'/list_prof.php';
        include STATIC_DIR.'/header.php';
        ?>
    </head>

    <body class="no-skin">
        <?php include STATIC_DIR.'/menu.php';?>
            <div class="main-content">
                <div class="main-content-inner">
                    <div class="breadcrumbs" id="breadcrumbs">
                       <ul class="breadcrumb">
                            <li>
                                <i class="ace-icon fa fa-home home-icon"></i>
                                <a href="index.php">Inicio</a>
                            </li>
                            <li class="active">Lista de profesores</li>
                        </ul><!-- /.breadcrumb -->

                        <div class="nav-search" id="nav-search">
                            <form class="form-search">
                                <span class="input-icon">
                                    <input type="text" placeholder="Buscar..." class="nav-search-input" id="nav-search-input" autocomplete="off" />
                                    <i class="ace-icon fa fa-search nav-search-icon"></i>
                                </span>
                            </form>
                        </div><!-- /.nav-search -->
                        <!-- /.page-header -->
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
                                                        <th>Cédula</th>
                                                        <th>Nombre</th>
                                                        <th>Apellido</th>
                                                        <th>Condición</th>
                                                        <th>Teléfono</th>
                                                        <th>Acciones</th>
                                                    </tr>
                                                </thead>

                                                <tbody>
                                                <?php foreach ($rows as $row) {
    ?>
                                                    <tr>
                                                        <td></td>
                                                        <td><?php echo $row['cedula'];
    ?></td>
                                                        <td><?php echo $row['nombre'];
    ?></td>
                                                        <td><?php echo $row['apellido'];
    ?></td>
                                                        <td><?php echo $row['condicion'];
    ?></td>
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
                                                <?php
} ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div><!-- PAGE CONTENT ENDS -->
            </div>
            </div>
            </div></div>
  <?php include_once STATIC_DIR.'/footer.php';?>
        <!-- page specific plugin scripts -->
        <script src="assets/js/validar.js"></script>
        <!--<script src="assets/js/additional-methods.min.js"></script>-->
        <script src="assets/js/bootbox.min.js"></script>
        <script src="assets/js/jquery.dataTables.min.js"></script>
        <script src="assets/js/jquery.dataTables.bootstrap.min.js"></script>
        <script src="assets/js/dataTables.tableTools.min.js"></script>
        <script src="assets/js/dataTables.colVis.min.js"></script>

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
                            "sToolTip": "Copiar al porta papeles",
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

                            "sInfo": "<h3 class='no-margin-top'>Vista de impresión</h3>\
                                      <p>Por favor, utilice la función de imprimir del navegador para imprimir este documento, Normalmente es CTRL+P\
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
