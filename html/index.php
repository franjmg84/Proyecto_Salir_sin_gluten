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
?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Salir sin gluten - Buscador de restaurantes para celiacos</title>
  <link rel="stylesheet" href="../css/style.css">
  <script src="../js/imagen.js"></script>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css" rel="stylesheet">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="../js/buscar_restaurante.js"></script>
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
          <li><a href="index.php" class="menu">Inicio</a></li>
          <?php if (isset($_SESSION['nombre'])) { ?>
            <li><a href="añadir-restaurante.php" class="menu">Agregar Restaurante</a></li>
          <?php } ?>
          <li class="dropdown">
            <a href="#">Buscar <i class="fas fa-caret-down"></i></a>
            <ul class="dropdown-content">
              <li>
                <form method="GET" action="../php/buscar_restaurantes.php" class="buscar-form">
                  <input type="text" name="provincia" id="provincia" placeholder="Provincia">
                  <input type="text" name="ciudad" id="ciudad" placeholder="Ciudad">
                  <button type="submit">Buscar</button>
                </form>
              </li>
            </ul>
          </li>
          <?php if (!isset($_SESSION['nombre'])) { ?>
            <li><a href="registro.html" class="menu">Registrarse</a></li>
            <li><a href="login.html" class="menu">Login</a></li>
          <?php } ?>
          <li><a href="acerca-de.php" class="menu">Acerca de</a></li>
          <?php
          // Si el usuario ha iniciado sesión y es el administrador, mostramos el enlace al panel de administración
          if (isset($_SESSION['es_administrador']) && $_SESSION['es_administrador'] == 1) {
            // Mostrar el enlace al panel de administración
            echo '<li><a href="../html/administrador.php">Panel</a></li>';
          }


          // Si el usuario ha iniciado sesión, mostramos su nombre en el header
          if (isset($_SESSION['nombre'])) {
            echo "<li ><p>Bienvenido, " . $_SESSION['nombre'] . "</p></li>";
            echo "<li><a href='../php/logout.php' class='cerrar-sesion'>Salir</a></li>";
          } else {
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

  <main>
    <p class="bienvenida">
      ¡Bienvenido a nuestra página web de restaurantes! Nuestra web se dedica a ofrecerte una variedad de restaurantes
      que han adaptado sus menús para atender a personas con intolerancia al gluten. Explora nuestra selección y disfruta
      de una experiencia culinaria inclusiva y sin preocupaciones. Tu satisfacción gastronómica es nuestra prioridad.
      ¡Descubre deliciosas opciones para celíacos en cada restaurante listado en nuestra página web!
    </p>

    <h1 class="titulo">Restaurantes</h1><br>
    <div class="mostrar_restaurantes">
      <?php include '../php/mostrar_restaurantes_agregados.php'; ?><br>
    </div>z

  </main>


  <div class="waraper">
    <footer class="footer">
      <p>© 2023 Salir sin gluten. Todos los derechos reservados.</p>
    </footer>
  </div>

</body>

</html>