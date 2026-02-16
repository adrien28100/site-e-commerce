<?php
session_start();
require_once '../config/db.php';

if (!empty($_SESSION['panier'])) {
    foreach ($_SESSION['panier'] as $id => $quantite) {
        // On rend les articles au stock dans la base de données
        $stmt = $pdo->prepare("UPDATE items SET stock = stock + ? WHERE id = ?");
        $stmt->execute([$quantite, $id]);
    }
    // Une fois le stock rendu, on vide la session
    unset($_SESSION['panier']);
}

header("Location: panier.php");
exit();