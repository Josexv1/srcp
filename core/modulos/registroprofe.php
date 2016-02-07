<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Registro de profesores - SRCP</title>
		<?php 
			if (! defined ( 'SRCP' )) {
				die ( "Logged Hacking attempt!" ); 
		}
		$data = getDataBySession($_COOKIE["session"],$db);
		    if(!empty($_POST)){
		    	@include_once (INC_DIR . 'reg_prof.php');
		    }
		@include_once (STATIC_DIR . '/header.php'); 
		?>
		<!-- page specific plugin styles -->
		<link rel="stylesheet" href="assets/css/bootstrap-multiselect.min.css" />
		<link rel="stylesheet" href="assets/css/datepicker.min.css" />
		<style type="text/css">
		/*
		Inicio del wizard del registro de profesores.
		 */
				.stepwizard-step p {
				    margin-top: 0px;
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
				    opacity: 1.5 !important;
				    filter: alpha(opacity=100) !important;
				}

				.stepwizard-row:before {
				    top: 20px;
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
				  padding: 	1px 0;
				  font-size: 12px;
				  line-height: 1.428571429;
				  border-radius: 15px;
				}
		</style>
	</head>

	<body class="no-skin">
		<?php @include_once (STATIC_DIR . '/menu.php'); 
		?>
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
						<label class="control-label col-xs-12 col-sm-3 no-padding-right">Estado</label>
							<div class="col-xs-12 col-sm-9">
								<div class="clearfix">
									<div class="input-group">
									<input id="estado" name="estado" class="typeahead scrollable" type="text" placeholder="Estados de Venezuela" required="required"/>
									</div>
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
					</div>
					<div class="form-group">
						<label class="control-label col-xs-12 col-sm-3 no-padding-right" for="telefono" >Numero de Teléfono:</label>
						<div class="col-xs-12 col-sm-9">
							<div class="input-group">
								<input onkeyup="this.value=this.value.replace(/[^0-9]/g,'');" type="tel" id="telefono" name="telefono" class="col-xs-12 col-sm-5 input-large" required="required"/>
							</div>
						</div>
					</div><!-- Fin del Form Group-->
	            </div><button class="btn btn-primary nextBtn btn-lg pull-right" type="button" >Siguiente</button>
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

	<?php @include_once (STATIC_DIR . '/footer.php'); 		?>

		<!-- page specific plugin scripts -->
		<script src="assets/js/validar.js"></script>
		<script src="assets/js/typeahead.jquery.min.js"></script>
		<!--<script src="assets/js/additional-methods.min.js"></script>-->
		<script src="assets/js/bootbox.min.js"></script>
		<script src="assets/js/jquery.maskedinput.min.js"></script>
		<script src="assets/js/bootstrap-multiselect.min.js"></script>
		<script src="assets/js/bootstrap-datepicker.min.js"></script>
		<!-- ace scripts -->

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
