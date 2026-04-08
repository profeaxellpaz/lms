<?php
require_once __DIR__ . "/../../app/middleware/auth.php";
require_role("admin");

require_once __DIR__ . "/../../app/config/database.php";
require_once __DIR__ . "/../../app/views/header.php";

// Crear matrícula
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $student_id = (int) ($_POST["student_id"] ?? 0);
    $course_id  = (int) ($_POST["course_id"] ?? 0);

    if ($student_id > 0 && $course_id > 0) {
        $stmt = $pdo->prepare("INSERT IGNORE INTO enrollments (student_id, course_id) VALUES (?, ?)");
        $stmt->execute([$student_id, $course_id]);
        $message = "Estudiante matriculado correctamente.";
    } else {
        $message = "Debe seleccionar estudiante y curso.";
    }
}

// Eliminar matrícula
if (isset($_GET["delete"])) {
    $delete_id = (int) $_GET["delete"];
    $stmt = $pdo->prepare("DELETE FROM enrollments WHERE id = ?");
    $stmt->execute([$delete_id]);
    header("Location: enrollments.php");
    exit;
}

// Obtener estudiantes
$students = $pdo->query("SELECT id, name, email FROM users WHERE role='student' AND status='active' ORDER BY name")->fetchAll();

// Obtener cursos
$courses = $pdo->query("SELECT id, title FROM courses ORDER BY title")->fetchAll();

// Obtener matrículas
$enrollments = $pdo->query("
    SELECT e.id, u.name AS student_name, c.title AS course_title, e.enrolled_at
    FROM enrollments e
    INNER JOIN users u ON e.student_id = u.id
    INNER JOIN courses c ON e.course_id = c.id
    ORDER BY e.enrolled_at DESC
")->fetchAll();
?>

<div class="container mt-4">
    <h2>📚 Matrículas (Enrollments)</h2>

    <?php if (!empty($message)): ?>
        <div class="alert alert-info"><?= htmlspecialchars($message) ?></div>
    <?php endif; ?>

    <div class="card p-3 mb-4">
        <h4>Matricular estudiante</h4>

        <form method="POST">
            <div class="mb-3">
                <label class="form-label">Estudiante</label>
                <select name="student_id" class="form-select" required>
                    <option value="">-- Seleccione estudiante --</option>
                    <?php foreach ($students as $s): ?>
                        <option value="<?= $s["id"] ?>">
                            <?= htmlspecialchars($s["name"]) ?> (<?= htmlspecialchars($s["email"]) ?>)
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Curso</label>
                <select name="course_id" class="form-select" required>
                    <option value="">-- Seleccione curso --</option>
                    <?php foreach ($courses as $c): ?>
                        <option value="<?= $c["id"] ?>">
                            <?= htmlspecialchars($c["title"]) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <button class="btn btn-primary">Matricular</button>
        </form>
    </div>

    <h4>Lista de matrículas</h4>

    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Estudiante</th>
                <th>Curso</th>
                <th>Fecha</th>
                <th>Acción</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($enrollments as $e): ?>
                <tr>
                    <td><?= $e["id"] ?></td>
                    <td><?= htmlspecialchars($e["student_name"]) ?></td>
                    <td><?= htmlspecialchars($e["course_title"]) ?></td>
                    <td><?= $e["enrolled_at"] ?></td>
                    <td>
                        <a href="enrollments.php?delete=<?= $e["id"] ?>"
                           class="btn btn-danger btn-sm"
                           onclick="return confirm('¿Seguro que deseas eliminar esta matrícula?');">
                           Eliminar
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php require_once __DIR__ . "/../../app/views/footer.php"; ?>