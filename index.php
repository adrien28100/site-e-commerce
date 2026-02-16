<?php 
session_start();
include 'includes/header.php';
?>

<header class="bg-dark text-white py-5 mb-5 shadow" style="background: linear-gradient(rgba(0,0,0,0.6), rgba(0,0,0,0.6)), url('assets/img/hero_bg.jpg') center/cover;">
    <div class="container py-5 text-center">
        <h1 class="display-3 fw-bold mb-3">Vivez l'expérience The Boutique</h1>
        <p class="lead mb-4">Découvrez nos collections exclusives et profitez d'une qualité exceptionnelle surtout chez les abribus.</p>
        <div class="d-grid gap-2 d-sm-flex justify-content-sm-center">
            <a href="pages/catalogue.php" class="btn btn-warning btn-lg px-4 me-sm-3 fw-bold text-dark">Voir le catalogue</a>
            <?php if(!isset($_SESSION['user_id'])): ?>
                <a href="pages/register.php" class="btn btn-outline-light btn-lg px-4">Créer un compte</a>
            <?php endif; ?>
        </div>
    </div>
</header>

<div class="container my-5">
    <div class="row text-center g-4">
        <div class="col-md-4">
            <div class="p-4 border-0 card h-100 shadow-sm">
                <i class="bi bi-truck display-4 text-primary mb-3"></i>
                <h4 class="fw-bold">Livraison Rapide</h4>
                <p class="text-muted">Partout en France sous 48h, directement chez vous.</p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="p-4 border-0 card h-100 shadow-sm">
                <i class="bi bi-shield-check display-4 text-success mb-3"></i>
                <h4 class="fw-bold">Paiement Sécurisé</h4>
                <p class="text-muted">Vos transactions sont protégées par nos protocoles de sécurité.</p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="p-4 border-0 card h-100 shadow-sm">
                <i class="bi bi-arrow-repeat display-4 text-info mb-3"></i>
                <h4 class="fw-bold">Retours Gratuits</h4>
                <p class="text-muted">Satisfait ou remboursé sous 30 jours sans conditions.</p>
            </div>
        </div>
    </div>
</div>

<div class="container text-center py-5">
    <h2 class="fw-bold mb-4">Prêt à commencer vos achats ?</h2>
    <p class="text-muted mb-4">Rejoignez nos 3 de clients satisfaits.</p>
    <a href="pages/catalogue.php" class="btn btn-dark btn-lg px-5 shadow">Accéder à la boutique</a>
</div>

<?php include 'includes/footer.php'; ?>