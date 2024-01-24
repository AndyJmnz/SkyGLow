<?php
    include("../conexion.php"); 
    session_start();
    $nombre_usuario=$_SESSION['usuario_nombre'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reportes</title>
    <style>
        * {
            font-family:'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif; 
            margin: auto;
        }

        header {
            text-align: center;
            margin-bottom: 20px;
        }

        #logo {
            max-width: 150px;
        }

        #user-info {
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }
        header{
            width: 100%;
        }
        body{
            display: flex;
            flex-flow: column;
        }
        ul{
            list-style-type: none;
            margin: 0;
            padding:  1em;
            width: auto;
            overflow: hidden;
            font-size:large;
            background-color: #84A98C;
            margin-bottom: .3em;
        }
        li{
            float: right;
        }
        li a{
            display: block;
            text-align: center;
            color: #eaeee8;
            padding: 1em 1em;
            text-decoration: none;
        }
        li a:hover{
            background-color: #eaeee8;
            color: #84A98C;
            border-radius: 5%;
        }
        #imgNav{
            width: 3em;
            height: 3em;
            margin-left: 3em;
        }
        #titulo{
            text-align: center;
            letter-spacing: .5em;
            color: #354F52;
            margin-bottom: 1em
        }

    </style>
</head>
<body>
    <div>
        <?php
            include("CrearPDF.php");

            if ($resultado->num_rows > 0) {
                $fila = $resultado->fetch_assoc();
            ?>
            <header>
            <img src="../img/tienda.png" id="logo">
                <h1 id= "titulo">Factura</h1>
            </header>
            
            <div id="user-info">
                <p><strong>Nombre del Cliente:</strong><?php echo $nombre_usuario; ?></p>
                <p><strong>Dirección:</strong> Calle 123, Ciudad</p>
                <p><strong>Email:</strong> juan@example.com</p>
            </div>

            <table>
                <thead>
                    <tr>
                        <th>Producto</th>
                        <th>Cantidad</th>
                        <th>Precio Unitario</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Producto 1</td>
                        <td>2</td>
                        <td>$10.00</td>
                        <td>$20.00</td>
                    </tr>
                    <tr>
                        <td>Producto 2</td>
                        <td>1</td>
                        <td>$15.00</td>
                        <td>$15.00</td>
                    </tr>
                    <!-- Agrega más filas según sea necesario -->
                </tbody>
            </table>
    </div>
        <?php
            }
        ?>
</body>
</html>
