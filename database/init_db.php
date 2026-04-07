<?php

$dbPath = __DIR__ . "/lms.sqlite";

try {
    $pdo = new PDO("sqlite:" . $dbPath);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $pdo->exec("DROP TABLE IF EXISTS users");

    $pdo->exec("
        CREATE TABLE users (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            name TEXT NOT NULL,
            username TEXT NOT NULL UNIQUE,
            email TEXT NOT NULL UNIQUE,
            password_hash TEXT NOT NULL,
            role TEXT NOT NULL DEFAULT 'student',
            status TEXT NOT NULL DEFAULT 'active',
            created_at TEXT DEFAULT CURRENT_TIMESTAMP
        )
    ");

    $users = [
        [
            "name" => "Administrador Principal",
            "username" => "admin",
            "email" => "admin@lms.com",
            "password" => "Admin123*",
            "role" => "admin"
        ],
        [
            "name" => "Profesor Demo",
            "username" => "teacher",
            "email" => "teacher@lms.com",
            "password" => "Teacher123*",
            "role" => "teacher"
        ],
        [
            "name" => "Estudiante Demo",
            "username" => "student",
            "email" => "student@lms.com",
            "password" => "Student123*",
            "role" => "student"
        ]
    ];

    $stmt = $pdo->prepare("
        INSERT INTO users (name, username, email, password_hash, role, status)
        VALUES (:name, :username, :email, :password_hash, :role, 'active')
    ");

    foreach ($users as $u) {
        $stmt->execute([
            "name" => $u["name"],
            "username" => $u["username"],
            "email" => $u["email"],
            "password_hash" => password_hash($u["password"], PASSWORD_DEFAULT),
            "role" => $u["role"]
        ]);
    }

    echo "Base de datos creada correctamente: lms.sqlite\n";
    echo "Usuarios creados:\n";
    echo "- admin / Admin123*\n";
    echo "- teacher / Teacher123*\n";
    echo "- student / Student123*\n";

} catch (PDOException $e) {
    die("Error: " . $e->getMessage());
}