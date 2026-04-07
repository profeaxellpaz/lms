<?php

try {
    $pdo = new PDO("sqlite:" . __DIR__ . "/../../../database/lms.sqlite");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Error de conexión: " . $e->getMessage());
}