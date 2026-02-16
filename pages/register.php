<?php 
session_start();
require_once '../config/db.php';
include '../includes/header.php';
//ici on traite le formulaire d'inscription
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nom = htmlspecialchars($_POST['nom']);
    $email = htmlspecialchars($_POST['email']);
    $pass = password_hash($_POST['password'], PASSWORD_DEFAULT);
//ici on insère le nouvel utilisateur dans la base de données
    $stmt = $pdo->prepare("INSERT INTO users (nom, email, password, role) VALUES (?, ?, ?, 'user')");
    
    try {
        $stmt->execute([$nom, $email, $pass]);
        
        //connexion automatique après inscription
        $new_user_id = $pdo->lastInsertId(); // On récupère l'ID créé
        $_SESSION['user_id'] = $new_user_id;
        $_SESSION['user_nom'] = $nom;
        $_SESSION['role'] = 'user';
        
        header("Location: ../index.php?success=welcome");
        exit();
    } catch (Exception $e) {
        echo "<div class='alert alert-danger'>Erreur : Email déjà utilisé.</div>";
    }
}
?>

<div class="container" style="max-width: 500px;">
    <h2 class="text-center">Inscription</h2>
    <form method="POST" class="border p-4 shadow-sm bg-light">
        <div class="mb-3">
            <label>Nom complet</label>
            <input type="text" name="nom" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Email</label>
            <input type="email" name="email" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Mot de passe</label>
            <input type="password" name="password" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-success w-100">Créer mon compte</button>
    </form>
</div>