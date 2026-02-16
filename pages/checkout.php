<?php 
session_start();
include '../includes/header.php'; 
// On vérifie que le panier n'est pas vide
if(empty($_SESSION['panier'])) { header("Location: catalogue.php"); exit; }
?>

<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-primary text-white py-3">
                    <h5 class="mb-0">📍 Informations de facturation</h5>
                </div>
                <div class="card-body p-4 bg-white">
                    <form action="valider_commande.php" method="POST">
                        <div class="mb-3">
                            <label class="form-label text-dark">Adresse complète</label>
                            <input type="text" name="adresse" class="form-control border-secondary" placeholder="123 rue de la Paix" required>
                        </div>
                        <div class="row">
                            <div class="col-md-8 mb-3">
                                <label class="form-label text-dark">Ville</label>
                                <input type="text" name="ville" class="form-control border-secondary" placeholder="Paris" required>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="form-label text-dark">Code Postal</label>
                                <input type="text" name="code_postal" class="form-control border-secondary" placeholder="75001" required>
                            </div>
                        </div>
                        <hr>
                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-success btn-lg">Finaliser ma commande</button>
                            <a href="panier.php" class="btn btn-outline-secondary">Retour au panier</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include '../includes/footer.php'; ?>