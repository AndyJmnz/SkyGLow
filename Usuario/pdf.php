<?php
    require_once "../conexion.php";
    require_once "../Libreria/fpdf/fpdf.php";

    session_start();
    $nombre_usuario = $_SESSION['usuario_nombre'];
    $correo = $_SESSION['usuario_correo'];
    $idUsuario = $_SESSION['usuario_id'];
    $Totalote = $_SESSION['total_compra'];

    $data = array(); // Inicializamos $data como un array vacío

    if (isset($_POST['enviarInfoProductos'])) {       
            // Obtener información de productos del carrito (ajusta según tu estructura de datos)
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

            $sql = mysqli_query($con, "SELECT * FROM usuario WHERE id_usuario = $idUsuario");

            if ($sql) {
                if ($data = mysqli_fetch_assoc($sql)) {
                    echo '<script>';
                    echo 'console.log(' . json_encode($data) . ');';
                    echo '</script>';

                } else {
                    echo "No se obtuvieron datos del usuario.";
                }
            } else {
                echo "Error en la consulta SQL: " . mysqli_error($con);
            }
        }
    ob_start();   //a partir de aqui se muestra en el pdf 
?>
<?php
    class PDF extends FPDF {
        function Header() {
            //$this->Image('/Libreria/fpdf/logo.png', 270, 5, 20);
            $this->SetFont('Arial', 'B', 20); //tipo fuente, negrita(B-I-U-BIU), tamañoTexto
            $this->Cell(10); // Movernos a la derecha
            $this->SetTextColor(132, 169, 140); //color
            $this->SetFont('Arial', 'B', 24);
            $this->Cell(175, 15, 'SkyGlow', 0, 1, 'C');
            $this->Ln(10);

        }

        function Footer() {
            $this->SetY(-25);
            $this->SetFont('Arial', 'I', 10);
            $this->Cell(0, 10, 'SkyGlow agradece tu preferencia', 0, 1, 'C');
            $this->SetFont('Arial', 'I', 10); //tipo fuente, negrita(B-I-U-BIU), tamañoTexto

            $this->SetFont('Arial', 'I',10); 
            $hoy = date('d/m/Y');
            $this->Cell(540, 10, utf8_decode($hoy), 0, 0, 'R');
        }
    }

        
    $pdf = new PDF();
    $pdf->AddPage();
    $pdf->AliasNbPages();

    $pdf->SetFont('Arial', 'B', 14);

    $pdf->Ln(7);
    $pdf->Cell(0, 10, 'Datos del Cliente', 0, 1, 'L');
    $pdf->Ln(3);
    $pdf->SetFont('Arial', '', 12);
    $pdf->Cell(0, 8, 'Nombre: ' . $data['nombre'], 0, 1, 'L');
    $pdf->Cell(0, 8, 'Apellido: ' . $data['apellido'], 0, 1, 'L');
    $pdf->Cell(0, 8, 'Telefono: ' . $data['telefono'], 0, 1, 'L');
    $pdf->Cell(0, 8, 'Domicilio: ' . $data['domicilio'], 0, 1, 'L');
    $pdf->Cell(0, 8, 'Codigo Postal: ' . $data['cp'], 0, 1, 'L');
    $pdf->Cell(0, 8, 'Correo: ' . $data['correo'], 0, 1, 'L');

    $pdf->Ln(7);

    $pdf->SetFont('Arial', 'B', 14);
    $pdf->Cell(110, 10, 'Tu Compra', 0, 1, 'L');

    $pdf->Ln(7);

    $pdf->SetFillColor(132, 169, 140); //colorFondo
    $pdf->SetDrawColor(0, 0, 0); //colorBorde
    $pdf->SetFont('Arial', '', 12);
    $pdf->Cell(75, 10, utf8_decode('Producto'), 1, 0, 'C', 1);
    $pdf->Cell(21, 10, utf8_decode('Cantidad'), 1, 0, 'C', 1);
    $pdf->Cell(47, 10, utf8_decode('Precio Unitario'), 1, 0, 'C', 1);
    $pdf->Cell(47, 10, utf8_decode('Subtotal'), 1, 1, 'C', 1);


    foreach ($productos as $producto) {
        $pdf->SetFillColor(255, 255, 255); //colorFondo
        $pdf->SetTextColor(0, 0, 0); //colorTexto
        $pdf->SetDrawColor(0, 0, 0); //colorBorde
        $pdf->SetFont('Arial', '', 12);

        $nombre = $producto['Nombre_Producto'];
        $cantidad = $producto['cantidad'];
        $PP = $producto['Precio_Producto'];
        $total = $producto['total'];

        $pdf->Cell(75, 10, ''.$nombre, 1, 0, 'C', 1);
        $pdf->Cell(21, 10, ''.$cantidad, 1, 0, 'C', 1);
        $pdf->Cell(47, 10, '$' .$PP, 1, 0, 'C', 1);
        $pdf->Cell(47, 10, '$' .$total, 1, 0, 'C', 1);
        
        $pdf->Ln(10);
    }


    $pdf->Ln(10);
    $pdf->SetFillColor(132, 169, 140); //colorFondo
    $pdf->SetTextColor(0, 0, 0); //colorTexto
    $pdf->SetDrawColor(0, 0, 0); //colorBorde
    $pdf->Cell(0, 10, 'Resumen de tu compra', 1, 1, 'C', 1);
    $pdf->Cell(0, 10, '$' . $Totalote , 1, 1, 'C');

    $timestamp = time();
    $pdfName = 'Reporte_'.$idUsuario.'_'.$timestamp.'.pdf';
    $pdf->Output($pdfName, 'F');

    // Enviar correo
    require_once 'enviarcorreo.php';

    $webdavUrl = 'http://10.0.0.6/';
    $credentials = 'andy:1234';

    $command = "curl --upload-file $pdfName -u $credentials $webdavUrl";
    exec($command, $output, $exitcode);

    if ($exitCode === 0){
    	if (DEBUG) echo "PDF enviado correctamente./n";
    }else{
    	if (DEBUG) echo "Error al enviar el codigo.$exitCode";
    	if (DEBUG) print_r($output);
    }

    try {
        enviar_correo('Reporte.pdf', $data['correo']);
        header('Location: Productos.php');
    } catch (Exception $e) {
        echo "Error al enviar el correo electrónico de la compra: {$e->getMessage()}";
    }
?>
