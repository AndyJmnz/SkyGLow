<?php 
    session_start();
    include("../conexion.php"); 
    include("MostrarCarrito.php");
    
    if (isset($_SESSION['usuario_nombre'])) {
        $usuario_nombre = $_SESSION['usuario_nombre'];
        $id = $_SESSION['usuario_id'];
    } else {
        header("Location: Login.php");
        exit;
    }
    
    //Se calcula el total
    $total = 0;

    foreach ($productos as $producto) {
        $precioProducto = $producto['Precio_Producto'];
        $cantidad = $producto['cantidad'];
        $total += $precioProducto * $cantidad;
    }
    $_SESSION['total_compra'] = $total;

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrito</title>
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
    <h1>TU CARRITO</h1>

    <div class="cards">
    <?php
    if (!empty($productos)) {
        foreach ($productos as $producto) {
            $id = $producto['id_Producto'];
            $imagen = "../img/$id/principal.jpg";
    ?>
            <div class="card">
                <img class="imagen-prod" src="<?php echo $imagen; ?>" alt="Producto <?php echo $id; ?>">
                <div class="titulo-prod"><?php echo $producto['Nombre_Producto']; ?></div>
                <div class="descripcion-prod"><?php echo $producto['Descripcion_Producto']; ?></div>
                <div class="precio-prod">$<?php echo number_format($producto['Precio_Producto'], 2, '.', ','); ?></div><br>
                <div class="cantidad">Cantidad: <?php echo $producto['cantidad']; ?></div>
                <a class="Boton-eliminarcarrito" onclick="eliminarProducto(<?php echo $producto['id_Producto']; ?>)">Eliminar</a>
            </div>
    <?php
        }
    } else {
    ?>
        <script>
            alert("El carrito está vacío");
        </script>
    <?php
    }
    ?>
</div>
<div id="Total">
    <p>Total: $<?php echo number_format($total, 2, '.', ','); ?></p>
    <button onclick="comprar()" class="Boton-Comprar">Comprar</button>
</div>


</body>
<br><br><br><br><br>
<footer>
    <div id="divFoot">
        <p>Andrea Paola Jiménez Espinoza</p>
        <p>4°P</p>
        <p>Base de Datos</p>
        <p>Desarrollo Web</p>
    </div>
</footer>
</html>

<script>
function eliminarProducto(idProducto) {
    $.ajax({
        type: 'POST',
        url: 'eliminarCarrito.php', 
        data: { eliminar: idProducto },
        success: function(response) {
            alert('Producto eliminado del carrito con éxito');
            location.reload();
        },
        error: function(error) {
            alert('Error al intentar eliminar el producto del carrito');
        }
    });
}
function comprar() {
    // Realizar la solicitud AJAX para enviar información de productos a reportes.php
    $.ajax({
        type: 'POST',
        url: 'pdf.php',
        data: { enviarInfoProductos: true },
        success: function(response) {
            // Si la solicitud tiene éxito, realizar la compra
            realizarCompra();
        },
        error: function(error) {
            alert('Error al enviar información de productos a reportes.php');
        }
    });
}
function realizarCompra() {
    // Realizar la solicitud AJAX para realizar la compra
    $.ajax({
        type: 'POST',
        url: 'comprar.php',
        data: { comprar: true, total: <?php echo $total; ?> },
        success: function(response) {
            if (response === 'okey') {
                alert('Error al intentar realizar la compra');
            } else {
                alert('Compra realizada con éxito');
                // Redirigir a productos.php
                window.location.href = 'productos.php';
            }
        },
        
        error: function(jqXHR, textStatus, errorThrown) {
            console.error('Error al intentar realizar la compra:', textStatus, errorThrown);
        }
    });
}
</script>