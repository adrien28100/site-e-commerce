<?php
session_start();
require_once '../config/db.php';

// Ici on accepte POST (depuis la fiche produit) ou GET (depuis le catalogue direct)
$id = $_POST['id'] ?? $_GET['id'] ?? null;
$quantite_voulue = intval($_POST['quantite'] ?? 1);

if ($id) {
    // La on vérifie s'il y a du stock disponible 
    $check = $pdo->prepare("SELECT stock FROM items WHERE id = ?");
    $check->execute([$id]);
    $produit = $check->fetch();

    if ($produit && $produit['stock'] >= $quantite_voulue) {
        // Mise à jour du stock : on retire la quantité voulue 
        $update = $pdo->prepare("UPDATE items SET stock = stock - ? WHERE id = ?");
        $update->execute([$quantite_voulue, $id]);

        // Mise à jour de la session panier on ajoute le produit au panier
        if (!isset($_SESSION['panier'])) { $_SESSION['panier'] = []; }
        
        if (isset($_SESSION['panier'][$id])) {
            $_SESSION['panier'][$id] += $quantite_voulue;
        } else {
            $_SESSION['panier'][$id] = $quantite_voulue;
        }
    }
}
header("Location: panier.php");
exit();