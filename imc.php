<?php

$NomServidor = "localhost";
$NomBD = "proyectoimc";
$Usuario = "root";
$contraseña = "";

$mensaje = "";

$conn = mysqli_connect($NomServidor, $Usuario, $contraseña, $NomBD);

if (!$conn) {
    die("Error de conexión: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'];
    $apellido_paterno = $_POST['apellido_paterno'];
    $apellido_materno = $_POST['apellido_materno'];
    $sexo = $_POST['sexo'];
    $edad = $_POST['edad'];
    $altura = $_POST['altura'];
    $peso = $_POST['peso'];

    // Print all POST data to check if all fields are received
    print_r($_POST);

    $sql_insert = "INSERT INTO `calculadora` (Nombre, Apellido_paterno, Apellido_materno, Edad, Sexo, Peso, Altura) 
                   VALUES ('$nombre', '$apellido_paterno', '$apellido_materno', '$edad', '$sexo', '$peso', '$altura')";
    
    if (mysqli_query($conn, $sql_insert)) {
        $mensaje = "Datos de $nombre $apellido_paterno $apellido_materno insertados correctamente.";

        $imc = $peso / ($altura * $altura);
        $mensaje .= "<br>Su Índice de Masa Corporal (IMC) es: " . number_format($imc, 2);

        if ($imc < 18.5) {
            $mensaje .= "<br>Estado del IMC: Bajo peso";
        } elseif ($imc >= 18.5 && $imc < 25) {
            $mensaje .= "<br>Estado del IMC: Normal";
        } elseif ($imc >= 25 && $imc < 30) {
            $mensaje .= "<br>Estado del IMC: Sobrepeso";
        } else {
            $mensaje .= "<br>Estado del IMC: Obesidad";
        }

    } else {
        $mensaje = "Error al insertar datos: " . mysqli_error($conn);
    }
}

echo "<h1>Datos ingresados</h1>";
echo "<h3>";
echo "- Nombre: " . $_POST['nombre'] . "<br>";
echo "- Apellido Paterno: " . $_POST['apellido_paterno'] . "<br>";
echo "- Apellido Materno: " . $_POST['apellido_materno'] . "<br>";
echo "- Sexo: " . $_POST['sexo'] . "<br>";
echo "- Edad: " . $_POST['edad'] . "<br>";
echo "- Altura: " . $_POST['altura'] . "<br>";
echo "- Peso: " . $_POST['peso'] . "<br>";
echo "</h3>";

mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <title>Resultado IMC</title>
</head>
<body style="text-align: center; background-image: url('https://unamglobal.unam.mx/wp-content/uploads/2017/04/obesidad-infantil.gif'); background-size: cover;">

<?php echo "<h3>$mensaje</h3>"; ?>

<button onclick="window.location.href = 'index.html';">Volver al menu principal</button>
<button onclick="window.location.href = 'IMC.html';">Volver a la Calculadora del IMC</button>
<button onclick="window.location.href = 'base_datos.php';">Ir a la Consulta de la base de Datos</button>

</body>
</html>
