<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="css/estilos.css">
    <link rel="stylesheet" href="css/estilos_log.css">
    <link rel="icon" href="img/tienda.png" type="image/x-icon">

</head>
<header>
    <nav id="BarraIn">
        <ul>
            <img src="img/tienda.png" alt="" id="imgNav">
            <li><a href="index.php">Inicio</a></li>
            <li><a href="Usuario/Productos.php">Productos</a></li>
            <li><a href="Usuario/Registro.php">Registro</a></li>
            <li><a href="Login.php">Login</a></li>
            <li><a href="#">Salir</a></li>
        </ul>
    </nav>
</header>
<body>
    <form action="loginUs.php" method = "POST">
        <div id="contenedor">
            <div id="formulario">
                <div id="titulo">
                    <h1>LOGIN</h1>
                </div>
                <label for="name">Correo / Usuario:</label>
                <input type="text" name="us" id="Correo" class="entradaReg">
                <br>
                <label for="name">Contraseña:</label>
                <input type="password" name="password" id="Contraseña" class="entradaReg">

                <button id="BotonRegistro">Ingresar</button>
            </div>
        </div>
    </form>
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