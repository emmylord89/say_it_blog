<?php
// auth.php
session_start();

function is_logged_in() {
    return isset($_SESSION['user_id']);
}

function is_admin() {
    return isset($_SESSION['user_id']) && $_SESSION['role'] == 'admin';
}

function redirect_if_not_logged_in() {
    if (!is_logged_in()) {
        header("Location: login.html");
        exit();
    }
}

function redirect_if_not_admin() {
    if (!is_admin()) {
        header("Location: admin_login.html");
        exit();
    }
}
?>
