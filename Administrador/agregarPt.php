<?php
        include("../conexion.php");    
     
        if(isset($_POST["submit"])){
                $Nombre_Producto = $_POST ['Nombre_Producto'];
                $Descripcion_Producto = $_POST ['Descripcion_Producto'];
                $Precio_Producto = $_POST ['Precio_Producto'];
                $Stock_Producto = $_POST ['Stock_Producto'];

                $query =  mysqli_query($con, "INSERT INTO productos (id_Producto,Nombre_Producto,Precio_Producto,Descripcion_Producto,StockProducto)
                                            VALUES (0,'$Nombre_Producto','$Precio_Producto','$Descripcion_Producto','$Stock_Producto')");

                /*$tri = "      CREATE TRIGGER after_insert 
                                AFTER INSERT ON productos 
                                FOR EACH ROW 
                                BEGIN 
                                INSERT INTO bitacora_producto (Fecha, Sentencia, Contrasentencia) 
                                VALUES (NOW(), 
                                CONCAT('INSERT INTO productos (Nombre_producto, Precio_producto, Descripcion_producto, Stockproducto) VALUES (\'', NEW.Nombre_producto, '\', ', NEW.Precio_producto, ',\'', NEW.Descripcion_producto, '\',', NEW.Stockproducto, ');'), 
                                CONCAT('DELETE FROM productos WHERE id_Producto = ', NEW.id_producto) ); 
                                IF ROW_COUNT() = 0 THEN 
                                        SIGNAL SQLSTATE '45000' 
                                        SET MESSAGE_TEXT = 'Error: El trigger no insertó en bitacora_producto'; 
                                END IF; END; "; 
                                
                $trigger = mysqli_query($con, $tri); if ($trigger) { echo "El trigger se creó correctamente."; } else { echo "Error al crear el trigger: " . mysqli_error($con); }*/

                if($query ){
                        header('Location: MostrarBitacora.php');
                }else{

                echo "Ha fallado la subida, reintente nuevamente.";
                } 
                 
            }
?>