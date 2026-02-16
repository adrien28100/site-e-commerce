<?php 
require_once 'check_admin.php'; 
require_once '../config/db.php';
include '../includes/header.php'; 
//traitement du formulaire d'ajout de produit
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nom = htmlspecialchars($_POST['nom']);
    $desc = htmlspecialchars($_POST['description']);
    $prix = $_POST['prix'];
    $stock = $_POST['stock'];
    $image = htmlspecialchars($_POST['image']);

    //insertion dans items
    $stmt = $pdo->prepare("INSERT INTO items (nom, description, prix, stock, image) VALUES (?, ?, ?, ?, ?)");
    $stmt->execute([$nom, $desc, $prix, $stock, $image]);
    
    //mise à jour de la table stock
    $id_item = $pdo->lastInsertId();
    $stmt_stock = $pdo->prepare("INSERT INTO stock (id_item, quantite_item_en_stock) VALUES (?, ?)");
    $stmt_stock->execute([$id_item, $stock]);

    header("Location: produits.php?success=added");
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
            <div class="card shadow border-0">
                <div class="card-header bg-success text-white">
                    <h4 class="mb-0">Ajouter un nouveau produit</h4>
                </div>
                <div class="card-body p-4">
                    <form method="POST">
                        <div class="mb-3">
                            <label class="form-label">Nom du produit</label>
                            <input type="text" name="nom" class="form-control" placeholder="Ex: T-shirt Vintage" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Description</label>
                            <textarea name="description" class="form-control" rows="3" placeholder="Décrivez le produit..."></textarea>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Prix (€)</label>
                                <input type="number" step="0.01" name="prix" class="form-control" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Stock initial</label>
                                <input type="number" name="stock" class="form-control" required>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Nom du fichier image</label>
                            <input type="text" name="image" class="form-control" placeholder="image.jpg (doit être dans assets/img/)">
                        </div>
                        <div class="d-grid gap-2 mt-4">
                            <button type="submit" class="btn btn-success text-white">Ajouter au catalogue</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include '../includes/footer.php'; ?>