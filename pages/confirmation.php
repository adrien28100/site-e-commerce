<?php 
session_start();
include '../includes/header.php'; 
?>

<div class="container my-5 text-center">
    <div class="row justify-content-center">
        <div class="col-md-7">
            <div class="mb-4">
                <svg xmlns="http://www.w3.org/2000/svg" width="80" height="80" fill="currentColor" class="bi bi-check-circle-fill text-success" viewBox="0 0 16 16">
                    <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
                </svg>
            </div>
            
            <h1 class="display-4 fw-bold">Commande Confirmée !</h1>
            <p class="lead mb-5">Merci pour votre achat. Votre commande a été enregistrée avec succès et est en cours de préparation.</p>

            <div class="d-grid gap-2 d-sm-flex justify-content-sm-center">
                <a href="catalogue.php" class="btn btn-primary btn-lg px-4 gap-3">Retourner à la boutique</a>
                <a href="../index.php" class="btn btn-outline-secondary btn-lg px-4">Accueil</a>
            </div>
        </div>
    </div>
</div>

<?php include '../includes/footer.php'; ?>