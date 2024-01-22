<?php 
    session_start();
    include("../conexion.php"); 
    
    // Verificar si el usuario está autenticado
    if (isset($_SESSION['usuario_nombre'])) {
        $usuario_nombre = $_SESSION['usuario_nombre'];
    } else {
        // El usuario no está autenticado, redirige o muestra un mensaje de error
        header("Location: ../Login.php");
        exit;
    }

    // Incluir el archivo ImprimirPt.php
    include("ImprimirPt.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Productos</title>
    <link rel="stylesheet" href="../css/estilos.css">
    <link rel="stylesheet" href="../css/estilos_productos.css">
    <link rel="icon" href="../img/tienda.png" type="image/x-icon">


</head>
<header>
    <nav id="BarraIn">
        <ul>
            <img src="../img/tienda.png" alt="" id="imgNav">
            <li><a href="../index.php">Inicio</a></li>
            <li><a href="AdminProductos.php">Productos</a></li>
            <li><a href="../Usuario/Registro.php">Registro</a></li>
            <li><a href="../Login.php">Login</a></li>
            <li><a href="#">Salir</a></li>
        </ul>
    </nav>
</header>
<body>
    <h1>PRODUCTOS</h1>
    <div class="botones">
        <a class="Boton-Agregar-1" href="AgregarPts.php">Agregar</a>
        <a class="Boton-Modificar" href="ModificarPts.php">Modificar</a>
        <a class="Boton-Eliminar" href="EliminarPts.php">Eliminar</a>
    </div>
    
    <table>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Descripción</th>
            <th>Precio</th>
            <th>Stock</th>
        </tr>
        <?php
        if ($resultado->num_rows > 0) {
            while ($fila = $resultado->fetch_assoc()) {
                $id = $fila['id_Producto'];
                $imagen = "../img/$id/principal.jpg";
        ?>
                <tr>
                    <td><?php echo $id; ?></td>
                    <td><?php echo $fila['Nombre_Producto']; ?></td>
                    <td><?php echo $fila['Descripcion_Producto']; ?></td>
                    <td>$<?php echo number_format($fila['Precio_Producto'], 2, '.', ','); ?></td>
                    <td><?php echo $fila['StockProducto'];?></td>
                </tr>
        <?php
            }
        }
        ?>
    </table>
    <br><br><br><br><br><br>
</body>
<footer>
    <div id="divFoot">
        <p>Andrea Paola Jiménez Espinoza</p>
        <p>4°P</p>
        <p>Base de Datos</p>
        <p>Desarrollo Web</p>
    </div>
</footer>
</html>

