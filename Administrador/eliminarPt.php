<?php
include("../conexion.php");

if (isset($_POST["submit"])) {
    $id_Producto = $_POST['id_producto'];

    $query =  mysqli_query($con, "DELETE FROM productos WHERE productos.id_producto = $id_Producto");

    /*$tri = <<<SQL
    CREATE TRIGGER after_delete
    AFTER DELETE ON productos
    FOR EACH ROW
    BEGIN
        INSERT INTO bitacora_producto (Fecha, Sentencia, Contrasentencia)
        VALUES (
            NOW(),
            CONCAT('DELETE FROM productos WHERE id_Producto = ', OLD.id_producto),
            CONCAT('INSERT INTO productos (Nombre_producto, Precio_producto, Descripcion_producto, Stockproducto) VALUES (\'',OLD.Nombre_producto,'\', ',OLD.Precio_producto,',\'',OLD.Descripcion_producto,'\',',OLD.Stockproducto,')')
        );

        IF ROW_COUNT() = 0 THEN
            SIGNAL SQLSTATE '45000'
            SET MESSAGE_TEXT = 'Error: El trigger no insertó en bitacora_producto';
        END IF;
    END
SQL;

    $trigger = mysqli_query($con, $tri);

    if ($trigger) {
        echo "El trigger se creó correctamente.";
    } else {
        echo "Error al crear el trigger: " . mysqli_error($con);
    }*/

    if ($query ) {
        header('Location: MostrarBitacora.php');
    } else {
        echo "Ha fallado la subida, reintente nuevamente.";
    }
}
?>
