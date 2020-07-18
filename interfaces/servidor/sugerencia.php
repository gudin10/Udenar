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
//{$sugerencia}
$mail->Body = "<meta charset='UTF-8' />
    <div class='contenedor'>
        <section>
            <header>
                <h1>Correcpciones de errores conexion sena.</h1>
            </header>
            <article>
                <div class='caja'>
                    <p>
                        <stronng>Aporte realizado por: </strong>{$email}
                        <stronng>Sugerencia: </strong>{$sugerencia}
                    </p>
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

	$mail->addAddress("conexionsenasoportetecnico@gmail.com");
	if ($mail->send())
		echo "Su mensaje fue enviado exitosamente";
	else
		echo "Verifique su conexion a internet y buelva a intentarlo";
	$mail->clearAddresses();
	$mail->clearAttachments();

 ?>
