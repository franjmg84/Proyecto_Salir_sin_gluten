<?php
session_start();

if (isset($_POST['logout'])) {
  // Destruimos todas las variables de sesión
  $_SESSION = array();
  // Destruimos la sesión
  session_destroy();
  // Redirigimos a la página de inicio de sesión
  header('Location: ../html/index.php');
  exit;
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
          <li><a href="registro.html">Registrarse</a></li>
          <li><a href="acerca-de.php">Acerca de</a></li>
          <?php
          if (isset($_SESSION['nombre'])) {
            echo "<li><p>Bienvenido, " . $_SESSION['nombre'] . "</p></li>";
            echo "<li><a href='logout.php' class='cerrar-sesion'>Cerrar sesión</a></li>";
          } else {
            echo "<li><a href='../html/index.php'>Login</a></li>";
          }
          ?>
        </ul>
      </nav>
    </div>
  </header>
  <div class="head">
    <img src="../imagenes/Salir_sin_Gluten.png" class="img" alt="imagen cabecera">
  </div>
  <main>
    <h1 class="buscar">Tu buscador de Restaurantes para Celiacos</h1>
    <div class="buscar">
      <form method="GET" action="buscar.php">
        <label for="provincia">Provincia:</label>
        <input type="text" name="provincia" id="provincia" />
        <br />
        <label for="ciudad">Ciudad:</label>
        <input type="text" name="ciudad" id="ciudad" />
        <br />
        <button type="submit">Buscar</button>
      </form>
    </div>
  </main>
    <!-- Script para mostrar la ventana modal -->
    <script>
    function openModal() {
      var modal = document.getElementById("myModal");
      modal.style.display = "block";
    }
  </script>
</body>

</html>