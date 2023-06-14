<?php
// Conexión con la base de datos
$conexion = mysqli_connect("localhost", "root", "admin", "proyectointegrado");

// Verificar si se ha enviado un ID para eliminar
if(isset($_GET['id'])) {
    $id = $_GET['id'];

    // Consulta para eliminar el usuario con el ID especificado
    $resultado = mysqli_query($conexion, "DELETE FROM usuario WHERE id=$id");

    // Verificar si la consulta se ha ejecutado correctamente
    if($resultado) {
        // Redireccionar al panel de administración
        header("Location: ../html/administrador.php");
        exit();
    } else {
        echo "Error al eliminar el usuario.";
    }
}

// Cerrar la conexión con la base de datos
mysqli_close($conexion);
?>
