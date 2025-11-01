<?php
// backend/db.php
// Ajusta $user / $pass según tu instalación de XAMPP (por defecto root y sin password)
$host = "localhost";
$user = "root";
$pass = "";
$dbname = "foodorder";

$mysqli = new mysqli($host, $user, $pass, $dbname);
if ($mysqli->connect_errno) {
    http_response_code(500);
    die("Error de conexión a la base de datos: " . $mysqli->connect_error);
}
$mysqli->set_charset("utf8mb4");
?>
