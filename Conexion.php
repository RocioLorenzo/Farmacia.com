<?php
// Este bloque de código intenta establecer una conexión a una base de datos MySQL
try {
    // Se intenta conectar a la base de datos utilizando la función mysqli_connect.
    // Los parámetros son: el servidor (localhost), el usuario (root), la contraseña (vacía) y el nombre de la base de datos ("proyecto-farmacia").
    $camino = mysqli_connect("localhost", "root", "", "proyecto-farmacia");

} catch (Exception $ex) {
    // Si ocurre algún error en el intento de conexión, se captura la excepción.
    // Se muestra un mensaje de error que incluye la descripción del problema obtenido con $ex->getMessage().
    echo "Error en la conexión: " . $ex->getMessage();
}
?>
