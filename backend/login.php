<?php
// backend/login.php
session_start();
require_once 'db.php';

$email = trim($_POST['email'] ?? '');
$password = $_POST['password'] ?? '';

if (!$email || !$password) {
    $_SESSION['error'] = "Completa todos los campos.";
    header("Location: ../login.html");
    exit;
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $_SESSION['error'] = "Email inválido.";
    header("Location: ../login.html");
    exit;
}

$stmt = $mysqli->prepare("SELECT id, nombre, password FROM usuarios WHERE email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$stmt->store_result();
if ($stmt->num_rows === 0) {
    $_SESSION['error'] = "Credenciales incorrectas.";
    $stmt->close();
    header("Location: ../login.html");
    exit;
}
$stmt->bind_result($id, $nombre, $hash);
$stmt->fetch();

if (password_verify($password, $hash)) {
    // Login correcto
    session_regenerate_id(true);
    $_SESSION['user_id'] = $id;
    $_SESSION['user_name'] = $nombre;
    $stmt->close();
    header("Location: ../dashboard.html");
    exit;
} else {
    $_SESSION['error'] = "Credenciales incorrectas.";
    $stmt->close();
    header("Location: ../login.html");
    exit;
}
