<?php
// Se incluyen las librerías necesarias
require('fpdf186/fpdf.php'); // Librería FPDF para generación de PDFs
require('Conexion.php'); // Archivo que establece la conexión a la base de datos

// Se define una clase 'PDF' que extiende de FPDF
class PDF extends FPDF
{
    // Cabecera de página
    function Header()
    {
        // Se inserta una imagen de fondo
        $this->Image('Imagenes/Fondo.jpg', 0, 0, 210, 297); // Imagen de fondo en el PDF
        // Se establece la fuente a Arial, negrita, tamaño 35
        $this->SetFont('Arial', 'B', 35);
        // Se mueve a la derecha (80 unidades de ancho)
        $this->Cell(80);
        // Se define el título de la página
        $this->Cell(30, 10, 'Medicamentos', 0, 0, 'C'); // Texto centrado
        // Se hace un salto de línea
        $this->Ln(20);
        // Se establece la fuente para los encabezados de la tabla
        $this->SetFont('Arial', 'B', 13); // Tamaño del encabezado
        $this->SetFillColor(30, 200, 30); // Color RGB para fondo de celdas de encabezado
        
        // Se crean los encabezados de las columnas en la tabla del PDF
        // Cada llamada a Cell() crea una celda en la tabla
        $this->Cell(20, 10, 'ID', 1, 0, 'C', true);          // Columna ID
        $this->Cell(40, 10, 'Sintoma', 1, 0, 'C', true);    // Columna Sintoma
        $this->Cell(31, 10, 'Medicamento', 1, 0, 'C', true); // Columna Medicamento
        $this->Cell(21, 10, 'Cantidad', 1, 0, 'C', true);    // Columna Cantidad
        $this->Cell(20, 10, 'Precio', 1, 0, 'C', true);      // Columna Precio
        $this->Cell(30, 10, 'Ingreso', 1, 0, 'C', true);     // Columna Ingreso
        $this->Cell(30, 10, 'Vencimiento', 1, 0, 'C', true); // Columna Vencimiento
        $this->Ln(); // Salto de línea para empezar la siguiente fila
    }

    // Pie de página
    function Footer()
    {
        // Posición: a 1,5 cm del final del documento
        $this->SetY(-15);
        // Se establece la fuente a Arial, itálica, tamaño 8
        $this->SetFont('Arial', 'I', 8);
        // Se muestra el número de página en el pie
        $this->Cell(0, 10, 'Page ' . $this->PageNo() . '/{nb}', 0, 0, 'C');
    }
}

// Creación del objeto de la clase PDF
$pdf = new PDF();
$pdf->AliasNbPages(); // Permite que la numeración de páginas se muestre correctamente
$pdf->AddPage(); // Se añade una nueva página al documento
$pdf->SetFont('Arial', 'B', 11); // Se establece el tamaño de fuente para el contenido

// Se define la consulta SQL para seleccionar toda la información de la tabla 'tratamientos'
$Consulta = "SELECT * FROM tratamientos";
// Se ejecuta la consulta utilizando la conexión a la base de datos ($camino)
$ejecutar = mysqli_query($camino, $Consulta);

// Se entra en un ciclo while para recorrer cada fila del resultado de la consulta
while($fila = mysqli_fetch_array($ejecutar)) {
    // Se añaden los datos de cada fila a la tabla del PDF
    $pdf->Cell(20, 10, $fila['id'], 1, 0, 'C');          // ID
    $pdf->Cell(40, 10, $fila['sintoma'], 1, 0, 'C');     // Sintoma
    $pdf->Cell(31, 10, $fila['medicamento'], 1, 0, 'C'); // Medicamento
    $pdf->Cell(21, 10, $fila['cantidad'], 1, 0, 'C');    // Cantidad
    $pdf->Cell(20, 10, $fila['precio'], 1, 0, 'C');      // Precio
    $pdf->Cell(30, 10, $fila['ingreso'], 1, 0, 'C');     // Ingreso
    $pdf->Cell(30, 10, $fila['vencimiento'], 1, 0, 'C'); // Vencimiento
    $pdf->Ln(); // Salto de línea para preparar el PDF para la siguiente fila
}

// Finalmente, se genera y envía el PDF al navegador
$pdf->Output();
?>
