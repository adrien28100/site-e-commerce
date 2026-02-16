<?php 
require_once '../config/db.php'; 
include '../includes/header.php'; 

// On récupère les items de la table créée dans TablePlus
$requete = $pdo->query("SELECT * FROM items");
$produits = $requete->fetchAll();
?>

<div class="container">
    <h1 class="mb-4">Notre Catalogue</h1>
    <div class="row">
        <?php foreach ($produits as $p): ?>
            <div class="col-md-4 mb-4">
                <div class="card h-100">
                    <img src="../assets/img/<?= $p['image'] ?>" class="card-img-top" alt="<?= $p['nom'] ?>">
                    <div class="card-body">
                        <h5 class="card-title"><?= $p['nom'] ?></h5>
                        <p class="card-text text-muted"><?= substr($p['description'], 0, 50) ?>...</p>
                        <p class="fw-bold"><?= $p['prix'] ?> €</p>
                        <a href="produit-detail.php?id=<?= $p['id'] ?>" class="btn btn-primary w-100">Voir le produit</a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<?php include '../includes/footer.php'; ?>