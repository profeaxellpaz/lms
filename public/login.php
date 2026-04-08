<?php
session_start();

require_once __DIR__ . "/../app/config/database.php";
require_once __DIR__ . "/../app/helpers/functions.php";

$error = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $username = trim($_POST["username"] ?? "");
    $password = trim($_POST["password"] ?? "");

    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = :username LIMIT 1");
    $stmt->execute(["username" => $username]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {

        if ($user["status"] !== "active") {
            $error = "Tu cuenta está bloqueada. Contacta al administrador.";
        } else {

            if (password_verify($password, $user["password_hash"])) {

                $_SESSION["user_id"] = $user["id"];
                $_SESSION["username"] = $user["username"];
                $_SESSION["name"] = $user["name"];
                $_SESSION["role"] = $user["role"];

                if ($user["role"] === "admin") {
                    redirect("../admin/dashboard.php");
                } elseif ($user["role"] === "teacher") {
                    redirect("../teacher/dashboard.php");
                } else {
                    redirect("../student/dashboard.php");
                }

            } else {
                $error = "Contraseña incorrecta.";
            }
        }

    } else {
        $error = "Usuario no encontrado.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Mi LMS</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light d-flex justify-content-center align-items-center vh-100">

<div class="card shadow p-4" style="width: 380px;">
    <h3 class="text-center mb-3 fw-bold">Programa Académico Zénit</h3>

    <?php if ($error): ?>
        <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>

    <form method="POST">
        <div class="mb-3">
            <label class="form-label">Usuario</label>
            <input type="text" name="username" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Contraseña</label>
            <input type="password" name="password" class="form-control" required>
        </div>

        <button class="btn btn-dark w-100 fw-bold">Ingresar</button>
    </form>

    <hr>

    <p class="text-muted small text-center mb-0">
        Ingrese con su usuario y contraseña
    </p>
</div>

</body>
</html>