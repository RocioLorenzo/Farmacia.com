<?php include("plantillas/cabecera.php"); // Incluir la cabecera de plantilla ?>
<?php
require("Conexion.php"); // Incluir el archivo de conexión a la base de datos

// Inicializar variables a partir de los datos enviados por POST
$cod = isset($_POST["Codigo"]) ? $_POST["Codigo"] : ""; // Código del cliente
$date = isset($_POST["Fecha"]) ? $_POST["Fecha"] : ""; // Fecha de solicitud
$user = isset($_POST["Cliente"]) ? $_POST["Cliente"] : ""; // Nombre del cliente
$si = isset($_POST["sintoma"]) ? $_POST["sintoma"] : ""; // Síntoma reportado
$nom = isset($_POST["medicamento"]) ? $_POST["medicamento"] : ""; // Medicamento
$can = isset($_POST["cantidad"]) ? $_POST["cantidad"] : ""; // Cantidad del medicamento
$precio = isset($_POST["precio"]) ? $_POST["precio"] : ""; // Precio del medicamento
$accion = isset($_POST["accion"]) ? $_POST["accion"] : ""; // Acción a realizar (Guardar, Modificar, Eliminar, Buscar)

// Si la acción es "Guardar", se insertan los datos en la base de datos
if ($accion == "Guardar") {
    $Consulta = "INSERT INTO clientes(ID, Sintoma, Cliente, Medicamento, Cantidad, Precio, Fecha) 
                 VALUES('$cod','$si','$user','$nom','$can','$precio','$date')";
    $ejecutar = mysqli_query($camino, $Consulta); // Ejecutar consulta SQL
    echo "Datos Almacenados Correctamente"; // Mensaje de éxito
} 
// Si la acción es "Modificar", se modifican los datos del cliente existente
else if ($accion == "Modificar") {
    $Consulta = "UPDATE clientes SET Cantidad= '$can', Medicamento= '$nom', Precio= '$precio', 
                  Cliente= '$user', Fecha= '$date' WHERE ID = '$cod'";
    $ejecutar = mysqli_query($camino, $Consulta); // Ejecutar consulta SQL
    echo "Datos Modificado Correctamente"; // Mensaje de éxito
} 
// Si la acción es "Eliminar", se eliminan los datos del cliente
else if ($accion == "Eliminar") {
    $Consulta = "DELETE FROM clientes WHERE ID= '$cod'";   
    $ejecutar = mysqli_query($camino, $Consulta); // Ejecutar consulta SQL
    echo "Datos Eliminados Correctamente"; // Mensaje de éxito
} 
// Si la acción es "Buscar", se buscan los datos del cliente por su ID
else if ($accion == "Buscar") {
    $Consulta = "SELECT * FROM clientes WHERE ID = '$cod'";
    $ejecutar = mysqli_query($camino, $Consulta); // Ejecutar consulta SQL
    $lupa = mysqli_fetch_array($ejecutar); // Obtener el resultado de la consulta
    // Asignar los valores recuperados a las variables
    $cod = $lupa['ID'];
    $nom = $lupa['Medicamento'];
    $si = $lupa['Sintoma'];
    $can = $lupa['Cantidad'];
    $precio = $lupa['Precio'];
    $user = $lupa['Cliente'];
    $date = $lupa['Fecha'];
    echo "Datos Encontrados"; // Mensaje de éxito
}

?>

<?php include("plantillas/pie.php"); // Incluir el pie de plantilla ?>
<head>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> <!-- Incluir jQuery -->
</head>
<body>
<script>
$(document).ready(function() { // Esperar a que el documento esté listo
    $('#sintoma').on('input', function() { // Cuando se escribe en el campo 'sintoma'
        var sintoma = $(this).val(); // Obtener el valor del síntoma
      
        $.ajax({ // Hacer una llamada AJAX
            url: 'buscar_medicamento.php', // URL del script que procesa la búsqueda
            type: 'POST', // Tipo de petición
            data: {sintoma: sintoma}, // Enviar el sintoma como datos
            dataType: 'json', // Esperar una respuesta en formato JSON
            success: function(data) { // Si la llamada tiene éxito
                if (data) { // Si se encontraron datos
                    $('#medicamento').val(data.medicamento); // Rellenar el campo medicamento
                    $('#cantidad').val(data.cantidad); // Rellenar el campo cantidad
                    $('#precio').val(data.precio); // Rellenar el campo precio
                } else { // Si no se encontraron datos
                    $('#medicamento').val(''); // Limpiar el campo medicamento
                    $('#cantidad').val(''); // Limpiar el campo cantidad
                    $('#precio').val(''); // Limpiar el campo precio
                }
            }
        });
    });
});
</script>

</body>
</html>

<div class="row">
    <center><h1>Clientes</h1></center> <!-- Título de la sección -->
    <div class="col-lg-4">
        <form method="POST"> <!-- Formulario que envía datos por método POST -->
            <div class="mb-3">
                <label for="" class="form-label">ID:</label>
                <input type="text" class="form-control" name="Codigo" id="Codigo" placeholder="" 
                value="<?php echo $cod; ?>"/> <!-- Campo para el ID del cliente -->
            </div>    
            <div class="mb-3">
                <label for="" class="form-label">Fecha de Solicitud:</label>
                <input type="date" class="form-control" name="Fecha" id="Fecha" 
                value="<?php echo $date; ?>"/> <!-- Campo para la fecha -->
            </div>                  
            <div class="mb-3">
                <label for="" class="form-label">Nombre del Cliente:</label>
                <input type="text" class="form-control" name="Cliente" id="Cliente" 
                value="<?php echo $user; ?>"/> <!-- Campo para el nombre del cliente -->
            </div>
            <label for="sintoma">Síntoma:</label>
            <input type="text" id="sintoma" name="sintoma" placeholder="" 
            value="<?php echo $si; ?>"/> <!-- Campo para el síntoma -->

            <label for="medicamento">Medicamento:</label>
            <input type="text" id="medicamento" name="medicamento" placeholder="" 
            value="<?php echo $nom; ?>"/><br> <!-- Campo para el medicamento -->

            <label for="cantidad">Cantidad:</label>
            <input type="number" id="cantidad" name="cantidad" placeholder="" 
            value="<?php echo $can; ?>"/> <!-- Campo para la cantidad -->

            <label for="precio">Precio:</label>
            <input type="text" id="precio" name="precio" placeholder="" 
            value="<?php echo $precio; ?>"/><br><br> <!-- Campo para el precio -->
    
            <button type="submit" name="accion" value="Guardar" class="btn">Guardar</button> <!-- Botón para guardar datos -->
            <button type="submit" name="accion" value="Modificar" class="btn btn-success">Modificar</button> <!-- Botón para modificar datos -->
            <button type="submit" name="accion" value="Eliminar" class="btn btn-danger">Eliminar</button> <!-- Botón para eliminar datos -->
            <button type="submit" name="accion" value="Buscar" class="btn btn-warning">Buscar</button> <!-- Botón para buscar datos -->
        </form>
    </div>
</div>
