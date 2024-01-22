<?php

    include("conexion.php");    
    
    $usuario = $_POST ['us'];
    $password = $_POST ['password'];

    $sql = mysqli_query($con, "SELECT * FROM usuario WHERE correo = '$usuario' AND password = '$password'");
    $sql2 = mysqli_query($con, "SELECT * FROM administrador WHERE usuario = '$usuario' AND password  = '$password'");
    
    if($sql && mysqli_num_rows($sql) > 0){
        session_start();

        $fila = $sql->fetch_assoc();
        $nomUser = $fila['nombre'];
        $id_user = $fila['id_usuario'];
        

        $_SESSION['usuario_tipo'] = 'Normal';
        $_SESSION['usuario_correo'] = $usuario;
        $_SESSION['usuario_nombre'] = $nomUser;
        $_SESSION['usuario_id'] = $id_user;

        header('Location: Usuario/Productos.php');
    }
    else if ($sql2 && mysqli_num_rows($sql2) > 0){
        session_start();

        $_SESSION['usuario_tipo'] = 'Admin';
        $_SESSION['usuario_correo'] = $usuario;

        header('Location: Administrador/AdminProductos.php');
    }
    else{
        die("<br>Datos Incorrectos " . mysqli_error($con));
    }

   
    
?>