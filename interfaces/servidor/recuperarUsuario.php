<?php

require_once '../../phpmailer/PHPMailerAutoload.php';
include_once dirname(__FILE__) . '/../../clasesGenericas/ConectorBD.php';

$email = $_POST['email'];
$sugerencia = $_POST['body'];

$mail = new PHPMailer();
$mail->isSMTP();
$mail->Host = "smtp.gmail.com";
$mail->SMTPSecure = "ssl";
$mail->Port = 465;
$mail->SMTPAuth = true;
$mail->Username = 'conexionsenasoportetecnico@gmail.com';
$mail->Password = 'Soporteconexionsena';

$mail->setFrom('conexionsenasoportetecnico@gmail.com', 'Conexionsena.com');
$mail->IsHTML(true);
$mail->Subject = "Correccion de errores";
$mail->CharSet= 'UTF-8';

$mail->Body = "
	<meta charset='UTF-8' />
	<div class='mensaje' style='background: red; width: 500px; margin: auto; text-align: center;' >
	<div  style='background: blue'>Encanezado</div>
	<div class='contenido'>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
	tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
	quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
	<br>{$sugerencia}<br>
	consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
	cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
	proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</div>
	<div class='footer' style='background: blue'>Footer</div>
</div>";

	$mail->addAddress($email);
	if ($mail->send())
		echo "Su mensaje fue enviado exitosamente";
	else
		echo "Verifique su conexion a internet y buelva a intentarlo";
	$mail->clearAddresses();
	$mail->clearAttachments();

 ?>
