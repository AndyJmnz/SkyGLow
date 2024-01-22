<?php

    include("../conexion.php"); 

    $sql = 'SELECT * FROM bitacora_producto';
    $resultado = $con->query($sql);

?>