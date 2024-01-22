<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Productos</title>
    <link rel="stylesheet" href="../css/estilos.css">
    <link rel="stylesheet" href="../css/estilos_Agregar.css">
    <link rel="icon" href="../img/tienda.png" type="image/x-icon">

</head>
<header>
    <nav id="BarraIn">
        <ul>
            <img src="../img/tienda.png" alt="" id="imgNav">
            <li><a href="../index.php">Inicio</a></li>
            <li><a href="AdminProductos.php">Productos</a></li>
            <li><a href="../Usuario/Registro.php">Registro</a></li>
            <li><a href="../Login.php">Login</a></li>
            <li><a href="#">Salir</a></li>
        </ul>
    </nav>
</header>
<body>
<form action="agregarPt.php" method = "POST"  enctype="multipart/form-data">
        <div id="contenedor">
            <div id="formulario">
                <div id="titulo">
                    <h1>Agregar Productos</h1>
                </div>
                <label for="name">Nombre Producto:</label>
                <input type="text" name="Nombre_Producto" id="Nombre_Producto" class="entradaReg">
                <br>
                <label for="name">Precio:</label>
                <input type="text" name="Precio_Producto" id="Precio_Producto" class="entradaReg">
                <br>
                <label for="name">Descripcion:</label>
                <input type="text" name="Descripcion_Producto" id="Descripcion_Producto" class="entradaReg">
                <br>
                <label for="name">Stock:</label>
                <input type="text" name="Stock_Producto" id="Stock_Producto" class="entradaReg">
                <!--<br>
                <label for="name">Imagen:</label><br>
                <input type="file" name="image" id="image" class="entradaReg">-->
                <br>
                <button id="BotonRegistro" name="submit">Registrar </button>         
            </div>
        </div>
    </form>
</body>
<footer>
    <div id="divFoot">
        <p>Andrea Paola Jiménez Espinoza</p>
        <p>4°P</p>
        <p>Base de Datos</p>
        <p>Desarrollo Web</p>
    </div>
</footer>
</html>