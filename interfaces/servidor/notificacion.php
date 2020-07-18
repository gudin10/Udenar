<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require_once '../../phpmailer/PHPMailerAutoload.php';
include_once dirname(__FILE__) . '/../../clasesGenericas/ConectorBD.php';

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
$mail->Subject = "Invitacion a participar en esta encuesta de Conexion Sena";
$mail->CharSet= 'UTF-8';
$mail->Body = "<meta charset='UTF-8' />
    <div class='contenedor'>
        <section>
            <header>
                <h1>Conexión sena.</h1>
            </header>
            <article>
                <div class='caja'>
                    <p>
                        {$_POST['mensaje']}
                    </p>
		<br>
			<p>Gracias.</p>
               </div>
            </article>
            <footer>
                Este correo es únicamente informativo y es de uso exclusivo del destinatario(a), puede contener información privilegiada 
y/o confidencial. Si no es usted el destinatario(a) deberá borrarlo inmediatamente. Queda notificado que el mal uso, 
divulgación no autorizada, alteración y/o  modificación malintencionada sobre este mensaje y sus anexos quedan 
estrictamente prohibidos y pueden ser legalmente sancionados. 
-ConexionSena  no asume ninguna responsabilidad por estas circunstancias.
            </footer>
        </section>
        <footer>
            <h3>Conexion sena ©</h3>
        </footer>
    </div>";

$cadenaSQL = "";

switch($_POST['tipo']){
        
    case "ficha":
        
        if($_POST['valor'] == 'todoFicha'){
            $cadenaSQL = "select email from egresado, fichaProgramaDeFormacion , programaDeFormacion where numeroFicha = numero and idProgramaDeFormacion = id and id = {$_POST['idPrograma']}";
        }else{
            $cadenaSQL = "select email from egresado, fichaProgramaDeFormacion where egresado.numeroFicha = fichaProgramaDeFormacion.numero and fichaProgramaDeFormacion.numero = {$_POST['valor']}";
        }
        
    break;
    case "programa":
        
        if($_POST['valor'] == 'todoPrograma'){
            $cadenaSQL = "select email from egresado, fichaProgramaDeFormacion , centroDeFormacion  where numeroFicha = numero and idCentroDeFormacion = id and id = {$_POST['idCentro']}";
        }else{
            $cadenaSQL = "select email from egresado, fichaProgramaDeFormacion , programaDeFormacion where numeroFicha = numero and idProgramaDeFormacion = id and id = {$_POST['valor']}";
        }
        
    break;
    case "centro":
        
        if($_POST['valor'] == 'todoCentro'){
            $cadenaSQL = "select email from egresado";
        }else{
            $cadenaSQL = "select email from egresado, fichaProgramaDeFormacion , centroDeFormacion  where numeroFicha = numero and idCentroDeFormacion = id and id = {$_POST['valor']}";
        }
        
    break;
        
}

$datos = ConectorBD::ejecutarQuery($cadenaSQL, null);

for ($i = 0; $i < count($datos); $i++) {

	$mail->addAddress($datos[$i][0]);
	$mail->send();
	$mail->clearAddresses();
	$mail->clearAttachments();
        
}
echo  $_POST['mensaje'];
?>






