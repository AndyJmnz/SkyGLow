<?php 

    

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

    require_once "../conexion.php";

    function enviar_correo($archivo){

        require '../Libreria/phpmailer/src/PHPMailer.php';
        require '../Libreria/phpmailer/src/SMTP.php';
        require '../Libreria/phpmailer/src/Exception.php';

        $mail = new PHPMailer(true);

        try {

            $nombre_usuario = $_SESSION['usuario_nombre'];
            $correo = $_SESSION['usuario_correo'];

            $mail->SMTPDebug = SMTP::DEBUG_SERVER;
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'skyglowteam@gmail.com';
            $mail->Password = 'yklp acfr plro slsn';
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
            $mail->Port = 465;
            
            $mail->setFrom('skyglowteam@gmail.com', 'SkyGlow');
            $mail->addAddress($correo); 


            $mail->isHTML(true);                                  
            $mail->Subject = 'Confirmacion de Compra - SkyGlow';
            $cuerpo = '<h4>Estimada/o cliente '.$nombre_usuario.'

            ¡Gracias por elegir SkyGlow para tus compras! 
            Este correo es para confirmar tu reciente compra.
            A continuación, encontrarás un resumen detallado de tu pedido:</<h4>';
            $mail->Body    = utf8_decode($cuerpo);

            // Adjunta el PDF al correo
            $pdfFilePath = 'Reporte.pdf'; // Ruta al archivo PDF que deseas adjuntar
            $mail->addAttachment($pdfFilePath);
            //$mail->addAttachment($pdfFile, 'Reporte.pdf');
            
            $mail->setLanguage('es','../Libreria/phpmailer/phpmailer.lang-es.php');

            $mail->send();

            // Elimina el archivo PDF después de enviar el correo
            //unlink($pdfFile);

        } catch (Exception $e) {
                echo "Error al enviar el correo electronico de la compra: {$mail->ErrorInfo}";
                exit;   
            }
    }
    
?>
