<?php 
if (session_status() === PHP_SESSION_NONE) { session_start(); } 
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>The Boutique</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <style>
        .navbar { border-bottom: 2px solid #ffc107; }
        .card-img-top { height: 200px; object-fit: contain; background: #f8f9fa; }
        .btn-admin-custom {
            color: #ffc107 !important;
            font-weight: bold;
            border: 1px solid #ffc107;
            padding: 5px 15px;
            border-radius: 5px;
            transition: 0.3s;
        }
        .btn-admin-custom:hover {
            background-color: #ffc107;
            color: #000 !important;
        }
    </style>
</head>
<body class="bg-light">
<nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm">
    <div class="container">
        <a class="navbar-brand fw-bold" href="/projet_php/index.php">🛍️ The Boutique</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto align-items-center">
                <li class="nav-item"><a class="nav-link" href="/projet_php/pages/catalogue.php">Produits</a></li>
                <li class="nav-item"><a class="nav-link" href="/projet_php/pages/panier.php">Panier <i class="bi bi-cart3"></i></a></li>
                
                <?php if(isset($_SESSION['user_id'])): ?>
                    <li class="nav-item">
                        <span class="nav-link text-info small">Bonjour, <strong><?= htmlspecialchars($_SESSION['user_nom'] ?? 'Utilisateur') ?></strong></span>
                    </li>
                    
                    <?php if(isset($_SESSION['role']) && $_SESSION['role'] === 'admin'): ?>
                        <li class="nav-item ms-lg-2">
                            <a class="nav-link btn-admin-custom" href="/projet_php/admin/dashboard.php">
                                <i class="bi bi-gear-fill"></i> ADMIN
                            </a>
                        </li>
                    <?php endif; ?>
                    
                    <li class="nav-item ms-lg-3">
                        <a class="nav-link btn btn-outline-danger btn-sm" href="/projet_php/pages/logout.php">Déconnexion</a>
                    </li>
                <?php else: ?>
                    <li class="nav-item"><a class="nav-link" href="/projet_php/pages/login.php">Connexion</a></li>
                    <li class="nav-item"><a class="nav-link btn btn-primary btn-sm ms-lg-2" href="/projet_php/pages/register.php">S'inscrire</a></li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>