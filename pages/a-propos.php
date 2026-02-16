<?php 
session_start();
include '../includes/header.php'; 
?>

<div class="container my-5">
    <div class="row align-items-center">
        <div class="col-md-6">
            <h1 class="display-4 fw-bold text-dark">Qui sommes-nous ?</h1>
            <p class="lead">Bienvenue chez <strong>Vous</strong> Non faut pas abuse</p>
            <p>Le site qui peut vous vendre un t-shirt jusqu'à un jet privé</p>
            <div class="mt-4">
                <a href="catalogue.php" class="btn btn-primary">Découvrir nos produits</a>
            </div>
        </div>
        <div class="col-md-6 text-center">
            <img src="../assets/img/team.jpg" alt="Notre équipe" class="img-fluid rounded shadow-lg" onerror="this.src='">
        </div>
    </div>

    <hr class="my-5">

    <div class="row text-center">
        <div class="col-md-4">
            <h3 class="h5 fw-bold">Notre Vision</h3>
            <p class="text-muted">Faire un maximum d'argent.</p>
        </div>
        <div class="col-md-4">
            <h3 class="h5 fw-bold">Nos Valeurs</h3>
            <p class="text-muted">Scam les gens.</p>
        </div>
        <div class="col-md-4">
            <h3 class="h5 fw-bold">Engagement</h3>
            <p class="text-muted">Aucun c'est pas un mariage.</p>
        </div>
    </div>
</div>

<?php include '../includes/footer.php'; ?>