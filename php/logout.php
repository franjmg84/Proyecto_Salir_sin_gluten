<?php
session_start();
// Destruimos todas las variables de sesión
$_SESSION = array();
// Destruimos la sesión
session_destroy();
// Redirigimos a la página de inicio de sesión
header('Location: ../html/index.php');
exit;
?>
