<?php
if (session_status() === PHP_SESSION_NONE) { session_start(); }

//vérifie si l'utilisateur est connecté et s'il est admin
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../pages/login.php?error=access_denied");
    exit();
}
?>