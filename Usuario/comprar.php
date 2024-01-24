<?php
    session_start();
    include("../conexion.php");

    if (isset($_POST['comprar'])) {
        $idUsuario = $_SESSION['usuario_id'];
        $totalCompra = $_SESSION['total_compra']; 

        $insertarCompraQuery = "INSERT INTO compra (usuario_id, total) VALUES ($idUsuario, $totalCompra)";
        
        if ($con->query($insertarCompraQuery)) {

            $eliminarProductosQuery = "DELETE FROM carrito WHERE usuario_id = $idUsuario";
            $res = $con->query($eliminarProductosQuery);

            if ($res) {
                echo "okey";
            } else {
                echo "Error al eliminar productos del carrito";
            }
        } else {
            echo "Error al realizar la compra";
        }
    }
?>

