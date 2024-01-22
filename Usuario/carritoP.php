<?php
    include("../conexion.php"); 
    session_start();

    if(isset($_POST['id_producto'])) {
        $id_producto = $_POST['id_producto'];
        $id_usuario = $_SESSION['usuario_id'];

        $query = mysqli_query($con, "SELECT * FROM carrito WHERE usuario_id = $id_usuario AND producto_id = $id_producto");

        if(mysqli_num_rows($query) > 0) {

            $update_query = mysqli_query($con, "UPDATE carrito SET cantidad = cantidad + 1 WHERE usuario_id = $id_usuario AND producto_id = $id_producto");
            
            if($update_query) {
                echo "Producto actualizado en el carrito";
            } else {
                echo "Error al actualizar el producto en el carrito";
            }
        } else {
            $insert_query = mysqli_query($con, "INSERT INTO carrito (usuario_id, producto_id, cantidad) VALUES ($id_usuario, $id_producto, 1)");
            
            if($insert_query) {
                echo "Producto agregado al carrito";
            } else {
                echo "Error al agregar el producto al carrito";
            }
        }
    } else {
        echo "ID de producto no proporcionado";
    }

    mysqli_close($con);

?>