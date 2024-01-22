<?php
include("../conexion.php"); 
$id_usuario = $_SESSION['usuario_id'];

$query = mysqli_query($con, "SELECT * FROM carrito WHERE usuario_id = $id_usuario");

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

                $productos[] = $producto; 
                }
        }
} 
else {
    echo "El carrito está vacío";
}

$con->close(); 

return $productos;
?>
