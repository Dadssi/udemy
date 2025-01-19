<?php
session_start();
require_once '../classes/database/Database.php';
require_once '../classes/users/Admin.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $categoryName = trim($_POST['name'] ?? '');
    $categoryDescription = trim($_POST['description'] ?? '');

    if (!$categoryName || !$categoryDescription) {
        $_SESSION['error'] = "Vous devez saisir un titre et description de la catégorie à ajouter";
        header('Location: admin/admin-dachboard.php');
        exit;
    }

    $stmt = $db->prepare("INSERT INTO categories (name, description) VALUES (:name, :description)");
    $stmt->bindParam(':name', $categoruName);
    $stmt->bindParam(':description', $categoryDescription);

    if ($stmt->execute()) {
        // Redirection selon le rôle après inscription réussie
        $_SESSION['success'] = "Inscription réussie ! Vous pouvez maintenant vous connecter.";

        if ($role === 'teacher') {
            header('Location: teacher/teacher-dashboard.php');
        } elseif ($role === 'student') {
            header('Location: student/student-dashboard.php');
        }
        exit;
    } else {
        // Supprimer la photo en cas d'échec de l'insertion
        if (file_exists($photoPath)) {
            unlink($photoPath);
        }

        $_SESSION['error'] = "Une erreur est survenue. Veuillez réessayer.";
        header('Location: register.php');
        exit;
    }
}
?>







