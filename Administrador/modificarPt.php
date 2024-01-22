<?php
        include("../conexion.php");    
     
        if(isset($_POST["submit"])){
                $id_Producto = $_POST['id_producto'];
                $nuevo_nombre = $_POST ['Nombre_Producto'];
                $nueva_descripcion = $_POST ['Descripcion_Producto'];
                $nuevo_precio = $_POST ['Precio_Producto'];
                $nuevo_stock = $_POST ['Stock_Producto'];

                $query =  mysqli_query($con, "UPDATE productos SET 
                                                    Nombre_producto = '$nuevo_nombre',
                                                    Precio_producto = $nuevo_precio,
                                                    Descripcion_producto = '$nueva_descripcion',
                                                    StockProducto = $nuevo_stock
                                                WHERE productos.id_producto = $id_Producto;");

                /*$tri = "      CREATE TRIGGER after_update 
                                AFTER UPDATE ON productos 
                                FOR EACH ROW 
                                BEGIN 
                                INSERT INTO bitacora_producto (Fecha, Sentencia, Contrasentencia) 
                                VALUES (NOW(), 
                                CONCAT('UPDATE productos SET Nombre_producto = \'', NEW.Nombre_producto, '\', Precio_producto = ', NEW.Precio_producto, ', Descripcion_producto = \'', NEW.Descripcion_producto, '\', StockProducto = ', NEW.Stockproducto, ' WHERE productos.id_producto = ', NEW.id_producto, ';'), 
                                CONCAT('DELETE FROM productos WHERE id_Producto = ', NEW.id_producto) ); 
                                IF ROW_COUNT() = 0 THEN 
                                        SIGNAL SQLSTATE '45000' 
                                        SET MESSAGE_TEXT = 'Error: El trigger no insertó en bitacora_producto'; 
                                END IF; END; "; 
                                
                $trigger = mysqli_query($con, $tri); 
                if ($trigger) { 
                    echo "El trigger se creó correctamente."; 
                } else { 
                    echo "Error al crear el trigger: " . mysqli_error($con); 
                }*/

                if($query){
                        header('Location: MostrarBitacora.php');
                }else{

                echo "Ha fallado la subida, reintente nuevamente.";
                } 
            }
                 
        
?>