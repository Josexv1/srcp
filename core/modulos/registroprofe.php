<!DOCTYPE html>
<html lang="en">

<head>
	<title>Registro de profesores - SRCP</title>
	<?php
            if (!defined('SRCP')) {
                die('Logged Hacking attempt!');
            }
        $data = getDataBySession($_COOKIE['session'], $db);
            if (!empty($_POST)) {
                @include_once INC_DIR.'reg_prof.php';
            }
        @include_once STATIC_DIR.'/header.php';
        ?>
		<!-- page specific plugin styles -->
		<link rel="stylesheet" href="assets/css/bootstrap-multiselect.min.css" />
		<link rel="stylesheet" href="assets/css/datepicker.min.css" />
		<link rel="stylesheet" href="assets/css/wizard-validation.css" />
</head>

<body class="no-skin">
	<?php @include_once STATIC_DIR.'/menu.php';
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
				</div>
				<!-- /.nav-search -->

				<div class="row">
					<div class="col-xs-12">
						<!-- PAGE CONTENT BEGINS -->
						<table align="center" border="0" cellpadding="0" cellspacing="0">
							<tr>
								<td>
									<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="POST">
										<input type='hidden' name="issubmit" value="1">
										<!-- Tabs -->
										<div id="wizard" class="swMain">
											<ul>
												<li>
													<a href="#step-1">
														<label class="stepNumber">1</label>
														<span class="stepDesc">Personal<br />
                   <small>Detalles personales</small>
                </span>
													</a>
												</li>
												<li>
													<a href="#step-2">
														<label class="stepNumber">2</label>
														<span class="stepDesc">Academicos<br />
                   <small>Datos academicos</small>
                </span>
													</a>
												</li>
												<li>
													<a href="#step-3">
														<label class="stepNumber">3</label>
														<span class="stepDesc">Financieros<br />
                   <small>Datos financieros</small>
                </span>
													</a>
												</li>
											</ul>
											<div id="step-1">
												<h2 class="StepTitle">Paso 1: Datos del profesor.</h2>
												<table cellspacing="3" cellpadding="3" align="center">
													<tr>
														<td align="right">Cedula :</td>
														<td align="left">
															<input onkeyup="this.value=this.value.replace(/[^0-9]/g,'');" type="text" id="cedula" name="cedula" value="" class="txtBox">
														</td>
														<td align="left"><span id="msg_cedula"></span>&nbsp;</td>
													</tr>
													<tr>
														<td align="right">Nombre :</td>
														<td align="left">
															<input type="text" id="nombre" name="nombre" value="" class="txtBox">
														</td>
														<td align="left"><span id="msg_nombre"></span>&nbsp;</td>
													</tr>
													<tr>
														<td align="right">Apellido :</td>
														<td align="left">
															<input type="text" id="apellido" name="apellido" value="" class="txtBox">
														</td>
														<td align="left"><span id="msg_apellido"></span>&nbsp;</td>
													</tr>
													<tr>
														<td align="right">Direccion :</td>
														<td align="left">
															<input type="text" id="direccion" name="direccion" value="" class="txtBox">
														</td>
														<td align="left"><span id="msg_direccion"></span>&nbsp;</td>
													</tr>
													<tr>
														<td align="right">Telefono :</td>
														<td align="left">
															<input type="text" id="telefono" name="telefono" value="" class="txtBox bfh-phone" data-format="+58 (dddd) ddd-dddd">
														</td>
														<td align="left"><span id="msg_telefono"></span>&nbsp;</td>
													</tr>
													<tr>
														<td align="right">Correo :</td>
														<td align="left">
															<input type="email" id="correo" name="correo" value="" class="txtBox">
														</td>
														<td align="left"><span id="msg_correo"></span>&nbsp;</td>
													</tr>
													<tr>
														<td align="right">Condicion :</td>
														<td align="left">
															<select id="condicion" name="condicion" class="form-control selectpicker">
															  <option>Tiempo completo</option>
															  <option>Tiempo medio</option>
															  <option>Condicional</option>
															</select>
														</td>
														<td align="left"><span id="msg_condicion"></span>&nbsp;</td>
													</tr>
													<tr>
														<td align="right">Fecha de nacimiento :</td>
														<td align="left">
															<span class="block input-icon input-icon-right">
																	<input class="date-picker txtBox" id="id-date-picker-1" name="nacimiento" type="text" data-date-format="yyyy-mm-dd" required="required"/>
																	<i class="ace-icon fa fa-calendar"></i>
															</span>
														</td>
														<td align="left"><span id="msg_nacimiento"></span>&nbsp;</td>
													</tr>
													<tr>
														<td align="right">Genero :</td>
														<td align="left">
															<input name="genero" value="Masculino" type="radio" class="ace" />
																<span class="lbl"> Masculino</span>
																<input name="genero" value="Femenino" type="radio" class="ace" />
																<span class="lbl"> Femenino</span>
														</td>
														<td align="left"><span id="msg_genero"></span>&nbsp;</td>
													</tr>
													<tr>
														<td align="right">Estado :</td>
														<td align="left">
															<select id="estado" name="estado" value="" class="form-control bfh-states" data-country="VE" data-state="LA"></select>
														</td>
														<td align="left"><span id="msg_estado"></span>&nbsp;</td>
													</tr>
												</table>
											</div>
											<div id="step-2">
												<h2 class="StepTitle">Paso 2: Detalles academicos</h2>
												<table cellspacing="3" cellpadding="3" align="center">
													<tr>
														<td align="right">Titulo :</td>
														<td align="left">
															<input type="text" id="titulo" name="titulo" value="" class="txtBox">
														</td>
														<td align="left"><span id="msg_titulo"></span>&nbsp;</td>
													</tr>
													<tr>
														<td align="right">Especialidad :</td>
														<td align="left">
															<input type="text" id="especialidad" name="especialidad" value="" class="txtBox">
														</td>
														<td align="left"><span id="msg_especialidad"></span>&nbsp;</td>
													</tr>
												</table>
											</div>
											<div id="step-3">
												<h2 class="StepTitle">Paso 3: Detalles financieros</h2>
												<table cellspacing="3" cellpadding="3" align="center">
													<tr>
														<td align="right">Banco :</td>
														<td align="left">
															<input type="text" id="banco" name="banco" value="" class="txtBox">
														</td>
														<td align="left"><span id="msg_banco"></span>&nbsp;</td>
													</tr>
													<tr>
														<td align="right">Numero de cuenta :</td>
														<td align="left">
															<input onkeyup="this.value=this.value.replace(/[^0-9]/g,'');" type="num" id="ncuenta" name="ncuenta" value="" class="txtBox">
														</td>
														<td align="left"><span id="msg_ncuenta"></span>&nbsp;</td>
													</tr>
												</table>
											</div>
										</div>
										<!-- End SmartWizard Content -->
									</form>
								</td>
							</tr>
						</table>
						<!-- PAGE CONTENT ENDS -->
					</div>
					<!-- /.col -->
				</div>
				<!-- /.row -->
			</div>
			<!-- /.page-content -->
		</div>
	</div>
	<!-- /.main-content -->

	<?php @include_once STATIC_DIR.'/footer.php';        ?>

	<!-- page specific plugin scripts -->
	<script src="assets/js/typeahead.jquery.min.js"></script>
	<!--<script src="assets/js/additional-methods.min.js"></script>-->
	<script src="assets/js/bootbox.min.js"></script>
	<script src="assets/js/jquery.maskedinput.min.js"></script>
	<script src="assets/js/bootstrap-multiselect.min.js"></script>
	<script src="assets/js/bootstrap-datepicker.min.js"></script>
	<script src="assets/js/jquery.smartWizard-2.0.min.js"></script>
	<script src="assets/js/bootstrap-formhelpers.min.js"></script>
	<!-- ace scripts -->

	<!-- inline scripts related to this page -->
	<script type="text/javascript">
		$(document).ready(function() {
			// wizard
			$('#wizard').smartWizard({
				transitionEffect: 'slideleft',
				onLeaveStep: leaveAStepCallback,
				onFinish: onFinishCallback,
				//enableFinishButton: true
			});

			function leaveAStepCallback(obj) {
				var step_num = obj.attr('rel');
				return validateSteps(step_num);
			}

			function onFinishCallback() {
				if (validateAllSteps()) {
					$('form').submit();
				}
			}
		});

		function validateAllSteps() {
			var isStepValid = true;
			if (validateStep1() == false) {
				isStepValid = false;
				$('#wizard').smartWizard('setError', {
					stepnum: 1,
					iserror: true
				});
			} else {
				$('#wizard').smartWizard('setError', {
					stepnum: 1,
					iserror: false
				});
			}
			if (validateStep2() == false) {
				isStepValid = false;
				$('#wizard').smartWizard('setError', {
					stepnum: 2,
					iserror: true
				});
			} else {
				$('#wizard').smartWizard('setError', {
					stepnum: 2,
					iserror: false
				});
			}
			if (validateStep3() == false) {
				isStepValid = false;
				$('#wizard').smartWizard('setError', {
					stepnum: 3,
					iserror: true
				});
			} else {
				$('#wizard').smartWizard('setError', {
					stepnum: 3,
					iserror: false
				});
			}
			if (!isStepValid) {
				$('#wizard').smartWizard('showMessage', 'Corrija los datos!');
			}
			return isStepValid;
		}
		function validateSteps(step) {
			var isStepValid = true;
			// validar paso 1
			if (step == 1) {
				if (validateStep1() == false) {
					isStepValid = false;
					$('#wizard').smartWizard('showMessage', 'Corrija los datos en el paso' + step + ' Y continue.');
					$('#wizard').smartWizard('setError', {
						stepnum: step,
						iserror: true
					});
				} else {
					$('#wizard').smartWizard('setError', {
						stepnum: step,
						iserror: false
					});
				}
			}
			//validar paso 2
			if (step == 2) {
				if (validateStep2() == false) {
					isStepValid = false;
					$('#wizard').smartWizard('showMessage', 'Corrija los datos en el paso' + step + ' Y continue.');
					$('#wizard').smartWizard('setError', {
						stepnum: step,
						iserror: true
					});
				} else {
					$('#wizard').smartWizard('setError', {
						stepnum: step,
						iserror: false
					});
				}
			}
			// validar paso 3
			if (step == 3) {
				if (validateStep3() == false) {
					isStepValid = false;
					$('#wizard').smartWizard('showMessage', 'Corrija los datos en el paso' + step + ' Y continue.');
					$('#wizard').smartWizard('setError', {
						stepnum: step,
						iserror: true
					});
				} else {
					$('#wizard').smartWizard('setError', {
						stepnum: step,
						iserror: false
					});
				}
			}
			return isStepValid;
		}

		function validateStep1() {
			var isValid = true;
			/*
			Validacion de los datos del paso 1
			Se validan 1 x 1 y se muestra el mensaje en el espacio del msg_dato
			*/
			var un = $('#cedula').val();
			if (!un && un.length <= 0) {
				isValid = false;
				$('#msg_cedula').html('Llene la cedula').show();
			} else {
				$('#msg_cedula').html('').hide();
			}
			var un = $('#nombre').val();
			if (!un && un.length <= 0) {
				isValid = false;
				$('#msg_nombre').html('Llene el Nombre').show();
			} else {
				$('#msg_nombre').html('').hide();
			}
			var un = $('#apellido').val();
			if (!un && un.length <= 0) {
				isValid = false;
				$('#msg_apellido').html('Llene el apellido').show();
			} else {
				$('#msg_apellido').html('').hide();
			}
			var un = $('#direccion').val();
			if (!un && un.length <= 0) {
				isValid = false;
				$('#msg_direccion').html('Llene la direccion').show();
			} else {
				$('#msg_direccion').html('').hide();
			}
			var un = $('#telefono').val();
			if (!un && un.length <= 0) {
				isValid = false;
				$('#msg_telefono').html('Llene el telefono').show();
			} else {
				$('#msg_telefono').html('').hide();
			}
			//validar el correo
			var email = $('#correo').val();
			if (email && email.length > 0) {
				if (!isValidEmailAddress(email)) {
					isValid = false;
					$('#msg_correo').html('El correo es invalido!').show();
				} else {
					$('#msg_correo').html('').hide();
				}
			} else {
				isValid = false;
				$('#msg_correo').html('Llene el correo').show();
			}
			return isValid;
		}
		function validateStep2(){
			var isValid = true;
			var un = $('#titulo').val();
			if (!un && un.length <= 0) {
				isValid = false;
				$('#msg_titulo').html('Llene el titulo').show();
			} else {
				$('#msg_titulo').html('').hide();
			}
			var un = $('#especialidad').val();
			if (!un && un.length <= 0) {
				isValid = false;
				$('#msg_especialidad').html('Llene la especialidad').show();
			} else {
				$('#msg_especialidad').html('').hide();
			}
			return isValid;
		}

		function validateStep3() {
			var isValid = true;
			var un = $('#banco').val();
			if (!un && un.length <= 0) {
				isValid = false;
				$('#msg_banco').html('Llene el banco').show();
			} else {
				$('#msg_banco').html('').hide();
			}
			var un = $('#ncuenta').val();
			if (!un && un.length <= 0) {
				isValid = false;
				$('#msg_ncuenta').html('Llene el numero de cuenta').show();
			} else {
				$('#msg_ncuenta').html('').hide();
			}
			return isValid;
		}
		// Email Validation
		function isValidEmailAddress(emailAddress) {
			var pattern = new RegExp(
				/^(("[\w-\s]+")|([\w-]+(?:\.[\w-]+)*)|("[\w-\s]+")([\w-]+(?:\.[\w-]+)*))(@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$)|(@\[?((25[0-5]\.|2[0-4][0-9]\.|1[0-9]{2}\.|[0-9]{1,2}\.))((25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\.){2}(25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\]?$)/i
			);
			return pattern.test(emailAddress);
		}

		//datepicker plugin
		//link
		$('.date-picker').datepicker({
				autoclose: true,
				todayHighlight: true
			})
			//Mostrar el datepicker al hacer click en el icono
			.next().on(ace.click_event, function() {
				$(this).prev().focus();
			});
		//to translate the daterange picker, please copy the "examples/daterange-fr.js" contents here before initialization
		$('input[name=date-range-picker]').daterangepicker({
				'applyClass': 'btn-sm btn-success',
				'cancelClass': 'btn-sm btn-default',
				locale: {
					applyLabel: 'Apply',
					cancelLabel: 'Cancel',
				}
			})
			.prev().on(ace.click_event, function() {
				$(this).next().focus();
			});
	</script>
</body>

</html>
