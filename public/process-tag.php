<?php
session_start();
require_once '../classes/database/Database.php';
require_once '../classes/course/Tag.php';
require_once '../classes/users/Admin.php';

// if ($_SERVER['REQUEST_METHOD'] === 'POST') {
//     $tagTitle = trim($_POST['name'] ?? '');

//     if (!$tagTitle) {
//         $_SESSION['error'] = "Vous devez saisir un titre pour le tag";
//         header('Location: admin/admin-dashboard.php');
//         exit;
//     }
//     $newCategory = new Category($categoryName, $categoryDescription);
//     $newCategory->create($categoryName, $categoryDescription);

//     header('Location: admin/admin-dashboard.php');
//     exit;
// }

// $categories = Category::getAllCategories();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['tags']) && is_array($_POST['tags'])) {
        // Récupérer les tags depuis le formulaire
        $tags = array_filter($_POST['tags'], fn($tag) => !empty(trim($tag)));

        if (!empty($tags)) {
            $tagModel = new Tag();
            $tagModel->create($tags);
        } else {
            $_SESSION['error'] = "Veuillez entrer au moins un tag valide.";
        }
    } else {
        $_SESSION['error'] = "Aucun tag reçu.";
    }

    // Redirection après le traitement
    header("Location: admin/admin-dashboard.php");
    exit();
}


?>












