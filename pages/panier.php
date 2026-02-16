<?php
session_start();
require_once '../config/db.php';
include '../includes/header.php'; 

$total_panier = 0;
?>
<div class="container my-5">
    <div class="mb-3">
    <a href="javascript:history.back()" class="btn btn-outline-secondary">
        <i class="bi bi-arrow-left"></i> ← Retour
    </a>
</div>
    <h2>Votre Panier</h2>
    <table class="table table-bordered mt-4">
        <thead class="table-light">
            <tr>
                <th>Produit</th>
                <th>Prix Unitaire</th>
                <th>Quantité</th>
                <th>Sous-total</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($_SESSION['panier'])): ?>
                <?php foreach ($_SESSION['panier'] as $id => $quantite): 
                    $stmt = $pdo->prepare("SELECT nom, prix FROM items WHERE id = ?");
                    $stmt->execute([$id]);
                    $item = $stmt->fetch();
                    
                    if ($item) {
                        $sous_total = $item['prix'] * $quantite;
                        $total_panier += $sous_total;
                ?>
                <tr>
                    <td><?= htmlspecialchars($item['nom']) ?></td>
                    <td><?= number_format($item['prix'], 2) ?> €</td>
                    <td><?= $quantite ?></td>
                    <td><?= number_format($sous_total, 2) ?> €</td>
                </tr>
                <?php } endforeach; ?>
            <?php else: ?>
                <tr><td colspan="4" class="text-center">Votre panier est vide.</td></tr>
            <?php endif; ?>
        </tbody>
    </table>
    <div class="text-end">
        <h3>Total : <?= number_format($total_panier, 2) ?> €</h3>
        <a href="catalogue.php" class="btn btn-secondary">Continuer mes achats</a>
        <a href="vider_panier.php" class="btn btn-danger" onclick="return confirm('Voulez-vous vraiment annuler et vider votre panier ?')">
            Annuler la commande</a>
        <a href="checkout.php" class="btn btn-success btn-lg shadow">Payer la comande</a>
    </div>
</div>
<?php include '../includes/footer.php'; ?>