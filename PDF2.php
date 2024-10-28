<?php
// Importando la librería FPDF para generar PDFs
require('fpdf186/fpdf.php');
// Importando la conexión a la base de datos
require('Conexion.php');

// Definimos una nueva clase PDF que hereda de FPDF
class PDF extends FPDF
{
    // Función para la cabecera de cada página del PDF
    function Header()
    {
        // Añadiendo una imagen de fondo
        $this->Image('Imagenes/Fondo.jpg', 0, 0, 210, 297); // Imagen de fondo (210x297 mm, tamaño A4)
        
        // Estableciendo la fuente para el título (Arial negrita, tamaño 35)
        $this->SetFont('Arial','B',35);
        // Mover el cursor a la derecha 80 unidades
        $this->Cell(80);
        // Título de la página
        $this->Cell(30,10,'Clientes',0,0,'C'); // Título 'Clientes' centrado
        // Salto de línea
        $this->Ln(20);
        
        // Ahora definimos el formato para los encabezados de la tabla
        $this->SetFont('Arial', 'B', 14); // Cambiamos la fuente a Arial negrita, tamaño 14
        $this->SetFillColor(180, 100, 30); // Establecemos un color de fondo para las celdas (RGB)
        
        // Creando los encabezados de las columnas de la tabla
        $this->Cell(23, 10, 'ID', 1, 0, 'C', true);          // Columna ID
        $this->Cell(40, 10, 'Fecha', 1, 0, 'C', true);       // Columna Fecha
        $this->Cell(40, 10, 'Cliente', 1, 0, 'C', true);     // Columna Cliente
        $this->Cell(40, 10, 'Medicamento', 1, 0, 'C', true); // Columna Medicamento
        $this->Cell(23, 10, 'Cantidad', 1, 0, 'C', true);    // Columna Cantidad
        $this->Cell(23, 10, 'Precio', 1, 0, 'C', true);      // Columna Precio
        // Salto de línea para comenzar la siguiente fila
        $this->Ln();
    }

    // Función para el pie de página
    function Footer()
    {
        // Posicionando el cursor a 1.5 cm del final de la página
        $this->SetY(-15);
        // Estableciendo la fuente para el pie de página (Arial cursiva, tamaño 8)
        $this->SetFont('Arial','I',8);
        // Mostrando el número de página
        $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C'); // Centrando el número de página
    }
}

// Creando un nuevo objeto de la clase PDF
$pdf = new PDF();
// Configurando el alias para el número total de páginas
$pdf->AliasNbPages();
// Añadiendo una nueva página al PDF
$pdf->AddPage();
// Estableciendo la fuente para la tabla (Arial negrita, tamaño 12)
$pdf->SetFont('Arial','B',12);

// Definiendo la consulta SQL para seleccionar todos los datos de la tabla 'clientes'
$Consulta= " SELECT * FROM clientes";
// Ejecución de la consulta utilizando la conexión a la base de datos
$ejecutar=mysqli_query($camino, $Consulta);

// Usando un ciclo while para recorrer cada fila del resultado de la consulta
while($fila = mysqli_fetch_array($ejecutar)) {
    // Añadiendo los datos de cada fila a la tabla del PDF
    $pdf->Cell(23, 10, $fila['ID'], 1, 0, 'C');          // Muestra el ID
    $pdf->Cell(40, 10, $fila['Fecha'], 1, 0, 'C');       // Muestra la fecha
    $pdf->Cell(40, 10, $fila['Cliente'], 1, 0, 'C');     // Muestra el nombre del cliente
    $pdf->Cell(40, 10, $fila['Medicamento'], 1, 0, 'C'); // Muestra el medicamento
    $pdf->Cell(23, 10, $fila['Cantidad'], 1, 0, 'C');    // Muestra la cantidad
    $pdf->Cell(23, 10, $fila['Precio'], 1, 0, 'C');      // Muestra el precio
    $pdf->Ln(); // Salto de línea para preparar el PDF para la siguiente fila
}

// Finalmente, generamos y enviamos el PDF al navegador
$pdf->Output();
?>
