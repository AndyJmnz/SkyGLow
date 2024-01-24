<?php

    include("../conexion.php"); 

    $sql = 'SELECT id_Producto, Nombre_Producto, Precio_Producto, Descripcion_Producto
            FROM productos';
    $resultado = $con->query($sql);

    ?>
    