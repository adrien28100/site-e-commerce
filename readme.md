Projet E-Commerce Dynamique en PHP

Bachelor 2 - Projet de fin de module Date limite de rendu : 15 février 2026 

Présentation du projet
Ce site est une plateforme e-commerce dynamique développée en PHP utilisant une base de données SQL. Il permet aux utilisateurs de consulter un catalogue de produits, de gérer un panier et de s'authentifier de manière sécurisée. Un espace d'administration (Back-office) est également présent pour gérer les stocks et les articles (opérations CRUD).

Guide d'installation étape par étape
1. Prérequis : Installer le serveur local
Le projet nécessite un environnement serveur local pour fonctionner (Apache et MySQL).

Téléchargez et installez XAMPP (version pour Windows) depuis le site officiel.

Lors de l'installation, assurez-vous que les composants Apache, MySQL et PHP sont cochés.

2. Mise en place des fichiers
Allez dans le dossier d'installation de XAMPP (généralement C:\xampp\).

Ouvrez le dossier nommé htdocs.

Copiez votre dossier projet_php à l'intérieur de htdocs.

Note : Le chemin final doit être : xampp\htdocs\projet_php\index.php.

3. Démarrage des services
Ouvrez le XAMPP Control Panel.

Cliquez sur le bouton "Start" en face de Apache.

Cliquez sur le bouton "Start" en face de MySQL.

Les deux noms doivent devenir verts.

4. Configuration de la base de données
Le site repose sur une structure SQL de 5 tables : users, items, orders, invoice, et stock.

Ouvrez TablePlus ou phpMyAdmin.

Créez une nouvelle base de données nommée projet php.

Importez le fichier database.sql situé à la racine du projet pour créer automatiquement toutes les tables et les relations.

Comment lancer le site ?
Une fois les services démarrés et la base de données prête :

Ouvrez votre navigateur (Chrome, Firefox, etc.).

Dans la barre d'adresse, tapez : http://localhost/projet_php/index.php.

Vous arrivez sur la page d'accueil présentant les produits en avant.

Comment ça marche ? (Logique technique)
Le projet est divisé en deux parties distinctes pour assurer une séparation claire des responsabilités:

Le Front-office (Utilisateurs)

Catalogue : Les produits sont récupérés dynamiquement dans la table items et affichés sous forme de cartes.


Sécurité : L'inscription et la connexion utilisent password_hash pour protéger les mots de passe et des requêtes préparées pour éviter les injections SQL.


Panier : Géré via les sessions PHP pour permettre l'ajout et la suppression d'articles avant commande.

Le Back-office (Administration)
Espace réservé accessible via une authentification admin spécifique.


CRUD Produits : Permet d'ajouter (Create), lire (Read), modifier (Update) et supprimer (Delete) des articles directement depuis l'interface sans toucher à la base de données.


Gestion Users : Permet de visualiser la liste des inscrits et de supprimer un compte si nécessaire.

Technologies utilisées

Back-end : PHP avec PDO pour la gestion sécurisée de la base de données MySQL.


Front-end : HTML5, CSS, Bootstrap (pour un design esthétique et responsive).


Base de données : MySQL