<?php include("plantillas/cabecera.php"); // Incluye la cabecera de la página ?>
<?php
require("Conexion.php"); // Incluye el archivo de conexión a la base de datos

// Recupera y asigna valores de los inputs del formulario, asigna una cadena vacía si no se envían.
$cod= isset(($_POST["Codigo"])) ? $_POST["Codigo"] : ""; // Código del medicamento
$sin= isset(($_POST["Sintomas"])) ? $_POST["Sintomas"] : ""; // Sintomas asociados
$nom= isset(($_POST["Medicamento"])) ? $_POST["Medicamento"] : ""; // Nombre del medicamento
$can= isset(($_POST["Cantidad"])) ? $_POST["Cantidad"] : ""; // Cantidad del medicamento
$precio= isset(($_POST["Precio"])) ? $_POST["Precio"] : ""; // Precio del medicamento
$ingre= isset(($_POST["Ingreso"])) ? $_POST["Ingreso"] : ""; // Fecha de ingreso
$venci= isset(($_POST["Vencimiento"])) ? $_POST["Vencimiento"] : ""; // Fecha de vencimiento
$accion = isset(($_POST["accion"])) ? $_POST["accion"] : ""; // Acción a realizar

// Verifica qué acción se debe realizar (Guardar, Modificar, Eliminar, Buscar según el botón presionado)
if ($accion == "Guardar") {
    // Inserta un nuevo registro en la tabla tratamientos
    $Consulta = "INSERT INTO tratamientos(id, sintoma, medicamento, cantidad, precio, ingreso, vencimiento) VALUES('$cod','$sin','$nom','$can','$precio','$ingre','$venci')";
    $ejecutar = mysqli_query($camino, $Consulta); // Ejecuta la consulta
    echo "Datos Almacenados Correctamente "; // Mensaje de éxito
} 
else if ($accion == "Modificar") {
    // Actualiza un registro existente en la tabla tratamientos
    $Consulta = "UPDATE tratamientos
    SET cantidad= '$can',
    sintoma='$sin',
    medicamento= '$nom',
    precio= '$precio',
    ingreso= '$ingre',
    vencimiento= '$venci'
    WHERE id = '$cod'"; // Se busca el registro por su id
    $ejecutar = mysqli_query($camino, $Consulta); // Ejecuta la consulta
    echo "Datos Modificados Correctamente "; // Mensaje de éxito
}
else if ($accion == "Eliminar") {
    // Elimina un registro de la tabla tratamientos
    $Consulta = "DELETE FROM tratamientos WHERE id = '$cod'";   
    $ejecutar = mysqli_query($camino, $Consulta); // Ejecuta la consulta
    echo "Datos Eliminados Correctamente"; // Mensaje de éxito
}
else if ($accion == "Buscar") {
    // Busca un registro específico en la tabla tratamientos
    $Consulta = "SELECT * FROM tratamientos WHERE id = '$cod'"; 
    $ejecutar = mysqli_query($camino, $Consulta); // Ejecuta la consulta
    $lupa = mysqli_fetch_array($ejecutar); // Recupera el resultado de la búsqueda
    // Asigna los valores encontrados a las variables correspondientes
    $cod = $lupa['id'];
    $sin = $lupa['sintoma'];
    $nom = $lupa['medicamento'];
    $can = $lupa['cantidad'];
    $precio = $lupa['precio'];
    $ingre = $lupa['ingreso'];
    $venci = $lupa['vencimiento'];
    echo "Datos Encontrados"; // Mensaje de éxito
}
?>
<?php include("plantillas/pie.php"); // Incluye el pie de página ?>
<div class="row">
    <center><h1>Medicamentos</h1></center> <!-- Título principal -->
        <div class="col-lg-4">
            <form method="POST"> <!-- Formulario que envía datos mediante método POST -->
                <div class="mb-3">
                    <label for="" class="form-label">Codigo:</label>
                    <input type="text" class="form-control" name="Codigo" id="Codigo" 
                    placeholder="" value="<?php echo $cod; ?>"/> <!-- Valor del input se establece con el código correspondiente -->

                    <div class="mb-3">
                        <label for="" class="form-label">Sintomas:</label>
                        <input type="text" class="form-control" name="Sintomas" id="Sintomas" 
                        placeholder="" value="<?php echo $sin; ?>"/> <!-- Valor del input se establece con los sintomas -->

                        <label for="" class="form-label">Medicamento:</label>
                        <input type="text" class="form-control" name="Medicamento" id="Medicamento" 
                        placeholder="" value="<?php echo $nom; ?>"/> <!-- Valor del input se establece con el nombre del medicamento -->

                        <div class="mb-3">
                            <label for="" class="form-label">Cantidad:</label>
                            <input type="number" class="form-control" name="Cantidad" id="Cantidad" 
                            placeholder="" value="<?php echo $can; ?>"/> <!-- Valor del input se establece con la cantidad -->

                            <label for="" class="form-label">Precio Unitario:</label>
                            <input type="text" class="form-control" name="Precio" id="Precio" 
                            placeholder="" value="<?php echo $precio; ?>"/> <!-- Valor del input se establece con el precio -->

                            <div class="mb-3">
                                <label for="" class="form-label">Fecha de Ingreso:</label>
                                <input type="date" class="form-control" name="Ingreso" id="Ingreso" 
                                placeholder="" value="<?php echo $ingre; ?>"/> <!-- Valor del input se establece con la fecha de ingreso -->

                                <div class="mb-3">
                                    <label for="" class="form-label">Fecha de Vencimiento:</label>
                                    <input type="date" class="form-control" name="Vencimiento" id="Vencimiento" 
                                    placeholder="" value="<?php echo $venci; ?>"/> <!-- Valor del input se establece con la fecha de vencimiento -->
                                </div>
                            </div>
                            <!-- Botones de acción para el formulario -->
                            <button type="submit" name="accion" value="Guardar" class="btn">Guardar</button>
                            <button type="submit" name="accion" value="Modificar" class="btn btn-success">Modificar</button>
                            <button type="submit" name="accion" value="Eliminar" class="btn btn-danger">Eliminar</button>
                            <button type="submit" name="accion" value="Buscar" class="btn btn-warning">Buscar</button>
                        </form>
                </div>
            </div>
</div>
