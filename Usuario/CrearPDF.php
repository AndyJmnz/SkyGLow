<?php

    include("../conexion.php"); 

    $sql = 'SELECT id_usuario, nombre, apellido FROM usuario';
    $resultado = $con->query($sql);

    ?>