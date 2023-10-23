<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Biblioteca de Cursos</title>
    <link rel="stylesheet" href="../estilos/style.css">
</head>
<body>
    <div class="sidebar">
        <a href="#">Inicio</a>
        <a href="#">Cursos</a>
        <a href="#">Agregar Curso</a>
        <a href="#">Configuración</a>
    </div>

    <div class="content">
        <h1>Biblioteca de Cursos</h1>

        <?php
        // Conexión a la base de datos (ajusta los detalles de conexión)
        $mysqli = new mysqli("localhost", "usuario", "contraseña", "biblioteca_cursos");

        // Verificar la conexión
        if ($mysqli->connect_error) {
            die("Error de conexión: " . $mysqli->connect_error);
        }

        // Consulta SQL para obtener los cursos
        $sql = "SELECT * FROM cursos";
        $result = $mysqli->query($sql);

        // Mostrar los cursos
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo '<div class="course">';
                echo '<h2>' . $row["nombre"] . '</h2>';
                echo '<img src="' . $row["imagen"] . '" alt="' . $row["nombre"] . '">';
                echo '<p>' . $row["descripcion"] . '</p>';
                echo '</div>';
            }
        } else {
            echo "No hay cursos disponibles.";
        }

        // Cerrar la conexión a la base de datos
        $mysqli->close();
        ?>

    </div>
</body>
</html>
