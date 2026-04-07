<?php
require_once __DIR__ . "/../app/middleware/auth.php";
require_role("admin");

require_once __DIR__ . "/../app/views/header.php";
?>

<h2 class="fw-bold">Panel del Administrador</h2>
<p class="text-muted">Bienvenido <?= htmlspecialchars($_SESSION["name"]) ?>.</p>

<div class="row mt-4">

    <div class="col-md-4">
        <div class="card shadow-sm p-3">
            <h5 class="fw-bold">Gestión de Usuarios</h5>
            <p class="text-muted small">Crear estudiantes y profesores.</p>
            <button class="btn btn-dark btn-sm" disabled>Próximamente</button>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card shadow-sm p-3">
            <h5 class="fw-bold">Gestión de Cursos</h5>
            <p class="text-muted small">Crear cursos y asignar docentes.</p>
            <button class="btn btn-dark btn-sm" disabled>Próximamente</button>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card shadow-sm p-3">
            <h5 class="fw-bold">Configuración</h5>
            <p class="text-muted small">Control global del LMS.</p>
            <button class="btn btn-dark btn-sm" disabled>Próximamente</button>
        </div>
    </div>

</div>

<?php require_once __DIR__ . "/../app/views/footer.php"; ?>