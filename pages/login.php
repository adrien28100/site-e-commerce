<?php //la on démarre la session pour stocker les infos de l'utilisateur
session_start();
require_once '../config/db.php';
include '../includes/header.php';
//la c'est pour sécurisé les entrées
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = htmlspecialchars($_POST['email']);
    $password = $_POST['password'];
//ici on vérifie les infos de connexion
    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch();
//si les infos sont bonnes, on stocke l'id et le role de l'utilisateur en session
    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['role'] = $user['role'];
        $_SESSION['user_nom'] = $user['nom'];
        header("Location: ../index.php");
    } else { //si les infos sont pas bonnes, on affiche un message d'erreur
        echo "<div class='alert alert-danger'>Identifiants incorrects.</div>";
    }
} 
?>
<div class="container" style="max-width: 400px;">
    <h2 class="text-center">Connexion</h2>
    <form method="POST" class="border p-4 shadow-sm bg-light">
        <div class="mb-3">
            <label>Email</label>
            <input type="email" name="email" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Mot de passe</label>
            <input type="password" name="password" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary w-100">Se connecter</button>
    </form>
</div>