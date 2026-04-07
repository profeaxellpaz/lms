<?php
require_once __DIR__ . "/../app/middleware/auth.php";
require_role("student");

require_once __DIR__ . "/../app/views/header.php";
?>

<h2 class="fw-bold">Panel del Estudiante</h2>
<p class="text-muted">Bienvenido <?= htmlspecialchars($_SESSION["name"]) ?>.</p>

<div class="card shadow-sm p-3 mt-4">
    <h5 class="fw-bold">Mis Cursos</h5>
    <p class="text-muted small">Aquí se mostrarán tus cursos matriculados.</p>
    <button class="btn btn-dark btn-sm" disabled>Próximamente</button>
</div>

<?php require_once __DIR__ . "/../app/views/footer.php"; ?>