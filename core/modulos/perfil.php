<?php
if (! defined ( 'SRCP' )) {
	die ( "Logged Hacking attempt!" );
}
$data = getDataBySession($_COOKIE["session"],$db);
?>
<!DOCTYPE html>
<html lang="en">
	<head>
	<title>Panel principal</title>
	<?php
		include_once (STATIC_DIR . '/header.php');
		?>
		<!-- page specific plugin styles -->
		<link rel="stylesheet" href="assets/css/jquery-ui.custom.min.css" />
		<link rel="stylesheet" href="assets/css/jquery.gritter.min.css" />
		<link rel="stylesheet" href="assets/css/select2.min.css" />
		<link rel="stylesheet" href="assets/css/datepicker.min.css" />
		<link rel="stylesheet" href="assets/css/bootstrap-editable.min.css" />
	</head>

	<body class="no-skin">
    <?php include_once STATIC_DIR.'/menu.php';
          ?>
			<div class="main-content">
				<div class="main-content-inner">
					<div class="breadcrumbs" id="breadcrumbs">
						<ul class="breadcrumb">
							<li>
								<i class="ace-icon fa fa-home home-icon"></i>
								<a href="index.php">Inicio</a>
							</li>
							<li>
							<span>Profesores</span></li>
							<li class="active">Perfil de profesor</li>
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
								Resumen personal
								<small>
									<i class="ace-icon fa fa-angle-double-right"></i>
									Perfil de <?php echo $row['nombre'] . " " . $row['apellido']; ; ?>
								</small>
							</h1>
						</div><!-- /.page-header -->

						<div class="row">
							<div class="col-xs-12">
								<!-- PAGE CONTENT BEGINS -->
								<div class="clearfix">
									<div class="pull-left alert alert-success no-margin">
										<button type="button" class="close" data-dismiss="alert">
											<i class="ace-icon fa fa-times"></i>
										</button>

										<i class="ace-icon fa fa-umbrella bigger-120 blue"></i>
										Haga clic en algún campo para editarlo ...
									</div>
								</div>
								<!-- <div class="clearfix">
									<div>
										<button type="button" data-toggle="modal" data-target="#queja" class="btn btn-default">button</button>
									</div>
								</div> -->
								<div class="hr dotted"></div>

								<div>
									<div id="user-profile-1" class="user-profile row">
										<div class="col-xs-12 col-sm-3 center">
											<div>
												<span class="profile-picture">
													<img id="avatar" class="editable img-responsive" alt="Alex's Avatar" src="assets/avatars/avatar2.png" />
												</span>

												<div class="space-4"></div>

												<div class="width-80 label label-info label-xlg arrowed-in arrowed-in-right">
													<div class="inline position-relative">
														<span class="user-title-label"></span>
															&nbsp;
															<span class="white"><?php echo $row['nombre']; ?></span>
														</a>
													</div>
												</div>
											</div>

											<div class="space-6"></div>

											<div class="profile-contact-info">
												<div class="profile-contact-links align-left">
													<a href="#" class="btn btn-link">
														<i class="ace-icon fa fa-plus-circle bigger-120 green"></i>
														Agregar a un grupo
													</a>

													<a href="#" class="btn btn-link">
														<i class="ace-icon fa fa-envelope bigger-120 pink"></i>
														Enviar un correo electrónico
													</a>

													<a href="#" class="btn btn-link">
														<i class="ace-icon fa fa-globe bigger-125 blue"></i>
														Sitio web
													</a>
													<div>

													</div>
												</div>

												<div class="space-6"></div>

												<div class="profile-social-links align-center">
													<a href="#" class="tooltip-info" title="" data-original-title="Facebook">
														<i class="middle ace-icon fa fa-facebook-square fa-2x blue"></i>
													</a>

													<a href="#" class="tooltip-info" title="" data-original-title="Twitter">
														<i class="middle ace-icon fa fa-twitter-square fa-2x light-blue"></i>
													</a>

													<a href="#" class="tooltip-error" title="" data-original-title="Pinterest">
														<i class="middle ace-icon fa fa-pinterest-square fa-2x red"></i>
													</a>
												</div>
											</div>
										</div>

										<div class="col-xs-12 col-sm-9">
										<div class="space-12"></div>
											<div class="profile-user-info profile-user-info-striped">
												<div class="profile-info-row">
													<div class="profile-info-name"> Cédula </div>

													<div class="profile-info-value">
														<span class="editable" id="cedula" name="cedula"><?php echo $row['cedula']; ?></span>
													</div>
												</div>
												<div class="profile-info-row">
													<div class="profile-info-name"> Nombre </div>

													<div class="profile-info-value">
														<span class="editable" id="nombre" name="nombre"><?php echo $row['nombre']; ?></span>
													</div>
												</div>

												<div class="profile-info-row">
													<div class="profile-info-name"> Apellido </div>

													<div class="profile-info-value">
														<span class="editable" id="apellido"><?php echo $row['apellido']; ?></span>
													</div>
												</div>
													<div class="profile-info-name"> Dirección </div>

													<div class="profile-info-value">
														<i class="fa fa-map-marker light-orange bigger-110"></i>
														<span class="editable" id="estado" name="estado"><?php echo $row['estado']; ?></span>
														<span class="editable" id="direccion" name="direccion"><?php echo $row['direccion']; ?></span>
													</div>

												<div class="profile-info-row">
													<div class="profile-info-name"> Edad </div>

													<div class="profile-info-value">
														<span class="editable" id="edad" name="edad"><?php echo $row['edad']; ?></span>
													</div>
												</div>
												<div class="profile-info-row">
													<div class="profile-info-name"> Fecha de nacimiento </div>

													<div class="profile-info-value">
														<span class="editable" id="nacimiento" name="nacimiento"><?php echo $row['nacimiento']; ?></span>
													</div>
												</div>

												<div class="profile-info-row">
													<div class="profile-info-name"> Contratado el </div>

													<div class="profile-info-value">
														<span class="editable" id="f_contratado" name="f_contratado"><?php echo $row['f_contratado'];?></span>
													</div>
												</div>

												<div class="profile-info-row">
													<div class="profile-info-name"> Teléfono </div>

													<div class="profile-info-value">
														<span class="editable" id="telefono" name="telefono"><?php echo $row['telefono']; ?></span>
													</div>
												</div>
												<div class="profile-info-row">
													<div class="profile-info-name"> Correo </div>

													<div class="profile-info-value">
														<span class="editable" id="correo" name="correo"><?php echo $row['correo']; ?></span>
													</div>
												</div>

												<div class="profile-info-row">
													<div class="profile-info-name"> Genero </div>

													<div class="profile-info-value">
														<span class="editable" id="genero" name="genero"><?php echo $row['genero']; ?></span>
													</div>
												</div>
												<div class="profile-info-row">
													<div class="profile-info-name"> Condición </div>

													<div class="profile-info-value">
														<span class="editable" id="condicion" name="condicion"><?php echo $row['condicion']; ?></span>
													</div>
												</div>
												<div class="profile-info-row">
													<div class="profile-info-name"> Formación </div>

													<div class="profile-info-value">
														<span class="editable" id="formacion" name="formacion"><?php echo $row['formacion']; ?></span>
													</div>
												</div>
												<div class="profile-info-row">
													<div class="profile-info-name"> Banco de preferencia </div>

													<div class="profile-info-value">
														<span class="editable" id="banco" name="banco"><?php echo $row['banco']; ?></span>
													</div>
												</div>
												<div class="profile-info-row">
													<div class="profile-info-name"> Numero de cuenta </div>

													<div class="profile-info-value">
														<span class="editable" id="nr_cuenta" name="nr_cuenta"><?php echo $row['nr_cuenta']; ?></span>
													</div>
												</div>
												<div class="profile-info-row">
													<div class="profile-info-name"> Materia principal impartida </div>

													<div class="profile-info-value">
														<span class="editable" id="materia1" name="materia1"><?php echo $row['materia1']; ?></span>
													</div>
												</div>
												<div class="profile-info-row">
													<div class="profile-info-name"> Materia secundaria </div>

													<div class="profile-info-value">
														<span class="editable" id="materia2" name="materia2"><?php echo $row['materia2']; ?></span>
													</div>
												</div>

												<div class="profile-info-row">
													<div class="profile-info-name"> Notas sobre el profesor </div>

													<div class="profile-info-value">
														<span class="editable" id="about">Editar con WYSIWYG</span>
													</div>
												</div>
												<div class="profile-info-row">
													<div class="profile-info-name">Quejas</div>
													<div class="profile-info-valuie">
														<?php
														// query para seleccionar todos los datos del profesor.
														$query = "  SELECT 	*
													            	FROM 	quejas
													          		WHERE 	cedula = :cedula
													        ";
													        $query_params = array(
													            ':cedula' => $row['cedula']
													        );

													        try{
													            $stmt = $db->prepare($query);
													            $quejas_result = $stmt->execute($query_params);
													        }
													        catch(PDOException $ex){
															echo "<div class='panel-body'>
													                <div class='alert alert-warning alert-dismissable'>
													            	    <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
													            	    Tenemos problemas al ejecutar la consulta :c El error es el siguiente:
																	</div>
																 </div>" .$ex->getMessage();
															}
													        $row_queja = $stmt->fetchAll();
													        $num_rows = count($row_queja);
													        echo $num_rows;
														?>

													</div>
												</div>
											</div>

											<div class="space-6"></div>

											<div class="center">
												<a href="perfil.php?id=<?PHP echo $row['ID']?>&queja=si"><button type="button" class="btn btn-sm btn-warning btn-white btn-round">
													<i class="ace-icon fa fa-flag bigger-150 middle orange2"></i>
													<span class="bigger-110">Agregar queja</span>

													<i class="icon-on-right ace-icon fa fa-arrow-right"></i>
												</button></a>
											</div>
										</div>
									</div>
								</div>
							</div><!-- /.user-profile -->
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
							&copy; 2013-2014
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

		<!--[if lte IE 8]>
		  <script src="assets/js/excanvas.min.js"></script>
		<![endif]-->
		<script src="assets/js/jquery-ui.custom.min.js"></script>
		<script src="assets/js/jquery.ui.touch-punch.min.js"></script>
		<script src="assets/js/jquery.gritter.min.js"></script>
		<script src="assets/js/bootbox.min.js"></script>
		<script src="assets/js/jquery.easypiechart.min.js"></script>
		<script src="assets/js/bootstrap-datepicker.min.js"></script>
		<script src="assets/js/jquery.hotkeys.min.js"></script>
		<script src="assets/js/bootstrap-wysiwyg.min.js"></script>
		<script src="assets/js/select2.min.js"></script>
		<script src="assets/js/fuelux.spinner.min.js"></script>
		<script src="assets/js/bootstrap-editable.min.js"></script>
		<script src="assets/js/ace-editable.min.js"></script>
		<script src="assets/js/jquery.maskedinput.min.js"></script>

		<!-- ace scripts -->
		<script src="assets/js/ace-elements.min.js"></script>
		<script src="assets/js/ace.min.js"></script>

		<!-- inline scripts related to this page -->
		<script type="text/javascript">
			jQuery(function($) {

				//editables on first profile page
				$.fn.editable.defaults.mode = 'inline';
				$.fn.editableform.loading = "<div class='editableform-loading'><i class='ace-icon fa fa-spinner fa-spin fa-2x light-blue'></i></div>";
			    $.fn.editableform.buttons = '<button type="submit" class="btn btn-info editable-submit"><i class="ace-icon fa fa-check"></i></button>'+
			                                '<button type="button" class="btn editable-cancel"><i class="ace-icon fa fa-times"></i></button>';

				//editables

				//text editable
			    $('#nombre')
				.editable({
					type: 'text',
					name: 'nombre'
			    });
			    $('#apellido')
				.editable({
					type: 'text',
					name: 'nombre'
			    });

			    $('#estado')
				.editable({
					type: 'text',
					name: 'estado'
			    });

			    $('#direccion')
				.editable({
					type: 'text',
					name: 'direccion'
			    });


				//custom date editable
				$('#contrato_fecha').editable({
					type: 'adate',
					date: {
						//datepicker plugin options
						    format: 'yyyy/mm/dd',
						viewformat: 'yyyy/mm/dd',
						 weekStart: 1

						//,nativeUI: true//if true and browser support input[type=date], native browser control will be used
						//,format: 'yyyy-mm-dd',
						//viewformat: 'yyyy-mm-dd'
					}
				})

			    $('#edad').editable({
			        type: 'spinner',
					name : 'edad',
					spinner : {
						min : 16,
						max : 99,
						step: 1,
						on_sides: true
						//,nativeUI: true//if true and browser support input[type=number], native browser control will be used
					}
				});

				$('#about').editable({
					mode: 'inline',
			        type: 'wysiwyg',
					name : 'about',

					wysiwyg : {
						//css : {'max-width':'300px'}
					},
					success: function(response, newValue) {
					}
				});



				// *** editable avatar *** //
				try {//ie8 throws some harmless exceptions, so let's catch'em

					//first let's add a fake appendChild method for Image element for browsers that have a problem with this
					//because editable plugin calls appendChild, and it causes errors on IE at unpredicted points
					try {
						document.createElement('IMG').appendChild(document.createElement('B'));
					} catch(e) {
						Image.prototype.appendChild = function(el){}
					}

					var last_gritter
					$('#avatar').editable({
						type: 'image',
						name: 'avatar',
						value: null,
						image: {
							//specify ace file input plugin's options here
							btn_choose: 'Cambiar foto',
							droppable: true,
							maxSize: 110000,//~100Kb

							//and a few extra ones here
							name: 'avatar',//put the field name here as well, will be used inside the custom plugin
							on_error : function(error_type) {//on_error function will be called when the selected file has a problem
								if(last_gritter) $.gritter.remove(last_gritter);
								if(error_type == 1) {//file format error
									last_gritter = $.gritter.add({
										title: 'Este archivo NO es una foto!',
										text: 'Por favor elija un archivo de formato jpg|gif|png!',
										class_name: 'gritter-error gritter-center'
									});
								} else if(error_type == 2) {//file size rror
									last_gritter = $.gritter.add({
										title: 'El archivo es muy grande!',
										text: 'El archivo no debe exceder 100Kb!',
										class_name: 'gritter-error gritter-center'
									});
								}
								else {//other error
								}
							},
							on_success : function() {
								$.gritter.removeAll();
							}
						},
					    url: function(params) {
							// ***UPDATE AVATAR HERE*** //
							//for a working upload example you can replace the contents of this function with
							//examples/profile-avatar-update.js

							var deferred = new $.Deferred

							var value = $('#avatar').next().find('input[type=hidden]:eq(0)').val();
							if(!value || value.length == 0) {
								deferred.resolve();
								return deferred.promise();
							}


							//dummy upload
							setTimeout(function(){
								if("FileReader" in window) {
									//for browsers that have a thumbnail of selected image
									var thumb = $('#avatar').next().find('img').data('thumb');
									if(thumb) $('#avatar').get(0).src = thumb;
								}

								deferred.resolve({'status':'OK'});

								if(last_gritter) $.gritter.remove(last_gritter);
								last_gritter = $.gritter.add({
									title: 'Foto cambiada!',
									text: 'Uploading to server can be easily implemented. A working example is included with the template.',
									class_name: 'gritter-info gritter-center'
								});

							 } , parseInt(Math.random() * 800 + 800))

							return deferred.promise();

							// ***END OF UPDATE AVATAR HERE*** //
						},

						success: function(response, newValue) {
						}
					})
				}catch(e) {}

				/**
				//let's display edit mode by default?
				var blank_image = true;//somehow you determine if image is initially blank or not, or you just want to display file input at first
				if(blank_image) {
					$('#avatar').editable('show').on('hidden', function(e, reason) {
						if(reason == 'onblur') {
							$('#avatar').editable('show');
							return;
						}
						$('#avatar').off('hidden');
					})
				}
				*/

				//another option is using modals
				$('#avatar2').on('click', function(){
					var modal =
					'<div class="modal fade">\
					  <div class="modal-dialog">\
					   <div class="modal-content">\
						<div class="modal-header">\
							<button type="button" class="close" data-dismiss="modal">&times;</button>\
							<h4 class="blue">Cambiar foto</h4>\
						</div>\
						\
						<form class="no-margin">\
						 <div class="modal-body">\
							<div class="space-4"></div>\
							<div style="width:75%;margin-left:12%;"><input type="file" name="file-input" /></div>\
						 </div>\
						\
						 <div class="modal-footer center">\
							<button type="submit" class="btn btn-sm btn-success"><i class="ace-icon fa fa-check"></i> Guardar</button>\
							<button type="button" class="btn btn-sm" data-dismiss="modal"><i class="ace-icon fa fa-times"></i> Cancelar</button>\
						 </div>\
						</form>\
					  </div>\
					 </div>\
					</div>';


					var modal = $(modal);
					modal.modal("show").on("hidden", function(){
						modal.remove();
					});

					var working = false;

					var form = modal.find('form:eq(0)');
					var file = form.find('input[type=file]').eq(0);
					file.ace_file_input({
						style:'well',
						btn_choose:'Click para elegir una nueva foto',
						btn_change:null,
						no_icon:'ace-icon fa fa-picture-o',
						thumbnail:'small',
						before_remove: function() {
							//don't remove/reset files while being uploaded
							return !working;
						},
						allowExt: ['jpg', 'jpeg', 'png', 'gif'],
						allowMime: ['image/jpg', 'image/jpeg', 'image/png', 'image/gif']
					});

					form.on('Guardar', function(){
						if(!file.data('ace_input_files')) return false;

						file.ace_file_input('disable');
						form.find('button').attr('disabled', 'disabled');
						form.find('.modal-body').append("<div class='center'><i class='ace-icon fa fa-spinner fa-spin bigger-150 orange'></i></div>");

						var deferred = new $.Deferred;
						working = true;
						deferred.done(function() {
							form.find('button').removeAttr('disabled');
							form.find('input[type=file]').ace_file_input('enable');
							form.find('.modal-body > :last-child').remove();

							modal.modal("hide");

							var thumb = file.next().find('img').data('thumb');
							if(thumb) $('#avatar2').get(0).src = thumb;

							working = false;
						});


						setTimeout(function(){
							deferred.resolve();
						} , parseInt(Math.random() * 800 + 800));

						return false;
					});

				});



				/////////////////////////////////////
				$(document).one('ajaxloadstart.page', function(e) {
					//in ajax mode, remove remaining elements before leaving page
					try {
						$('.editable').editable('destroy');
					} catch(e) {}
					$('[class*=select2]').remove();
				});
			});
    $(window).load(function(){
        $('#queja').modal('show');
    });
		</script>
		<?php
		//creamos una busqueda para las quejas
	    $quejas = 'SELECT * FROM l_quejas';
	    // Creamos la busqueda por nuestro metodo $db->query(La consulta anterior $sql)y asignamos los valores a $result
	    $result = $db->query($quejas);
	    // Extraemos los valores de  $result
	    $rows = $result->fetchAll();
	    // Como estan en un arreglo, sacamos cada uno desde $rows
		if(isset($_GET['queja'])){
		//chequeamos la accion en el GET.
    switch ($_GET['queja']) {
        case 'si':
            echo "
            <form name='enviar_queja' method='post' action='perfil.php?id=";
            echo $row['ID'];
            echo "' role='form'>
            <div class='modal fade' id='queja' tabindex='-1' role='dialog' aria-labeledby='quejaLabel' aria-hidden='false'>
			<div class='modal-dialog'>
                <div class='modal-content'>
					<div class='modal-header'>
						<button type='button' class='close' data-dismiss='modal' aria-hidden='true'>&times;</button>
						<h3>¡Agregar una queja!</h3>
					</div>
					<div class='modal-body'>
						<p>Para agregar una queja simplemente selecciona de la lista la queja que quieras poner.</p>
						<!--Nota: el autofocus solo sirve en Chrome :c -->
						<select autofocus name='quejas' id='quejas' class='form-control' required='required'>";
							foreach ($rows as $row){
							echo "<option value='";
							echo $row['queja'];
							echo "'>";
							echo $row['queja'];
							echo "</option>";
							}
						echo "</select>
						<p> De igual forma puedes hacer clic en la X en la parte superior para evitar enviar la queja.</p>
					</div>
					<div class='modal-footer'>
					<button type='submit' id='enviar_queja' name='enviar_queja' class='btn btn-info'>¡Enviar!</button>
					</div>
                </div>
            </div>
        </div>
        </form>";
            break;
        }}
        ?>
        <?php
