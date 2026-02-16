<?php 
require_once 'check_admin.php'; //sécurité
require_once '../config/db.php'; //connexion
include '../includes/header.php'; 

//suppression d'un utilisateur
if (isset($_GET['delete'])) {
    $id_to_delete = $_GET['delete'];
    //on empêche l'utilisateur de se supprimer soi-même
    if ($id_to_delete != $_SESSION['user_id']) {
        $stmt = $pdo->prepare("DELETE FROM users WHERE id = ?");
        $stmt->execute([$id_to_delete]);
        header("Location: utilisateurs.php?success=deleted");
    }
}

$users = $pdo->query("SELECT * FROM users")->fetchAll();
?>

<div class="container-fluid px-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="mt-4">Gestion des Utilisateurs</h1>
        <a href="dashboard.php" class="btn btn-secondary">Retour au Dashboard</a>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header bg-dark text-white">
            <i class="bi bi-people-fill"></i> Liste des membres inscrits
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover table-striped">
                    <thead class="table-light">
                        <tr>
                            <th>ID</th>
                            <th>Nom</th>
                            <th>Email</th>
                            <th>Rôle</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($users as $u): ?>
                        <tr>
                            <td><?= $u['id'] ?></td>
                            <td><strong><?= htmlspecialchars($u['nom']) ?></strong></td>
                            <td><?= htmlspecialchars($u['email']) ?></td>
                            <td>
                                <span class="badge <?= $u['role'] === 'admin' ? 'bg-danger' : 'bg-primary' ?>">
                                    <?= strtoupper($u['role']) ?>
                                </span>
                            </td>
                            <td>
                                <?php if ($u['id'] != $_SESSION['user_id']): ?>
                                    <a href="?delete=<?= $u['id'] ?>" class="btn btn-sm btn-outline-danger" onclick="return confirm('Supprimer cet utilisateur ?')">
                                        Supprimer
                                    </a>
                                <?php else: ?>
                                    <small class="text-muted">C'est vous</small>
                                <?php endif; ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php include '../includes/footer.php'; ?>