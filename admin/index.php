<?php
session_start();
require_once '../config/db.php';
//on vérifie que l'utilisateur est admin avant d'afficher la page
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ? AND role = 'admin'");
    $stmt->execute([$email]);
    $admin = $stmt->fetch();

    if ($admin && password_verify($password, $admin['password'])) {
        $_SESSION['admin'] = $admin['id'];
        header("Location: dashboard.php");
    } else {
        $error = "Accès refusé ou identifiants incorrects.";
    }
}
?>