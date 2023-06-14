<?php
// Iniciamos sesión
session_start();

// Código de verificación
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  if ($_POST['usuario'] === 'root' && $_POST['password'] === 'password') {
    $_SESSION['nombre'] = 'root';
    header('Location: ../html/index.php');
  } else {
    echo '<p>Usuario o contraseña incorrectos</p>';
  }
}
// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['nombre'])) {
  // Redirigir al usuario a la página de inicio de sesión o mostrar un mensaje de error
  header('Location: login.html');
  exit; // Asegúrate de detener la ejecución del script después de redirigir al usuario
}
?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Salir sin gluten - Buscador de restaurantes para celiacos</title>
  <link rel="stylesheet" href="../css/style.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css" rel="stylesheet">
</head>

<body>
  <header>

    <div class="nav-container">
      <nav>
        <input type="checkbox" id="check">
        <label for="check" class="checkbtn">
          <i class="fas fa-bars"></i>
        </label>
        <ul>

          <li><a href="index.php">Inicio</a></li>
          <?php if (!isset($_SESSION['nombre'])) { ?>
            <li><a href="registro.html">Registrarse</a></li>
            <li><a href="login.html">Login</a></li>
          <?php } ?>

          <?php
          // Si el usuario ha iniciado sesión, mostramos su nombre en el header
          if (isset($_SESSION['nombre'])) {
            
            echo "<li><a href='../php/logout.php' class='cerrar-sesion'>Cerrar sesión</a></li>";
          } else {
          }
          ?>
          <li><a href="acerca-de.php">Acerca de</a></li>
          <?php

          // Si el usuario ha iniciado sesión, mostramos su nombre en el header
          if (isset($_SESSION['nombre'])) {
            echo "<li><p>Bienvenido, " . $_SESSION['nombre'] . "</p></li>";
          }
          ?>

        </ul>
      </nav>
    </div>
    <?php if (!isset($_SESSION['nombre'])) { ?>
      <button onclick="window.location.href='login.html'" type="button" class="btn btn-outline-light">Login</button>
    <?php } ?>
  </header>
  <div class="head">
    <img src="../imagenes/Salir_sin_Gluten.png" class="img" alt="imagen cabecera">
  </div>
  <h1 class="añadir">Añade tu restaurante</h1>
  <main>
    <div class="main-form">
    <div class="center-form">
      <div class="agregar-restaurante">
        <form action="../php/añadir_restaurantes.php" method="POST" enctype="multipart/form-data">
        <div class="form-group" > 
        <label for="nombre">Nombre:</label><br>
          <input type="text" id="nombre" name="nombre" required><br>

          <label for="direccion">Dirección:</label><br>
          <input type="text" id="direccion" name="direccion" required><br>
          </div> 

          <div class="form-group" >
          <label for="texto">Descripción:</label><br>
          <textarea id="texto" name="texto"></textarea><br>

          <label for="puntuacion">Puntuación:</label><br>
          <input type="number" id="puntuacion" name="puntuacion" min="0" max="5" step="0.1" required><br>
          </div>

          <div  class="form-group" >
          <label for="web">Web:</label><br>
          <input type="text" id="web" name="web"><br>

          <label for="telefono">Teléfono:</label><br>
          <input type="tel" id="telefono" name="telefono"><br>
          </div>

          <div class="form-group" >
          <label for="codigo_postal">Código postal:</label><br>
          <input type="text" id="codigo_postal" name="codigo_postal" required><br>

          <label for="provincia">Provincia:</label><br>
          <input type="text" id="provincia" name="provincia" required><br>

          <label for="ciudad">Ciudad:</label><br>
          <input type="text" id="ciudad" name="ciudad" required><br>
          </div>
          <div class="imagen-form">
          <label for="imagen">Imagen:</label><br>
          <input type="file" id="imagen" name="imagen" accept="image/*"><br>
          </div>
          <div class="agregar">
          <input type="submit" value="añadir restaurante">
          </div>
        </form>
      </div>
    </div>
    </div>
  </main>

  <div class="waraper">
    <footer class="footer">
      <p>© 2023 Salir sin gluten. Todos los derechos reservados.</p>
    </footer>
  </div>

</body>

</html>