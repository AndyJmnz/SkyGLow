<?php 
    session_start();
    include("../conexion.php"); 

    // Incluir el archivo ImprimirPt.php
    include("mostrarbt.php");
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
            <li><a href="Registro.php">Registro</a></li>
            <li><a href="../Login.php">Login</a></li>
            <li><a href="#">Salir</a></li>
        </ul>
    </nav>
</header>
<body>
    <h1>BITACORA</h1>
    <table>
        <tr>
            <th>ID</th>
            <th>Fecha</th>
            <th>Sentencia</th>
            <th>Contrasentencia</th>
        </tr>
        <?php
        if ($resultado->num_rows > 0) {
            while ($fila = $resultado->fetch_assoc()) {
                $id = $fila['id'];
        ?>
                <tr>
                    <td><?php echo $id; ?></td>
                    <td><?php echo $fila['Fecha']; ?></td>
                    <td><?php echo $fila['Sentencia']; ?></td>
                    <td><?php echo $fila['Contrasentencia'];?></td>
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
