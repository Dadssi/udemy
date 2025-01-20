<?php
session_start();
require_once '../classes/database/Database.php';
require_once '../classes/users/Admin.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupérer les données du formulaire
    $categoryName = trim($_POST['name'] ?? '');
    $categoryDescription = trim($_POST['description'] ?? '');

    // Vérification des champs obligatoires
    if (!$categoryName || !$categoryDescription) {
        $_SESSION['error'] = "Vous devez saisir un titre et une description pour la catégorie.";
        header('Location: admin/admin-dashboard.php');
        exit;
    }

    try {
        // Connexion à la base de données
        $db = Database::getInstance()->getConnection();

        // Insérer la catégorie dans la base de données
        $stmt = $db->prepare("INSERT INTO categories (name, description) VALUES (:name, :description)");
        $stmt->bindParam(':name', $categoryName);
        $stmt->bindParam(':description', $categoryDescription);

        if ($stmt->execute()) {
            $_SESSION['success'] = "Catégorie ajoutée avec succès.";
        } else {
            $_SESSION['error'] = "Une erreur est survenue lors de l'ajout de la catégorie.";
        }
    } catch (PDOException $e) {
        $_SESSION['error'] = "Erreur : " . $e->getMessage();
    }

    header('Location: admin/admin-dashboard.php');
    exit;
}

// Charger toutes les catégories pour affichage
try {
    $db = Database::getInstance()->getConnection();
    $query = $db->prepare("SELECT * FROM categories");
    $query->execute();
    $categories = $query->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    $_SESSION['error'] = "Erreur lors du chargement des catégories : " . $e->getMessage();
    $categories = [];
}
?>

































// session_start();
// require_once '../classes/database/Database.php';
// require_once '../classes/users/Admin.php';

// if ($_SERVER['REQUEST_METHOD'] === 'POST') {

//     $categoryName = trim($_POST['name'] ?? '');
//     $categoryDescription = trim($_POST['description'] ?? '');

//     if (!$categoryName || !$categoryDescription) {
//         $_SESSION['error'] = "Vous devez saisir un titre et description de la catégorie à ajouter";
//         header('Location: admin/admin-dachboard.php');
//         exit;
//     }

//     $db = Database::getInstance()->getConnection();

//     $stmt = $db->prepare("INSERT INTO categories (name, description) VALUES (:name, :description)");
//     $stmt->bindParam(':name', $categoryName);
//     $stmt->bindParam(':description', $categoryDescription);

//     $query = $db->prepare("SELECT * FROM categories");
//     $query->execute();
//     $query->fetchAll(PDO::FETCH_ASSOC);
//     header('Location: admin/admin-dachboard.php');
//     exit;
   
// }
?>







