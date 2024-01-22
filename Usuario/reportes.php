<?php   
    include("../conexion.php");
    session_start();
    $nombre_usuario = $_SESSION['usuario_nombre'];
    $correo = $_SESSION['usuario_correo'];

    if (isset($_POST['enviarInfoProductos'])) {
        // Obtener información de productos del carrito (ajusta según tu estructura de datos)
        $idUsuario = $_SESSION['usuario_id'];
        $query = mysqli_query($con, "SELECT * FROM carrito WHERE usuario_id = $idUsuario");

        $productos = array(); 

        if ($query && mysqli_num_rows($query) > 0) {
            while ($fila = $query->fetch_assoc()) {
                $id_prod = $fila['producto_id'];
                $cantidad = $fila['cantidad']; 

                $sql = "SELECT id_Producto, Nombre_Producto, Precio_Producto, Descripcion_Producto
                        FROM productos WHERE id_Producto = $id_prod";

                $resultadoProducto = $con->query($sql);

                if ($resultadoProducto && $resultadoProducto->num_rows > 0) {
                    $producto = $resultadoProducto->fetch_assoc();

                    $producto['cantidad'] = $cantidad;
                     // Calcular el total del precio del producto por la cantidad
                    $totalProducto = $producto['Precio_Producto'] * $cantidad;
                    $producto['total'] = $totalProducto;
                    $productos[] = $producto; 
                }
            }
            $resultado = $query;
        } 
    }

    ob_start(); // todo a partir de aquí se mostrará
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reportes</title>
    <style>
        * {
            font-family:'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif; 
            margin: auto;
        }

        header {
            text-align: center;
            margin-bottom: 20px;
        }

        #logo {
            max-width: 150px;
        }

        #user-info {
            margin-bottom: 20px;
            margin-left:30px;
        }

        table {
            width: 90%;
            border-collapse: collapse;
            margin-top: 20px;
            margin-left:30px;
            margin-right:30px;
        }

        th, td {
            border: 1px solid #ddd   ;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }
        header{
            width: 100%;
        }
        body{
            display: flex;
            flex-flow: column;
            margin : 20px;
            padding: 15px;
            background-color: #C2E1C9;
        }
        h1{
            text-align: center;
            letter-spacing: .5em;
            color:#FF8C00;
            margin-bottom: 1em
        }
        h2{
            margin-left:2em;
            text-align: left;
            letter-spacing:.2em;
            color: #374E3C;
            margin-bottom: 1em;
        }
        #tablaDatos {
            width: 40%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        .ths, .tds {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        .ths {
            background-color: #f2f2f2;
        }

        #user-info {
            margin-bottom: 20px;
            text-align: right;

        }

    </style>
</head>
<body>
<div>
    <header>
    <h1>------SkyGlow------</h1>
    <h2 id= "titulo">FACTURA</h2>
    </header>
            
    <div id="user-info">
        <table id = "tablaDatos">
            <tr>
                <th class="ths">Nombre del Cliente</th>
                <td class="tds"><?php echo $nombre_usuario; ?></td>
            </tr>
            <tr>
                <th class="ths">Email</th>
                <td class="tds"><?php echo $correo; ?></td>
            </tr>
        </table>
    </div>
    <hr>
    <?php
    include("CrearPDF.php");

    if (!empty($productos)) {
    ?>
        <table>
            <thead>
                <tr>
                    <th>Producto</th>
                    <th>Cantidad</th>
                    <th>Precio Unitario</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($productos as $producto) {
                    $id = $producto['id_Producto'];
                    ?>
                    <tr>
                        <td><?php echo $producto['Nombre_Producto']; ?></td>
                        <td><?php echo $producto['cantidad']; ?></td>
                        <td>$<?php echo number_format($producto['Precio_Producto'], 2, '.', ','); ?></td>
                        <td>$<?php echo number_format($producto['total'], 2, '.', ','); ?></td>
                    </tr>
                    <?php
                }
                ?>
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="3" style="text-align: right;"><strong>Total</strong></td>
                    <?php
                    // Calcular el total de toda la compra
                    $totalCompra = array_sum(array_column($productos, 'total'));?>
                    <td>$<?php echo number_format($totalCompra, 2, '.', ','); ?></td>
                </tr>
            </tfoot>
        </table>
        <?php
        } else {
            echo "No hay productos en el carrito.";
        }
        ?>
    </div>
</body>
</html>

<?php
    $html = ob_get_clean();

    require_once '../Libreria/dompdf/autoload.inc.php';
    use Dompdf\Dompdf;   

    if ($html === false) {
        die("Error al obtener el contenido de la página");
    }

    $dompdf = new Dompdf(); 
    $options = $dompdf->getOptions();
    $options->set(array('isHtml5ParserEnabled' => true));
    $dompdf->setOptions($options);

    $dompdf->load_html(utf8_decode($html));

    $dompdf->set_paper('letter');

    $dompdf->render();

    //Para adjuntar el correo
    $pdfOutput = $dompdf->output();
    
    $pdfFile = 'Reporte.pdf';
    file_put_contents($pdfFile, $pdfOutput);


    $dompdf->stream("Reporte.pdf", array("Attachment"=>false));
?>

<?php
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;
    
    require '/Libreria/phpmailer/src/PHPMailer.php';
    require '/Libreria/phpmailer/src/SMTP.php';
    require '/Libreria/phpmailer/src/Exception.php';
    
    $mail = new PHPMailer(true);
    
    try {
    
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
    //$mail->addAddress('ivannoeramirezvivanco@gmail.com', 'Ivan Ramirez');
    
    $mail->isHTML(true);
    $mail->Subject = 'Detalles de su compra';
    $cuerpo = '<h4>Gracias por su compra: '.$nombre_usuario.'</<h4>';
    $mail->Body = utf8_decode($cuerpo);
    
    // Adjunta el PDF al correo
    $mail->addAttachment($pdfFile, 'Reporte.pdf');
    
    $mail->setLanguage('es','/Libreria/phpmailer.lang-es.php');
    
    //Para que no muestre un chorro de texto sobre SMTP
    $mail->SMTPDebug = SMTP::DEBUG_OFF;

    $mail->send();
    
    // Elimina el archivo PDF después de enviar el correo
    unlink($pdfFile);

    /*redirige al archivo anterior
    header("Location: productos.php");
    exit;
    */
    } catch (Exception $e) {
        echo "Error al enviar el correo electrónico de la compra: {$mail->ErrorInfo}";
        exit;
    }
?>
