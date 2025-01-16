<?php
session_start();
require_once '../classes/users/Admin.php';
require_once '../classes/users/User.php';

if (isset($_POST["login"])) {
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    // Créer une instance de Admin
    $admin = new Admin($email, $password);
    
    // Tenter l'authentification
    $user = $admin->authenticate($email, $password);

    if ($user) {
        // Vérifier si c'est bien un admin
        if ($user['role'] === 'admin') {
            // Initialiser la session
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['role'] = $user['role'];
            $_SESSION['email'] = $user['email'];
            
            // Rediriger vers le dashboard admin
            header('Location: admin/admin-dashboard.php');
            exit;
        } else {
            $_SESSION['error'] = "Vous n'avez pas les droits d'administrateur.";
            header('Location: login.php');  // Ajuste selon ton fichier de login
            exit;
        }
    } else {
        $_SESSION['error'] = "Email ou mot de passe incorrect.";
        header('Location: login.php');  // Ajuste selon ton fichier de login
        exit;
    }
}