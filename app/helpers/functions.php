<?php

function redirect($url)
{
    header("Location: $url");
    exit();
}

function is_logged_in()
{
    return isset($_SESSION['user_id']);
}

function current_role()
{
    return $_SESSION['role'] ?? null;
}