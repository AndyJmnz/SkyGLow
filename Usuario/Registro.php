

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
    <link rel="stylesheet" href="../css/estilos.css">
    <link rel="stylesheet" href="../css/estilos_reg.css">
    <link rel="icon" href="../img/tienda.png" type="image/x-icon">


</head>
<header>
    <nav id="BarraIn">
        <ul>
            <img src="../img/tienda.png" alt="" id="imgNav">
            <li><a href="../index.php">Inicio</a></li>
            <li><a href="Productos.php">Productos</a></li>
            <li><a href="Registro.php">Registro</a></li>
            <li><a href="../Login.php">Login</a></li>
            <li><a href="#">Salir</a></li>
        </ul>
    </nav>
</header>
<body>
    <form action="registroUs.php" method = "post">
        <div id="contenedor">
            <div id="formulario">
                <div id="titulo">
                    <h1>REGISTRO</h1>
                </div>
                <label for="name">Nombre:</label>
                <input type="text" name="Nombre" id="Nombre" class="entradaReg">
                <br>
                <label for="name">Apellidos:</label>
                <input type="text" name="Apellidos" id="Apellidos" class="entradaReg">
                <br>
                <label for="name">Telefono:</label>
                <input type="text" name="Telefono" id="Telefono" class="entradaReg">
                <br>
                <label for="name">Edad:</label><br>
                <input type="text" name="Edad" id="Edad" class="entradaReg">
                <br>
                <label for="name">Domicilio:</label>
                <input type="text" name="Domicilio" id="Domicilio" class="entradaReg">
                <br>
                <label for="name">Codigo Postal:</label>
                <input type="text" name="CodigoPostal" id="CodigoPostal" class="entradaReg">
                <br>
                <label for="name">Correo:</label>
                <input type="email" name="Correo" id="Correo" class="entradaReg">
                <br>
                <label for="name">Contraseña:</label>
                <input type="password" name="password" id="Contraseña" class="entradaReg">

                <button id="BotonRegistro" >Registrar </button>

            </div>
        </div>
    </form>
    <br><br><br><br>
    <footer>
        <div id="divFoot">
            <p>Andrea Paola Jiménez Espinoza</p>
            <p>4°P</p>
            <p>Base de Datos</p>
            <p>Desarrollo Web</p>
        </div>
    </footer>
</body>
</html>

    