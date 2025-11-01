<?php
// backend/register.php
session_start();
require_once 'db.php';

$nombre = trim($_POST['nombre'] ?? '');
$email  = trim($_POST['email'] ?? '');
$password = $_POST['password'] ?? '';

if (!$nombre || !$email || !$password) {
    $_SESSION['error'] = "Completa todos los campos.";
    header("Location: ../register.html");
    exit;
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $_SESSION['error'] = "Email inválido.";
    header("Location: ../register.html");
    exit;
}

// Verificar si existe email
$stmt = $mysqli->prepare("SELECT id FROM usuarios WHERE email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$stmt->store_result();
if ($stmt->num_rows > 0) {
    $_SESSION['error'] = "El email ya está registrado.";
    $stmt->close();
    header("Location: ../register.html");
    exit;
}
$stmt->close();

// Hashear contraseña
$hash = password_hash($password, PASSWORD_DEFAULT);

$stmt = $mysqli->prepare("INSERT INTO usuarios (nombre, email, password) VALUES (?, ?, ?)");
$stmt->bind_param("sss", $nombre, $email, $hash);
if ($stmt->execute()) {
    // Autologin opcional: iniciar sesión directo
    $_SESSION['user_id'] = $stmt->insert_id;
    $_SESSION['user_name'] = $nombre;
    $stmt->close();
    header("Location: ../index.html");
    exit;
} else {
    $_SESSION['error'] = "Error al crear la cuenta.";
    $stmt->close();
    header("Location: ../register.html");
    exit;
}
