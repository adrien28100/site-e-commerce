<?php 
require_once '../config/db.php'; 
include '../includes/header.php'; 
//on récupère l'id du produit
$id = $_GET['id'] ?? null;
if (!$id) { header("Location: catalogue.php"); exit; }
//ici on récupère les détails du produit depuis la base de données
$stmt = $pdo->prepare("SELECT * FROM items WHERE id = ?");
$stmt->execute([$id]);
$p = $stmt->fetch();
?>
<div class="container my-5">
    <div class="row">
        <div class="col-md-6">
            <img src="../assets/img/<?= $p['image'] ?>" class="img-fluid rounded" alt="<?= $p['nom'] ?>">
        </div>
        <div class="col-md-6">
            <div class="mb-3">
    <a href="javascript:history.back()" class="btn btn-outline-secondary">
        <i class="bi bi-arrow-left"></i> ← Retour
    </a>
</div>
            <h1><?= $p['nom'] ?></h1>
            <p class="text-muted">Publié le <?= $p['date_publication'] ?></p>
            <h3 class="text-primary"><?= $p['prix'] ?> €</h3>
            <p><?= $p['description'] ?></p>
            <p><strong>Stock disponible :</strong> <?= $p['stock'] ?></p>
                <input type="hidden" name="id" value="<?= $p['id'] ?>">
                <form action="ajouter_panier.php" method="POST" class="mt-3">
                <input type="hidden" name="id" value="<?= $p['id'] ?>">
                    <div class="mb-3" style="max-width: 200px;">
                         <label class="form-label">Quantité :</label>
                        <input type="number" name="quantite" class="form-control" value="1" min="1" max="<?= $p['stock'] ?>">
                    </div>
    <button type="submit" class="btn btn-success btn-lg w-100">Ajouter au panier</button>
</form>
            </form>
        </div>
    </div>
</div>
<?php include '../includes/footer.php'; ?>