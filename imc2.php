<?php

$NomServidor = "localhost";
$NomBD = "proyecto";
$Usuario = "root";
$contraseña = "";

// Variable para almacenar el mensaje de éxito
$mensaje = "";

// Conexión a la base de datos
$conn = mysqli_connect($NomServidor, $Usuario, $contraseña, $NomBD);

// Chequear la conexión
if (!$conn) {
    echo("Error de conexión: " . mysqli_connect_error());
} else {
    echo "Conexión exitosa:";
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'];
    $apellido_paterno = $_POST['apellido_paterno'];
    $apellido_materno = $_POST['apellido_materno'];
    $sexo = $_POST['sexo'];
    $edad = $_POST['edad'];
    $altura = $_POST['altura'];
    $peso = $_POST['peso'];

    // Insertar datos en la base de datos
    $sql_insert = "INSERT INTO `calculadora` (Nombre, Apellido_paterno, Apellido_materno, Edad, Sexo, Peso, Altura) VALUES ('$nombre', '$apellido_paterno', '$apellido_materno', '$edad', '$sexo', '$peso', '$altura')";
    
    // Ejecutar la consulta
    if (mysqli_query($conn, $sql_insert)) {
        $mensaje = "Datos de $nombre $apellido_paterno $apellido_materno insertados correctamente.";
    } else {
        $mensaje = "Error al insertar datos: " . mysqli_error($conn);
    }
}

// Cerrar conexión
mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <title>Resultado IMC</title>
</head>
<body style="text-align: center; background-image: url('https://unamglobal.unam.mx/wp-content/uploads/2017/04/obesidad-infantil.gif'); background-size: cover;">

<form method="post">
    <label for="nombre">Nombre:</label>
    <input type="text" id="nombre" name="nombre">
    <br>
    <label for="apellido_paterno">Apellido Paterno:</label>
    <input type="text" id="apellido_paterno" name="apellido_paterno">
    <br>
    <label for="apellido_materno">Apellido Materno:</label>
    <input type="text" id="apellido_materno" name="apellido_materno">
    <br>
    <label for="sexo">Sexo:</label>
    <select id="sexo" name="sexo">
        <option value="Hombre">Hombre</option>
        <option value="Mujer">Mujer</option>
    </select>
    <br>
    <label for="edad">Edad:</label>
    <input type="number" id="edad" name="edad">
    <br>
    <label for="altura">Altura (metros):</label>
    <input type="number" id="altura" name="altura">
    <br>
    <label for="peso">Peso (kilogramos):</label>
    <input type="number" id="peso" name="peso">
    <br>
    <input type="submit" value="Guardar datos">
</form>

<?php echo "<h3>$mensaje</h3>"; ?>

<p><a href="IMC.html">Regresar a la calculadora del IMC</a></p>

</body>
</html>
