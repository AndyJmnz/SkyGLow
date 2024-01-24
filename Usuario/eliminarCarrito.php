<?php

    session_start();
    include("../conexion.php");

    if (isset($_POST['eliminar']) && is_numeric($_POST['eliminar'])) {
        $productoEliminar = $_POST['eliminar'];
        $idUsuario = $_SESSION['usuario_id'];

        // Obtener la cantidad actual del producto en el carrito
        $cantidadQuery = "SELECT cantidad FROM carrito WHERE usuario_id = $idUsuario AND producto_id = $productoEliminar";
        $resultCantidad = $con->query($cantidadQuery);

        if ($resultCantidad && $resultCantidad->num_rows > 0) {
            $filaCantidad = $resultCantidad->fetch_assoc();
            $cantidadActual = $filaCantidad['cantidad'];

            if ($cantidadActual > 1) {
                // Si hay más de 1 unidad, restar 1 a la cantidad
                $actualizarCantidadQuery = "UPDATE carrito SET cantidad = cantidad - 1 WHERE usuario_id = $idUsuario AND producto_id = $productoEliminar";
                $con->query($actualizarCantidadQuery);
            } else {
                // Si hay 1 unidad o menos, eliminar el producto del carrito
                $eliminarProductoQuery = "DELETE FROM carrito WHERE usuario_id = $idUsuario AND producto_id = $productoEliminar";
                $con->query($eliminarProductoQuery);
            }

            // Puedes enviar una respuesta al cliente si lo necesitas
            echo "Éxito";
        } else {
            echo "Error al obtener la cantidad del producto";
        }
    } else {
        echo "Parámetros incorrectos";
    }

?>
