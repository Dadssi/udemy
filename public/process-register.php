<?php
session_start();
require_once '../classes/database/Database.php';
require_once '../classes/users/Teacher.php';
require_once '../classes/users/Student.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupérer les données du formulaire
    $firstName = trim($_POST['first_name'] ?? '');
    $lastName = trim($_POST['last_name'] ?? '');
    $role = $_POST['role'] ?? '';
    $email = filter_var($_POST['email'] ?? '', FILTER_VALIDATE_EMAIL);
    $password = $_POST['password'] ?? '';

    // Vérifier les champs requis
    if (!$firstName || !$lastName || !$email || !$password || !$role) {
        $_SESSION['error'] = "Tous les champs sont requis.";
        header('Location: register.php'); // Rediriger vers le formulaire
        exit;
    }

    // Vérifier le rôle valide
    if (!in_array($role, ['teacher', 'student'])) {
        $_SESSION['error'] = "Rôle invalide.";
        header('Location: register.php');
        exit;
    }

    // Vérifier si l'email est déjà utilisé
    $db = Database::getInstance()->getConnection();
    $stmt = $db->prepare("SELECT id FROM users WHERE email = :email");
    $stmt->bindParam(':email', $email);
    $stmt->execute();

    if ($stmt->fetch()) {
        $_SESSION['error'] = "Cet email est déjà utilisé.";
        header('Location: register.php');
        exit;
    }

    // Hasher le mot de passe
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Enregistrer l'utilisateur dans la base de données
    $stmt = $db->prepare("INSERT INTO users (first_name, last_name, email, password, role) VALUES (:first_name, :last_name, :email, :password, :role)");
    $stmt->bindParam(':first_name', $firstName);
    $stmt->bindParam(':last_name', $lastName);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':password', $hashedPassword);
    $stmt->bindParam(':role', $role);

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
        $_SESSION['error'] = "Une erreur est survenue. Veuillez réessayer.";
        header('Location: register.php');
        exit;
    }
}
