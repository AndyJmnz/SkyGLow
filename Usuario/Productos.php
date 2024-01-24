<?php 
    session_start();
    include("../conexion.php"); 
    
    if (isset($_SESSION['usuario_nombre'])) {
        $usuario_nombre = $_SESSION['usuario_nombre'];
        $id = $_SESSION['usuario_id'];
    } else {
        header("Location: Login.php");
        exit;
    }
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
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>


</head>
<header>
    <nav id="BarraIn">
        <ul>
            <img src="../img/tienda.png" alt="" id="imgNav">
            <li><a href="../index.php">Inicio</a></li>
            <li><a href="Productos.php">Productos</a></li>
            <li><a href="carrito.php">Carrito</a></li>
            <li><a href="Registro.php">Registro</a></li>
            <li><a href="../Login.php">Login</a></li>
            <li><a href="#">Salir</a></li>
        </ul>
    </nav>
</header>
<body>
    <h1>PRODUCTOS</h1>

    <div class="cards">
        <?php
            include("ImprimirPt.php");

            if ($resultado->num_rows > 0) {
                while ($fila = $resultado->fetch_assoc()) {
                    $id = $fila['id_Producto'];
                    $imagen = "../img/$id/principal.jpg";
            ?>
                    <div class="card">
                        <img class="imagen-prod" src="<?php echo $imagen; ?>" alt="Producto <?php echo $id; ?>">
                        <div class="titulo-prod"><?php echo $fila['Nombre_Producto']; ?></div>
                        <div class="descripcion-prod"><?php echo $fila['Descripcion_Producto']; ?></div>
                        <div class="precio-prod">$<?php echo number_format($fila['Precio_Producto'], 2, '.', ','); ?></div><br>
                        <button class="Boton-Agregar" onclick="agregarAlCarrito(<?php echo $id; ?>)">Agregar</button>

                        
                    </div>
        <?php
            }
        }
        ?>
    </div> 
</body>

</html>

<script>
    function agregarAlCarrito(idProducto) {
        $.ajax({
            type: 'POST',
            url: 'carritoP.php',
            data: { id_producto: idProducto },
            success: function(response) {
                alert('Producto agregado al carrito con éxito');
                window.location.href = 'carrito.php';
            },
            error: function(error) {
                alert('Error al intentar agregar el producto al carrito');
            }
        });
    }
</script>
