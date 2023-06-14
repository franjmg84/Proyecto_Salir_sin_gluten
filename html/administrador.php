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

					<?php
					// Iniciamos sesión
					session_start();
					// Si el usuario ha iniciado sesión, mostramos su nombre en el header
					if (isset($_SESSION['nombre'])) {
						echo "<li><p>Bienvenido, " . $_SESSION['nombre'] . "</p></li>";
						echo "<li><a href='../php/logout.php' class='cerrar-sesion'>Salir</a></li>";
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


	<div class="container">
	<h1>Panel de Administración</h1>
	<h2>Restaurantes</h2>
	<div class="container-table">
		<table id="tabla-restaurantes">
			<thead>
				<tr>
					<th>Nombre</th>
					<th>Dirección</th>
					<th>Puntuación</th>
					<th>Provincia</th>
					<th>Ciudad</th>
					<th>Acciones</th>
					<th>Imagen</th>
				</tr>
			</thead>
			<tbody>
				<?php
				// Conexión con la base de datos
				$conexion = mysqli_connect("localhost", "root", "admin", "proyectointegrado");

				// Consulta para obtener los restaurantes
				$resultado = mysqli_query($conexion, "SELECT * FROM restaurantes");

				// Iterar sobre los resultados de la consulta
				while ($fila = mysqli_fetch_array($resultado)) {
					echo "<tr>";
					echo "<td>" . $fila['nombre'] . "</td>";
					echo "<td>" . $fila['direccion'] . "</td>";
					echo "<td>" . $fila['puntuacion'] . "</td>";
					echo "<td>" . $fila['provincia'] . "</td>";
					echo "<td>" . $fila['ciudad'] . "</td>";
					echo "<td><a href='../php/eliminar_restaurantes.php?id=" . $fila['id'] . "'>Eliminar</a></td>";
					echo "<td><img src='../upload_image/" . $fila['ruta_imagen'] . "' alt='imagen'></td>";
					echo "</tr>";
				}

				// Cerrar la conexión con la base de datos
				mysqli_close($conexion);
				?>
			</tbody>
		</table>
	</div>

	<br><h2>Usuarios</h2>
	<div class="container-table">
		<table id="tabla-usuarios">
			<thead>
				<tr>
					<th>Nombre</th>
					<th>Email</th>
					<th>Es Administrador</th>
					<th>Acciones</th>
				</tr>
			</thead>
			<tbody>
				<?php
				// Conexión con la base de datos
				$conexion = mysqli_connect("localhost", "root", "admin", "proyectointegrado");

				// Consulta para obtener los usuarios
				$resultado = mysqli_query($conexion, "SELECT * FROM usuario");

				// Iterar sobre los resultados de la consulta
				while ($fila = mysqli_fetch_array($resultado)) {
					echo "<tr>";
					echo "<td>" . $fila['nombre'] . "</td>";
					echo "<td>" . $fila['email'] . "</td>";
					echo "<td>" . ($fila['es_administrador'] ? "Sí" : "No") . "</td>";
					echo "<td><a href='../php/eliminar_usuarios.php?id=" . $fila['id'] . "'>Eliminar</a></td>";
					echo "</tr>";
				}

				// Cerrar la conexión con la base de datos
				mysqli_close($conexion);
				?>
			</tbody>
		</table>
	</div>
</div>
<div class="waraper">
    <footer class="footer">
      <p>© 2023 Salir sin gluten. Todos los derechos reservados.</p>
    </footer>
  </div>

</body>

</html>