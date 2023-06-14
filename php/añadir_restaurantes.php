<?php
// Verificar si se ha enviado el formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Obtener los datos del formulario
  $nombre = isset($_POST['nombre']) ? $_POST['nombre'] : '';
  $direccion = isset($_POST['direccion']) ? $_POST['direccion'] : '';
  /*$texto = isset($_POST['texto']) ? $_POST['texto'] : '';*/
  $puntuacion = isset($_POST['puntuacion']) ? $_POST['puntuacion'] : '';
  $web = isset($_POST['web']) ? $_POST['web'] : '';
  $telefono = isset($_POST['telefono']) ? $_POST['telefono'] : '';
  $codigo_postal = isset($_POST['codigo_postal']) ? $_POST['codigo_postal'] : '';
  $provincia = isset($_POST['provincia']) ? $_POST['provincia'] : '';
  $ciudad = isset($_POST['ciudad']) ? $_POST['ciudad'] : '';

  // Verificar si se ha subido una imagen
  if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] === UPLOAD_ERR_OK) {
    $archivo = $_FILES['imagen'];
    $nombre_archivo = $archivo['name'];
    $ruta_temporal = $archivo['tmp_name'];

    // Definir la ruta de destino en el servidor
    $ruta_destino = '../upload_image/' . $nombre_archivo;

    // Mover el archivo a la ubicación deseada en el servidor
    move_uploaded_file($ruta_temporal, $ruta_destino);
  } else {
    // No se ha subido una imagen, asignar un valor predeterminado
    $ruta_destino = '../upload_image/default.jpg';
  }

  // Guardar la ruta en la base de datos MySQL
  $conexion = mysqli_connect('localhost', 'root', 'admin', 'proyectointegrado');
  $ruta_guardada = mysqli_real_escape_string($conexion, $ruta_destino);
  $query = "INSERT INTO restaurantes (nombre, direccion, texto, puntuacion, web, telefono, codigo_postal, provincia, ciudad, ruta_imagen) VALUES ('$nombre', '$direccion', '$texto', '$puntuacion', '$web', '$telefono', '$codigo_postal', '$provincia', '$ciudad', '$ruta_guardada')";
  mysqli_query($conexion, $query);
  mysqli_close($conexion);

  header("Location: ../html/index.php");
}
?>
