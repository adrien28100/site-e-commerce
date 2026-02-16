<?php
session_start();
require_once '../config/db.php'; //on vérifie que le panier n'est pas vide
//si le panier est vide on redirige vers le catalogue
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $adresse = htmlspecialchars($_POST['adresse']);
    $ville = htmlspecialchars($_POST['ville']);
    $cp = htmlspecialchars($_POST['code_postal']);
    $user_id = $_SESSION['user_id'];

    try {
        $pdo->beginTransaction();

        //calcul du total
        $total = 0;
        foreach ($_SESSION['panier'] as $id => $qte) {
            $s = $pdo->prepare("SELECT prix FROM items WHERE id = ?");
            $s->execute([$id]);
            $total += $s->fetchColumn() * $qte;
        }

        //insertion dans invoice avec l'adresse, la ville, le code postal et le montant total
        $sql = "INSERT INTO invoice (id_user, montant, adresse_facturation, ville, code_postal, date_transaction) 
        VALUES (?, ?, ?, ?, ?, NOW())";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$user_id, $total, $_POST['adresse'], $_POST['ville'], $_POST['code_postal']]);
        
        $id_facture = $pdo->lastInsertId();

        //remplissage de la table orders
        foreach ($_SESSION['panier'] as $id_item => $quantite) {
            for ($i = 0; $i < $quantite; $i++) {
                $stmtOrd = $pdo->prepare("INSERT INTO orders (id_user, id_item) VALUES (?, ?)");
                $stmtOrd->execute([$user_id, $id_item]);
            }
        }

        $pdo->commit(); //si tout s'est bien passé on valide la commande
        unset($_SESSION['panier']);
        header("Location: confirmation.php");
        exit();

    } catch (Exception $e) {
        $pdo->rollBack();
        die("Erreur : " . $e->getMessage());
    }
}