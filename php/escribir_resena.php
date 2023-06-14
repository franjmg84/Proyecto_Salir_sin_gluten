<?php
// Verificar si se ha enviado el formulario de reseña
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos enviados por el formulario
    $idRestaurante = $_POST["id_restaurante"];
    $textoResena = $_POST["texto_resena"];
    $puntuacionResena = $_POST["puntuacion_resena"];

    // Realizar validaciones y procesar los datos como sea necesario
    // ...

    // Guardar la reseña en la base de datos
    // ...

    // Redirigir a la página de detalles del restaurante o mostrar un mensaje de éxito
    // ...
} else {
    // Si no se ha enviado el formulario, mostrar el formulario de reseña
    $idRestaurante = $_GET["id_restaurante"];
?>
<!DOCTYPE html>
<html>
<head>
    <title>Escribir Reseña</title>
</head>
<body>
    <h2>Escribir Reseña</h2>
    <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <input type="hidden" name="id_restaurante" value="<?php echo $idRestaurante; ?>">
        <label for="texto_resena">Reseña:</label>
        <textarea name="texto_resena" required></textarea>
        <br>
        <label for="puntuacion_resena">Puntuación:</label>
        <input type="number" name="puntuacion_resena" min="1" max="5" required>
        <br>
        <input type="submit" value="Enviar Reseña">
    </form>
</body>
</html>
<?php
}
?>
