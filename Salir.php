<?php
// Inicia la sesión. Esto es necesario para poder trabajar con las variables de sesión en PHP.
session_start();

// Destruye todas las variables de sesión registradas. Esto significa que se eliminará cualquier información guardada en la sesión actual.
// Después de ejecutar esta línea, la sesión en curso se considera cerrada.
session_destroy();

// Redirige al usuario a la página 'index.php'. Esto significa que, después de cerrar la sesión, el usuario será llevado a la página de inicio o la página principal del sitio web.
header("Location:index.php");
?>
