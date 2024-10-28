<?php
require('fpdf186/fpdf.php'); // Incluye la librería FPDF, que permite manejar la creación de documentos PDF

// Crear una clase que extiende la funcionalidad de FPDF
class PDF extends FPDF {
    // Método para definir la cabecera de cada página
    function Header() {
        // Insertar una imagen de fondo en el PDF
        $this->Image('Imagenes/Fondo.jpg', 0, 0, 210, 297);
        
        // Establecer fuente en Arial, negrita (B) y tamaño 35
        $this->SetFont('Arial', 'B', 35);
        
        // Mover el cursor a la derecha para centrar el título
        $this->Cell(80);
        // Crear una celda con el título 'Medicamentos', no borde (0) y centrado (C)
        $this->Cell(30, 10, 'Medicamentos', 0, 0, 'C');
        // Crear un salto de línea
        $this->Ln(20);
        
        // Establecer fuente para los encabezados de la tabla
        $this->SetFont('Arial', 'B', 13); // Tamaño para encabezados
        
        // Establecer el color de fondo para las celdas (un verde claro en este caso)
        $this->SetFillColor(30, 200, 30); // Color RGB
        
        // Crear los encabezados de las columnas en la tabla
        $this->Cell(20, 10, 'ID', 1, 0, 'C', true); // Encabezado ID
        $this->Cell(40, 10, 'Sintoma', 1, 0, 'C', true); // Encabezado Sintoma
        $this->Cell(31, 10, 'Medicamento', 1, 0, 'C', true); // Encabezado Medicamento
        $this->Cell(21, 10, 'Cantidad', 1, 0, 'C', true); // Encabezado Cantidad
        $this->Cell(20, 10, 'Precio', 1, 0, 'C', true); // Encabezado Precio
        $this->Cell(30, 10, 'Ingreso', 1, 0, 'C', true); // Encabezado Ingreso
        $this->Cell(30, 10, 'Vencimiento', 1, 0, 'C', true); // Encabezado Vencimiento
        $this->Ln(); // Salto de línea para preparar la siguiente fila
    }
}

// Configuración de datos de conexión a la base de datos MySQL
$servername = "localhost"; // Nombre del servidor de base de datos
$username = "root"; // Nombre de usuario para la base de datos
$password = ""; // Contraseña para la base de datos
$dbname = "proyecto-farmacia"; // Nombre de la base de datos

// Crear una conexión utilizando mysqli
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión, si hay un error terminar el script
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Recuperar el código del medicamento enviado a través del formulario POST
$codigo_medicamento = isset($_POST['Codigo']) ? $_POST['Codigo'] : '';

// Preparar la consulta SQL para recuperar información de la tabla 'tratamientos'
$sql = "SELECT * FROM tratamientos WHERE ID= ?";
$stmt = $conn->prepare($sql); // Preparar la consulta
$stmt->bind_param("s", $codigo_medicamento); // Vincular el código del medicamento a la consulta
$stmt->execute(); // Ejecutar la consulta
$result = $stmt->get_result(); // Obtener el resultado de la consulta

// Verificar si se encontraron resultados
if ($result->num_rows > 0) {
    // Crear una instancia de la clase PDF
    $pdf = new PDF();
    $pdf->AddPage(); // Añadir una nueva página al PDF
    $pdf->SetFont('Arial', 'B', 11); // Establecer la fuente para el contenido de la tabla
    
    // Recorrer cada fila del resultado de la consulta
    while($row = $result->fetch_assoc()) {
        // Añadir los datos de cada fila a la tabla del PDF
        $pdf->Cell(20, 10, $row['id'], 1, 0, 'C'); // Añadir el ID
        $pdf->Cell(40, 10, $row['sintoma'], 1, 0, 'C'); // Añadir el Sintoma
        $pdf->Cell(31, 10, $row['medicamento'], 1, 0, 'C'); // Añadir el Medicamento
        $pdf->Cell(21, 10, $row['cantidad'], 1, 0, 'C'); // Añadir la Cantidad
        $pdf->Cell(20, 10, $row['precio'], 1, 0, 'C'); // Añadir el Precio
        $pdf->Cell(30, 10, $row['ingreso'], 1, 0, 'C'); // Añadir Ingreso
        $pdf->Cell(30, 10, $row['vencimiento'], 1, 0, 'C'); // Añadir Vencimiento
        $pdf->Ln(); // Crear un salto de línea para la próxima fila
    }
    
    // Cerrar la declaración del prepared statement y la conexión a la base de datos
    $stmt->close();
    $conn->close();
    
    // Generar y mostrar el PDF
    $pdf->Output();
} else {
    // Si no se encontraron resultados, se muestra un mensaje de error
    echo "No se encontró el medicamento con el código: " . htmlspecialchars($codigo_medicamento);
}

// Cerrar conexión (Redundante, ya se cerró anteriormente)
$stmt->close();
$conn->close();
?>
