<?php 
require_once 'check_admin.php'; 
require_once '../config/db.php'; 

//supprime un produit
if (isset($_GET['delete'])) {
    $id_item = $_GET['delete'];

    try {
        $pdo->beginTransaction();

        //ici c'est pour supprimer le stock associé au produit avant de supprimer le produit lui même
        $stmt1 = $pdo->prepare("DELETE FROM stock WHERE id_item = ?");
        $stmt1->execute([$id_item]);

        //la c'est pour supprimer le produit lui même
        $stmt2 = $pdo->prepare("DELETE FROM items WHERE id = ?");
        $stmt2->execute([$id_item]);

        $pdo->commit();
        
        //ici on redirige vers la même page avec un paramètre pour afficher un message de succès
        header("Location: produits.php?success=deleted");
        exit();

    } catch (Exception $e) {
        $pdo->rollBack();
        //si le produit est lié à une commande, on affiche un message d'erreur
        $error = "Erreur : Ce produit ne peut pas être supprimé car il est lié à une commande client.";
    }
}

//La c'est pour récupérer tous les produits de la base de données et les afficher dans un tableau
$items = $pdo->query("SELECT * FROM items")->fetchAll();

include '../includes/header.php'; 
?>

<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="fw-bold">📦 Gestion du Catalogue</h1>
        <a href="ajouter.php" class="btn btn-success shadow-sm">
            <i class="bi bi-plus-lg"></i> Ajouter un produit
        </a>
    </div>

    <?php if(isset($_GET['success'])): ?>
        <div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert">
            <i class="bi bi-check-circle-fill me-2"></i>
            <?php 
                //message différent selon l'action effectuée (ajout, suppression, modification)
                if ($_GET['success'] == 'deleted') echo "Le produit a bien été supprimé.";
                elseif ($_GET['success'] == 'added') echo "Le nouveau produit a été ajouté avec succès !";
                elseif ($_GET['success'] == 'updated') echo "Les modifications ont été enregistrées avec succès.";
            ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <?php if(isset($error)): ?>
        <div class="alert alert-danger shadow-sm alert-dismissible fade show">
            <i class="bi bi-exclamation-triangle-fill me-2"></i> <?= $error ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>

    <div class="card shadow border-0 overflow-hidden">
        <div class="card-body p-0">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-dark">
                    <tr>
                        <th class="ps-4">Aperçu</th>
                        <th>Nom du produit</th>
                        <th>Prix</th>
                        <th>Stock actuel</th>
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($items as $item): ?>
                    <tr>
                        <td class="ps-4">
                            <img src="../assets/img/<?= htmlspecialchars($item['image']) ?>" 
                                 class="rounded border shadow-sm" style="width: 50px; height: 50px; object-fit: cover;">
                        </td>
                        <td>
                            <div class="fw-bold text-dark"><?= htmlspecialchars($item['nom']) ?></div>
                            <small class="text-muted text-truncate d-block" style="max-width: 200px;">
                                <?= htmlspecialchars($item['description']) ?>
                            </small>
                        </td>
                        <td class="fw-bold"><?= number_format($item['prix'], 2) ?> €</td>
                        <td>
                            <span class="badge <?= $item['stock'] <= 5 ? 'bg-danger' : 'bg-secondary' ?>">
                                <?= $item['stock'] ?> unités
                            </span>
                        </td>
                        <td class="text-center">
                            <div class="btn-group" role="group">
                                <a href="modifier.php?id=<?= $item['id'] ?>" class="btn btn-sm btn-outline-warning">
                                    <i class="bi bi-pencil-square"></i>
                                </a>
                                <a href="produits.php?delete=<?= $item['id'] ?>" 
                                   class="btn btn-sm btn-outline-danger" 
                                   onclick="return confirm('Voulez-vous vraiment supprimer ce produit ?')">
                                    <i class="bi bi-trash"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-4">
        <a href="dashboard.php" class="btn btn-link text-secondary text-decoration-none">
            <i class="bi bi-arrow-left"></i> Retour au Tableau de bord
        </a>
    </div>
</div>

<?php include '../includes/footer.php'; ?>