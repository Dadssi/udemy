<?php
session_start();
require_once '../classes/database/Database.php';
require_once '../classes/users/Teacher.php';
require_once '../classes/users/Student.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $firstName = trim($_POST['first_name'] ?? '');
    $lastName = trim($_POST['last_name'] ?? '');
    $role = $_POST['role'] ?? '';
    $email = filter_var($_POST['email'] ?? '', FILTER_VALIDATE_EMAIL);
    $password = $_POST['password'] ?? '';
    $photo = $_FILES['photo'] ?? null;

    if (!$firstName || !$lastName || !$email || !$password || !$role || !$photo) {
        $_SESSION['error'] = "Tous les champs sont requis, y compris la photo.";
        header('Location: register.php');
        exit;
    }

   
    if (!in_array($role, ['teacher', 'student'])) {
        $_SESSION['error'] = "Rôle invalide.";
        header('Location: register.php');
        exit;
    }

  
    $db = Database::getInstance()->getConnection();
    $stmt = $db->prepare("SELECT id FROM users WHERE email = :email");
    $stmt->bindParam(':email', $email);
    $stmt->execute();

    if ($stmt->fetch()) {
        $_SESSION['error'] = "Cet email est déjà utilisé.";
        header('Location: register.php');
        exit;
    }

   
    $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];
    $uploadDir = '../public/assets/imgs/uploads/';
    $photoName = basename($photo['name']);
    $photoTmpName = $photo['tmp_name'];
    $photoSize = $photo['size'];
    $photoExtension = strtolower(pathinfo($photoName, PATHINFO_EXTENSION));

    if (!in_array($photoExtension, $allowedExtensions)) {
        $_SESSION['error'] = "Format de photo invalide. Formats autorisés : jpg, jpeg, png, gif.";
        header('Location: register.php');
        exit;
    }

    if ($photoSize > 2 * 1024 * 1024) { 
        $_SESSION['error'] = "La taille de la photo ne doit pas dépasser 2 Mo.";
        header('Location: register.php');
        exit;
    }

    $uniquePhotoName = uniqid() . '.' . $photoExtension;
    $photoPath = $uploadDir . $uniquePhotoName;

    if (!move_uploaded_file($photoTmpName, $photoPath)) {
        $_SESSION['error'] = "Erreur lors de l'upload de la photo.";
        header('Location: register.php');
        exit;
    }

   
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    
    $stmt = $db->prepare("INSERT INTO users (first_name, last_name, email, password, role, photo) VALUES (:first_name, :last_name, :email, :password, :role, :photo)");
    $stmt->bindParam(':first_name', $firstName);
    $stmt->bindParam(':last_name', $lastName);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':password', $hashedPassword);
    $stmt->bindParam(':role', $role);
    $stmt->bindParam(':photo', $photoPath);

    if ($stmt->execute()) {
       
        $_SESSION['success'] = "Inscription réussie ! Vous pouvez maintenant vous connecter.";

        if ($role === 'teacher') {
            header('Location: teacher/teacher-dashboard.php');
        } elseif ($role === 'student') {
            header('Location: student/student-dashboard.php');
        }
        exit;
    } else {
       
        if (file_exists($photoPath)) {
            unlink($photoPath);
        }

        $_SESSION['error'] = "Une erreur est survenue. Veuillez réessayer.";
        header('Location: register.php');
        exit;
    }
}
?>







