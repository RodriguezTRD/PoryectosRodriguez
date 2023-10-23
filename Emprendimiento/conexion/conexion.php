<?php
$servername = "localhost";
$username = "root";
$password = "";
$bd = "rodritecserve";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $bd);

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}
?>
