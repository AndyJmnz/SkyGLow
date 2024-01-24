<?php

    include("../conexion.php");    
    
    $nombre = $_POST ['Nombre'];
    $apellido = $_POST ['Apellidos'];
    $telefono = $_POST ['Telefono'];
    $edad = $_POST ['Edad'];
    $domicilio = $_POST ['Domicilio'];
    $cp = $_POST ['CodigoPostal'];
    $correo = $_POST ['Correo'];
    $password = $_POST ['password'];

    $sql = mysqli_query($con, "INSERT INTO usuario (id_usuario, nombre, apellido, telefono, edad, domicilio, cp, correo, password)
                               VALUES (0, '$nombre','$apellido','$telefono','$edad','$domicilio','$cp','$correo','$password')");

    /*$query = "  CREATE TRIGGER bitacora_usuario
                AFTER INSERT ON usuario
                FOR EACH ROW
                BEGIN
                INSERT INTO bitacora_usuario (Fecha, Sentencia, Contrasentencia)
                VALUES (NOW(), 
                    CONCAT('INSERT INTO usuario (nombre, apellido, telefono, edad, domicilio, cp, correo, password) VALUES 
                            (\'',NEW.nombre, '\', \'', NEW.apellido, '\', ', NEW.telefono, ', ', NEW.edad, ', \'', NEW.domicilio, '\', ',NEW.cp, ', \'', NEW.correo, '\', \'', NEW.password, '\');'), 
                    CONCAT('DELETE FROM usuario WHERE id_usuario = ', NEW.id_usuario, ';')
                );                                                                                                                                                                                                                                                                              
                    IF ROW_COUNT() = 0 THEN
                        SIGNAL SQLSTATE '45000'
                        SET MESSAGE_TEXT = 'Error: El trigger no insertó en bitacora_usuario';
                    END IF;
                END;
            ";

    $trigger = mysqli_query($con, $query);*/




    if ($sql ) {
        echo "<br>Usuario agregado";
        header('Location: ../Login.php');
    } else {
        echo "Error: " . mysqli_error($con);
    }
    mysqli_close($con);
?>