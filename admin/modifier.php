<?php 
require_once 'check_admin.php';
require_once '../config/db.php';
include '../includes/header.php'; 

//ici on récupére le produit
$id = $_GET['id'] ?? null;
if (!$id) { header("Location: produits.php"); exit; }

$stmt = $pdo->prepare("SELECT * FROM items WHERE id = ?");
$stmt->execute([$id]);
$p = $stmt->fetch();

//la on traite le formulaire
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $stmt = $pdo->prepare("UPDATE items SET nom=?, description=?, prix=?, stock=? WHERE id=?");
    $stmt->execute([
        htmlspecialchars($_POST['nom']), 
        htmlspecialchars($_POST['description']), 
        $_POST['prix'], 
        $_POST['stock'], 
        $id
    ]);
    header("Location: produits.php?success=updated");
    exit();
}
?>

<div class="container mt-5">
    <div class="mb-4">
        <a href="produits.php" class="btn btn-outline-secondary">
            ← Retour à la liste
        </a>
    </div>

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow">
                <div class="card-header bg-warning text-dark">
                    <h4 class="mb-0">Modifier l'article : <?= htmlspecialchars($p['nom']) ?></h4>
                </div>
                <div class="card-body p-4">
                    <form method="POST">
                        <div class="mb-3">
                            <label class="form-label">Nom du produit</label>
                            <input type="text" name="nom" class="form-control" value="<?= htmlspecialchars($p['nom']) ?>" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Description</label>
                            <textarea name="description" class="form-control" rows="4" required><?= htmlspecialchars($p['description']) ?></textarea>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Prix (€)</label>
                                <input type="number" step="0.01" name="prix" class="form-control" value="<?= $p['prix'] ?>" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Stock</label>
                                <input type="number" name="stock" class="form-control" value="<?= $p['stock'] ?>" required>
                            </div>
                        </div>
                        <div class="d-grid gap-2 mt-4">
                            <button type="submit" class="btn btn-warning">Enregistrer les modifications</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include '../includes/footer.php'; ?>