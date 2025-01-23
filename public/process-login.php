<?php

session_start();
require_once '../classes/database/Database.php';
require_once '../classes/users/User.php';
require_once '../classes/users/Admin.php';
require_once '../classes/users/Teacher.php';
require_once '../classes/users/Student.php';

if (isset($_POST['login'])) {
    $email = filter_var($_POST['email'] ?? '', FILTER_VALIDATE_EMAIL);
    $password = $_POST['password'] ?? '';

    if (!$email || !$password) {
        $_SESSION['error'] = "Veuillez entrer une adresse email et un mot de passe valides.";
        header('Location: login.php');
        exit;
    }

    
    $db = Database::getInstance()->getConnection();
    $stmt = $db->prepare("SELECT role FROM users WHERE email = :email");
    $stmt->bindParam(':email', $email);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$result) {
        $_SESSION['error'] = "Email ou mot de passe incorrect.";
        header('Location: login.php');
        exit;
    }

    $role = $result['role'];

    
    $user = null;
    if ($role === 'admin') {
        $user = new Admin($email, $password);
    } elseif ($role === 'teacher') {
        $user = new Teacher($email, $password);
    } elseif ($role === 'student') {
        $user = new Student($email, $password);
    } else {
        $_SESSION['error'] = "Rôle utilisateur non reconnu.";
        header('Location: login.php');
        exit;
    }

   
    $authenticatedUser = $user->authenticate();

    if ($authenticatedUser) {
        $_SESSION['user_id'] = $authenticatedUser['id'];
        $_SESSION['role'] = $authenticatedUser['role'];
        $_SESSION['email'] = $authenticatedUser['email'];

   
        if ($authenticatedUser['role'] === 'admin') {
            header('Location: admin/admin-dashboard.php');
        } elseif ($authenticatedUser['role'] === 'teacher') {
            header('Location: teacher/teacher-dashboard.php');
        } elseif ($authenticatedUser['role'] === 'student') {
            header('Location: student/student-dashboard.php');
        }
        exit;
    } else {
        $_SESSION['error'] = "Email ou mot de passe incorrect.";
        header('Location: login.php');
        exit;
    }
}
