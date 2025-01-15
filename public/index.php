<?php
require_once '../autoload.php';
require_once '../config/config.php';
// require_once '../classes/Utils/Classe-Page-manager.php';

// Définir les propriétés pour cette page
PageManager::setTitle("Accueil");
PageManager::setDescription("Udemy est le meuilleure endroit d'apprentissage en ligne");
?>

<?php include '../includes/header.php'; ?>

<h1>Index Page</h1>
<p>Bienvenue sur notre page Accueil.</p>

<?php include '../includes/footer.php'; ?>