<?php
// Definimos los parámetros de conexión a la base de datos
$servername = "localhost";  // Dirección del servidor de la base de datos (en este caso, es local)
$username = "root";         // Nombre de usuario para la base de datos (cambiar según la configuración)
$password = "";               // Contraseña para la base de datos (cambiar según la configuración)
$dbname = "proyecto-farmacia"; // Nombre de la base de datos a usar

// Crear conexión con la base de datos usando la clase mysqli
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar si hubo un error en la conexión
if ($conn->connect_error) {
    // Si hay error, finalizar la ejecución y mostrar el mensaje de error
    die("Connection failed: " . $conn->connect_error);
}

// Obtener el síntoma enviado mediante el método POST desde la solicitud
$sintoma = $_POST['sintoma'];

// Preparar la consulta SQL para seleccionar medicamentos basados en el síntoma
$sql = "SELECT medicamento, cantidad, precio FROM tratamientos WHERE sintoma = ?";
// Utilizamos una sentencia preparada para evitar inyecciones SQL
$stmt = $conn->prepare($sql);

// Vinculamos el parámetro de la consulta (en este caso, el síntoma es de tipo string)
$stmt->bind_param("s", $sintoma);

// Ejecutar la consulta preparada
$stmt->execute();

// Obtener el resultado de la ejecución de la consulta
$result = $stmt->get_result();

// Comprobar si se encontraron filas en el resultado
if ($result->num_rows > 0) {
    // Si hay resultados, obtenemos la primera fila como un array asociativo
    $row = $result->fetch_assoc();
    // Convertimos la fila a formato JSON y la enviamos como respuesta
    echo json_encode($row);
} else {
    // Si no se encontraron resultados, devolvemos null en formato JSON
    echo json_encode(null);
}

// Cerrar la sentencia preparada
$stmt->close();
// Cerrar la conexión con la base de datos
$conn->close();
?>
