<!DOCTYPE html>
<html>
	<head>
	<a href="presentacion/iconos/uuu.ico"></a>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--========LIBRERIAS=======================================================================================-->	
<link rel="icon" type="image/png" href="presentacion/iconos/uuu.ico"/>
<!--===============================================================================================-->
<a href="principal.php"></a>
	<link rel="stylesheet" type="text/css" href="presentacion/index/vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="presentacion/index/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="presentacion/index/fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="presentacion/index/vendor/animate/animate.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="presentacion/index/vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="presentacion/index/vendor/animsition/css/animsition.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="presentacion/index/vendor/select2/select2.min.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="presentacion/index/vendor/daterangepicker/daterangepicker.css">
<!--===============================================================================================-->
<link rel="stylesheet" type="text/css" href="presentacion/index/css/util.css">
	<link rel="stylesheet" type="text/css" href="presentacion/index/css/main.css">
<!--===============================================================================================-->
</head>
<body>
	
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
                            <form name="formulario" method="post" action="clases/validar.php" class="login100-form validate-form">
				
					<span class="login100-form-title p-b-34">
						INICIO DE SESION
					</span>
					
					<div class="wrap-input100 rs1-wrap-input100 validate-input m-b-20" data-validate="Type user name">
                                            <input id="first-name" class="input100" type="text" name="usuario" placeholder="Usuario">
						<span class="focus-input100"></span>
                                                  </tr>
					</div>
					<div class="wrap-input100 rs2-wrap-input100 validate-input m-b-20" data-validate="Type password">
						<input class="input100" type="password" name="clave" placeholder="Contraseña">
						<span class="focus-input100"></span>
					</div>
					
					<div class="container-login100-form-btn">
                                            <input type="submit" class="login100-form-btn" value="Ingresar">
						
					</div>

					<div class="w-full text-center p-t-27 p-b-150">
						<span class="txt1">
							
                                 <b><a href="index.php?CONTENIDO=interfaces/trabajador/registro.php">Registrarse</a></b>
           
						</span>

						
					</div>

					
				</form>

				<div class="login100-more" style="background-image: url('presentacion/index/images/udenar.jpg');" ></div>
			</div>
		</div>
	</div>
	
	

	<div id="dropDownSelect1"></div>
	
<!--===============================================================================================-->
        <script src="presentacion/index/vendor/jquery/jquery-3.2.1.min.js" type="text/javascript"></script>
<!--===============================================================================================-->
        <script src="presentacion/index/vendor/animsition/js/animsition.min.js" type="text/javascript"></script>
<!--===============================================================================================-->
        <script src="presentacion/index/vendor/bootstrap/js/popper.js" type="text/javascript"></script>
        <script src="presentacion/index/vendor/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<!--===============================================================================================-->
        <script src="presentacion/index/vendor/select2/select2.min.js" type="text/javascript"></script>
	<script>
		$(".selection-2").select2({
			minimumResultsForSearch: 20,
			dropdownParent: $('#dropDownSelect1')
		});
	</script>
<!--===============================================================================================-->
        <script src="presentacion/index/vendor/daterangepicker/moment.min.js" type="text/javascript"></script>
        <script src="presentacion/index/vendor/daterangepicker/daterangepicker.js" type="text/javascript"></script>
<!--===============================================================================================-->
        <script src="presentacion/index/vendor/countdowntime/countdowntime.js" type="text/javascript"></script>
<!--===============================================================================================-->
	
        <script src="presentacion/index/js/main.js" type="text/javascript"></script>
</body>
</html>