//comienzo del registro de quejas.
//Verificamos con isset si la variable enviar_queja fue enviada y no es NULL
	if(isset($_POST['enviar_queja']))
    {
    	/**
    	 * Las quejas se encuentran en l_quejas
    	 * Así que como ya las habiamos mostrado
    	 * solo debemos tomarlas y meterlas en la nueva
    	 * tabla quejas con los datos del amonestado
    	 *
    	 * TODO  Seleccionar la cedula del ID Agregar Cedula - Queja - Nivel a tabla quejas  Actualizar la suma de las quejas al profesor. -- No implementado
    	 */
        /// hacemos un query para seleccionar la cedula

        $query = "SELECT 	*
            	  FROM 		profesores
            	  WHERE 	ID = :id;
            	  ";
        $query_params = array(
            ':id' => $_GET['id']
        );
        try {
            $stmt = $db->prepare($query);
            $resultado = $stmt->execute($query_params);
        }
        catch(PDOException $ex){
		// Si tenemos problemas para ejecutar la consulta imprimimos el error
			echo "<div class='panel-body'>
                     <div class='alert alert-warning alert-dismissable'>
                        <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                        Tenemos problemas al ejecutar la consulta :c El error es el siguiente:
					</div>
				  </div>" .$ex->getMessage();}
		//si pasamos el error almacenamos la cedula de ese profesor en un arreglo.
		$queja_row = $stmt->fetch();
		$cedula = $queja_row['cedula'];
		//almacenamos en la variable $cedula el resultado del indice del arreglo $queja_row en cedula

		// Buscamos el nivel de la queja que se va a sumar.
		$query = "SELECT 	*
            	  FROM 		l_quejas
            	  WHERE 	queja = :queja;
            	  ";
        $query_params = array(
            ':queja' => $_POST['quejas']
        );
        try {
            $stmt = $db->prepare($query);
            $resultado = $stmt->execute($query_params);
        }
        catch(PDOException $ex){
		// Si tenemos problemas para ejecutar la consulta imprimimos el error
			echo "<div class='panel-body'>
                     <div class='alert alert-warning alert-dismissable'>
                        <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                        Tenemos problemas al ejecutar la consulta :c El error es el siguiente:
					</div>
				  </div>" .$ex->getMessage();}
		//si pasamos el error almacenamos la cedula de ese profesor en un arreglo.
		$lista_queja = $stmt->fetch();
		$nivel = $lista_queja['nivel'];
		//almacenamos en la variable $nivel el resultado del indice del arreglo $lista_queja en cedula

	 	//Ahora vamos a agregar la queja en la tabla de quejas con los datos del profesor
	 	$query = "INSERT INTO quejas (
            	  			  cedula,
            	  			  quejas,
            	  			  nivel
            	  	)
            	  VALUES(	  :cedula,
            	  			  :quejas,
            	  			  :nivel
            	  	)
            	  ";
        $query_params = array(
        	':quejas' => $_POST['quejas'],
            ':cedula' => $queja_row['cedula'],
            ':nivel' => $nivel
        );
        try {
            $stmt = $db->prepare($query);
            $resultado = $stmt->execute($query_params);
        }
        catch(PDOException $ex){
		// Si tenemos problemas para ejecutar la consulta imprimimos el error
			echo "<div class='panel-body'>
                     <div class='alert alert-warning alert-dismissable'>
                        <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                        Tenemos problemas al ejecutar la consulta :c El error es el siguiente:
					</div>
				  </div>" .$ex->getMessage();}

    } //fin del isset de quejas!
        ?>
	</body>
</html>
