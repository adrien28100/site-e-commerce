<?php 
require_once 'check_admin.php'; 
require_once '../config/db.php'; 
include '../includes/header.php'; 

//ici on récupère le nom de l'utilisateur, le nom du produit et le prix
$query = "SELECT orders.id, users.nom AS client, items.nom AS produit, items.prix 
          FROM orders 
          JOIN users ON orders.id_user = users.id 
          JOIN items ON orders.id_item = items.id 
          ORDER BY orders.id DESC";
$commandes = $pdo->query($query)->fetchAll();
?>

<div class="container-fluid px-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="mt-4">Historique des Ventes</h1>
        <a href="dashboard.php" class="btn btn-secondary">← Retour Dashboard</a>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header bg-warning text-dark fw-bold">
            🛒 Détails des articles vendus
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th>ID Commande</th>
                            <th>Client</th>
                            <th>Produit acheté</th>
                            <th>Prix de vente</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($commandes as $c): ?>
                        <tr>
                            <td>#<?= $c['id'] ?></td>
                            <td><span class="badge bg-info text-dark"><?= htmlspecialchars($c['client']) ?></span></td>
                            <td><strong><?= htmlspecialchars($c['produit']) ?></strong></td>
                            <td class="text-success fw-bold"><?= number_format($c['prix'], 2) ?> €</td>
                        </tr>
                        <?php endforeach; ?>
                        <?php if (empty($commandes)): ?>
                            <tr><td colspan="4" class="text-center">Aucune vente enregistrée pour le moment.</td></tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php include '../includes/footer.php'; ?>