<?php
// Se requiere la librería FPDF para generar PDFs
require('fpdf186/fpdf.php'); 

// Crear una clase que extiende la clase FPDF para personalizar el PDF
class PDF extends FPDF {
    // Método que define la cabecera de la página
    function Header() {
        // Inserta una imagen de fondo
        $this->Image('Imagenes/Fondo.jpg', 0, 0, 210, 297); // Imagen de fondo a tamaño A4 (210 x 297 mm)
        
        // Configuración de fuente para el título
        $this->SetFont('Arial', 'B', 35);
        
        // Mover la posición a la derecha
        $this->Cell(80);
        
        // Insertar el título "Clientes"
        $this->Cell(30, 10, 'Clientes', 0, 0, 'C'); // 30 es el ancho, 10 es la altura del texto
        $this->Ln(20); // Hacer un salto de línea después del título
        
        // Configuración de fuente y color para los encabezados de la tabla
        $this->SetFont('Arial', 'B', 14); // Fuente del encabezado
        $this->SetFillColor(180, 100, 30); // Color de fondo de las celdas en RGB
        
        // Crear los encabezados de las columnas en la tabla del PDF
        $this->Cell(23, 10, 'ID', 1, 0, 'C', true);          // Columna ID
        $this->Cell(40, 10, 'Fecha', 1, 0, 'C', true);       // Columna Fecha
        $this->Cell(40, 10, 'Cliente', 1, 0, 'C', true);     // Columna Cliente
        $this->Cell(40, 10, 'Medicamento', 1, 0, 'C', true); // Columna Medicamento
        $this->Cell(23, 10, 'Cantidad', 1, 0, 'C', true);    // Columna Cantidad
        $this->Cell(23, 10, 'Precio', 1, 0, 'C', true);      // Columna Precio
        $this->Ln(); // Hacer un salto de línea para iniciar la siguiente fila de datos
    }
}

// Datos de conexión a la base de datos MySQL
$servername = "localhost"; // Nombre del servidor de la base de datos
$username = "root"; // Nombre de usuario para acceder a la base de datos
$password = ""; // Contraseña del usuario
$dbname = "proyecto-farmacia"; // Nombre de la base de datos a utilizar

// Crear conexión a la base de datos
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar si la conexión fue exitosa
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error); // Termina el script si hay error de conexión
}

// Recuperar el código del cliente desde el formulario (método POST)
$codigo_cliente = isset($_POST['Codigo']) ? $_POST['Codigo'] : '';

// Preparar la consulta SQL para buscar al cliente por su ID
$sql = "SELECT * FROM clientes WHERE ID= ?";
$stmt = $conn->prepare($sql); // Preparar la declaración SQL
$stmt->bind_param("s", $codigo_cliente); // Vincular el parámetro (asumiendo que ID es una cadena)
$stmt->execute(); // Ejecutar la consulta
$result = $stmt->get_result(); // Obtener el resultado de la consulta

// Verificar si hay resultados de la consulta
if ($result->num_rows > 0) {
    // Crear una instancia de la clase PDF
    $pdf = new PDF();
    $pdf->AddPage(); // Agregar una nueva página al PDF
    $pdf->SetFont('Arial', 'B', 12); // Configurar la fuente para los datos
    
    // Recorrer cada fila del resultado de la consulta
    while($row = $result->fetch_assoc()) {
        // Agregar los datos de cada fila a las celdas del PDF
        $pdf->Cell(23, 10, $row['ID'], 1, 0, 'C');          // Mostrar el ID
        $pdf->Cell(40, 10, $row['Fecha'], 1, 0, 'C');       // Mostrar la fecha
        $pdf->Cell(40, 10, $row['Cliente'], 1, 0, 'C');     // Mostrar el nombre del cliente
        $pdf->Cell(40, 10, $row['Medicamento'], 1, 0, 'C'); // Mostrar el medicamento
        $pdf->Cell(23, 10, $row['Cantidad'], 1, 0, 'C');    // Mostrar la cantidad
        $pdf->Cell(23, 10, $row['Precio'], 1, 0, 'C');      // Mostrar el precio
        $pdf->Ln(); // Hacer un salto de línea para la próxima fila
    }
    
    // Cerrar las declaraciones y conexiones a la base de datos
    $stmt->close();
    $conn->close();
    
    // Generar el PDF y enviarlo al navegador
    $pdf->Output();
} else {
    // Si no se encontró el cliente, mostrar un mensaje adecuado
    echo "No se encontró el cliente con el código: " . htmlspecialchars($codigo_cliente);
}

// Cerrar la conexión (redundante porque se hace más arriba, pero por si se llega a ejecutar esa parte).
$stmt->close();
$conn->close();
?>
