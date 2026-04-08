<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mi LMS</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand fw-bold" href="../public/index.php">Mi LMS</a>

        <div class="d-flex">
            <?php if (isset($_SESSION["username"])): ?>
                <span class="navbar-text text-white me-3">
                    <?= htmlspecialchars($_SESSION["name"]) ?> (<?= htmlspecialchars($_SESSION["role"]) ?>)
                </span>
                <a href="../logout.php" class="btn btn-outline-light btn-sm">Salir</a>
            <?php endif; ?>
        </div>
    </div>
</nav>

<div class="container mt-4">