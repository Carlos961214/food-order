<?php
session_start();
if (empty($_SESSION['user_id'])) {
    header("Location: ../login.html");
    exit;
}
?>
<!doctype html>
<html>
<head><meta charset="utf-8"><title>Dashboard</title></head>
<body>
  <h1>Hola, <?php echo htmlspecialchars($_SESSION['user_name']); ?></h1>
  <a href="logout.php">Cerrar sesión</a>
</body>
</html>
