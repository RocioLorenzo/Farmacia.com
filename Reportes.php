<!-- Incluye el archivo de cabecera que contiene la parte superior de la página -->
<?php include("plantillas/cabecera.php"); ?>

<!-- Requiere (incluye y evalúa) el archivo "Conexion.php" que probablemente maneja la conexión a la base de datos -->
<?php require("Conexion.php"); ?>

<!-- Incluye el archivo de pie que contiene la parte inferior de la página -->
<?php include("plantillas/pie.php"); ?>

<!-- Crea una fila (usando Bootstrap o un framework similar para diseño) -->
<div class="row">

    <!-- Centra el título "Medicamentos" -->
    <center><h1>Medicamentos</h1></center>

    <!-- Define una columna para el formulario de medicamentos -->
    <div class="col-lg-4">
        <!-- Formulario para generar reporte de un medicamento específico -->
        <form action="reporte1.php" method="post">
            <label for="Codigo">Código del Medicamento:</label>
            <!-- Campo de entrada para el código del medicamento, requerido -->
            <input type="text" id="Codigo" name="Codigo" required>
            <!-- Botón de envío que genera un PDF para el medicamento ingresado -->
            <input type="submit" value="Generar PDF">                     
        </form>

        <!-- Formulario adicional para generar un PDF con todos los medicamentos -->
        <form action="PDF.php" method="POST">
            <div class="mb-3"> 
                <label for="" class="form-label">Medicamentos:</label>                  
                <!-- Botón de envío que genera un PDF que contiene todos los medicamentos -->
                <input type="submit" name="accion" value="Generar PDF">
            </div>
        </form>        
    </div>

    <!-- Centra el título "Clientes" -->
    <center><h1>Clientes</h1></center>

    <!-- Define otra columna para el formulario de clientes -->
    <div class="col-lg-4">
        <!-- Formulario para generar reporte de un cliente específico -->
        <form action="reporte2.php" method="post">
            <label for="Codigo">Código del Cliente:</label>
            <!-- Campo de entrada para el código del cliente, requerido -->
            <input type="text" id="Codigo" name="Codigo" required >
            <!-- Botón de envío que genera un PDF para el cliente ingresado -->
            <input type="submit" value="Generar PDF">
        </form>

        <!-- Formulario adicional para generar un PDF con todos los clientes -->
        <form action="PDF2.php" method="POST">
            <div class="mb-3">
                <label for="" class="form-label">Clientes:</label>
                <!-- Botón de envío que genera un PDF que contiene todos los clientes -->
                <input type="submit" name="accion" value="Generar PDF">
            </form>
        </div>            
    </div>
</body>
</html>
