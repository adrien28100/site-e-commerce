<?php 
require_once 'check_admin.php'; // Vérifie que l'user est bien admin
require_once '../config/db.php'; 
include '../includes/header.php'; 

//récupère les informations clés pour le dashboard de l'admin
$nb_users = $pdo->query("SELECT COUNT(*) FROM users")->fetchColumn();
$nb_items = $pdo->query("SELECT COUNT(*) FROM items")->fetchColumn();
$nb_sales = $pdo->query("SELECT COUNT(*) FROM orders")->fetchColumn();
?>

<div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-5">
        <div>
            <h1 class="fw-bold">Tableau de Bord</h1>
            <p class="text-muted">Gestion administrative de la boutique</p>
        </div>
        <a href="../index.php" class="btn btn-outline-secondary">Retour au site</a>
    </div>

    <div class="row g-4">
        <div class="col-md-4">
            <div class="card border-0 shadow-sm h-100 bg-primary text-white">
                <div class="card-body p-4 text-center">
                    <i class="bi bi-people-fill display-4 mb-3"></i>
                    <h3><?= $nb_users ?></h3>
                    <p class="mb-0">Utilisateurs inscrits</p>
                    <a href="utilisateurs.php" class="btn btn-light btn-sm mt-3 stretched-link">Gérer les membres</a>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card border-0 shadow-sm h-100 bg-dark text-white border-warning" style="border-left: 5px solid #ffc107 !important;">
                <div class="card-body p-4 text-center">
                    <i class="bi bi-box-seam display-4 mb-3 text-warning"></i>
                    <h3><?= $nb_items ?></h3>
                    <p class="mb-0">Produits au catalogue</p>
                    <a href="produits.php" class="btn btn-warning btn-sm mt-3 stretched-link">Gérer les stocks</a>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card border-0 shadow-sm h-100 bg-success text-white">
                <div class="card-body p-4 text-center">
                    <i class="bi bi-cart-check-fill display-4 mb-3"></i>
                    <h3><?= $nb_sales ?></h3>
                    <p class="mb-0">Articles vendus (Total)</p>
                    <a href="historique_commandes.php" class="btn btn-light btn-sm mt-3 stretched-link">Voir les détails</a>
                </div>
            </div>
        </div>
    </div>

    <div class="mt-5 p-4 bg-white rounded shadow-sm">
        <h4 class="mb-4">Actions rapides</h4>
        <div class="d-flex gap-3 flex-wrap">
            <a href="ajouter.php" class="btn btn-success"><i class="bi bi-plus-circle"></i> Ajouter un produit</a>
            <a href="utilisateurs.php" class="btn btn-info text-white"><i class="bi bi-person-gear"></i> Gérer les rôles</a>
            <a href="historique_commandes.php" class="btn btn-secondary"><i class="bi bi-receipt"></i> Consulter les ventes</a>
        </div>
    </div>
</div>

<?php include '../includes/footer.php'; ?>