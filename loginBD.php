<?php
// Incluye el archivo de conexión a la base de datos
require('Conexion.php');

// Recupera los valores enviados por el formulario usando el método POST
// Si no se envían, se establece un valor por defecto (una cadena vacía)
$U = isset($_POST["txtU"]) ? $_POST["txtU"] : "";
$C = isset($_POST["txtC"]) ? $_POST["txtC"] : "";

try {
    // Prepara la consulta SQL para verificar si el usuario y la contraseña existen en la base de datos
    // Utiliza variables directamente en la consulta, lo que puede ser susceptible a inyecciones SQL
    $Consulta = "SELECT Usua, Contra FROM usuarios WHERE Usua='$U' AND Contra='$C'";
    
    // Ejecuta la consulta en la base de datos
    $ejecutar = mysqli_query($camino, $Consulta);

    // Verifica si se encontraron filas en la consulta
    if (mysqli_num_rows($ejecutar) > 0) {
        // Inicia la sesión para el usuario
        session_start();
        
        // Guarda los resultados de la consulta en la sesión
        $_SESSION['usuarios'] = $ejecutar;
        
        // Redirige al usuario a la página de inicio
        header("location: Inicio.php");
    } else {
        // Si no se encontró el usuario o contraseña, muestra un mensaje de error
        echo "Usuario y/o contraseña incorrecta";
    }
} catch (Exception $e) {
    // Si ocurre un error, muestra un mensaje de error
    echo "Error: " . $e->getMessage();
}
?>
