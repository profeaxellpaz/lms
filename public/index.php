<?php
session_start();

if (!isset($_SESSION["role"])) {
    header("Location: login.php");
    exit();
}

if ($_SESSION["role"] === "admin") {
    header("Location: ../admin/dashboard.php");
    exit();
}

if ($_SESSION["role"] === "teacher") {
    header("Location: ../teacher/dashboard.php");
    exit();
}

header("Location: ../student/dashboard.php");
exit();