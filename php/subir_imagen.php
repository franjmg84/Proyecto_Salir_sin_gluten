<?php
if (isset($_FILES['imagen'])) {
  $nombreArchivo = $_FILES['imagen']['name'];
  $rutaTemporal = $_FILES['imagen']['tmp_name'];
  $rutaDestino = "../upload_image/" . $nombreArchivo;

  if (move_uploaded_file($rutaTemporal, $rutaDestino)) {
    // La imagen se ha subido correctamente, ahora puedes guardar la ruta en la base de datos
    $rutaImagen = $rutaDestino;
    // Aquí debes implementar el código para guardar $rutaImagen en la base de datos

    echo "La imagen se ha subido correctamente.";
  } else {
    echo "Error al subir la imagen.";
  }
}
?>
