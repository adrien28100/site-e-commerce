<?php 
// 1. Sécurité : Vérifie que l'utilisateur est bien admin
require_once 'check_admin.php'; 

// 2. Connexion à la base de données
require_once '../config/db.php'; 

// 3. LOGIQUE DE SUPPRESSION (Doit être placée avant l'affichage)
if (isset($_GET['delete'])) {
    $id_item = $_GET['delete'];

    try {
        // Début de la transaction pour garantir que tout est supprimé ou rien du tout
        $pdo->beginTransaction();

        // Étape A : On supprime la ligne liée dans la table 'stock'
        $stmt1 = $pdo->prepare("DELETE FROM stock WHERE id_item = ?");
        $stmt1->execute([$id_item]);

        // Étape B : On supprime le produit lui-même dans la table 'items'
        $stmt2 = $pdo->prepare("DELETE FROM items WHERE id = ?");
        $stmt2->execute([$id_item]);

        $pdo->commit();
        
        // Redirection avec un message de succès
        header("Location: produits.php?success=deleted");
        exit();

    } catch (Exception $e) {
        // En cas d'erreur (ex: le produit est dans la table 'orders'), on annule tout
        $pdo->rollBack();
        $error = "Impossible de supprimer : ce produit est lié à une commande existante.";
    }
}

// 4. Récupération de la liste des produits pour le tableau
$items = $pdo->query("SELECT * FROM items")->fetchAll();

include '../includes/header.php'; 
?>

<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>📦 Gestion du Catalogue</h1>
        <a href="ajouter.php" class="btn btn-success">+ Ajouter un produit</a>
    </div>

    <?php if(isset($_GET['success'])): ?>
        <div class="alert alert-success">Le produit a bien été supprimé.</div>
    <?php endif; ?>
    <?php if(isset($error)): ?>
        <div class="alert alert-danger"><?= $error ?></div>
    <?php endif; ?>

    <div class="card shadow border-0">
        <div class="card-body p-0">
            <table class="table table-hover mb-0">
                <thead class="table-dark">
                    <tr>
                        <th class="ps-4">Image</th>
                        <th>Nom</th>
                        <th>Prix</th>
                        <th>Stock</th>
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($items as $item): ?>
                    <tr class="align-middle">
                        <td class="ps-4">
                            <img src="../assets/img/<?= htmlspecialchars($item['image']) ?>" 
                                 alt="" class="rounded border" style="width: 50px; height: 50px; object-fit: cover;">
                        </td>
                        <td><strong><?= htmlspecialchars($item['nom']) ?></strong></td>
                        <td><?= number_format($item['prix'], 2) ?> €</td>
                        <td>
                            <span class="badge <?= $item['stock'] <= 0 ? 'bg-danger' : 'bg-secondary' ?>">
                                <?= $item['stock'] ?> en stock
                            </span>
                        </td>
                        <td class="text-center">
                            <a href="modifier.php?id=<?= $item['id'] ?>" class="btn btn-sm btn-warning">Modifier</a>
                            <a href="produits.php?delete=<?= $item['id'] ?>" 
                               class="btn btn-sm btn-danger" 
                               onclick="return confirm('Voulez-vous vraiment supprimer ce produit et son stock ?')">
                                Supprimer
                            </a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
    
    <div class="mt-4">
        <a href="dashboard.php" class="btn btn-outline-secondary">← Retour au Dashboard</a>
    </div>
</div>

<?php include '../includes/footer.php'; ?>