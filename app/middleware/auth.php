<?php
session_start();

require_once __DIR__ . "/../helpers/functions.php";

if (!is_logged_in()) {
    redirect("../public/login.php");
}

function require_role($role)
{
    if (!isset($_SESSION['role']) || $_SESSION['role'] !== $role) {
        die("Acceso denegado. No tienes permisos para entrar aquí.");
    }
}