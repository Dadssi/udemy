<?php
session_start();

date_default_timezone_set('Africa/Casablanca');

// Activation de l'affichage des erreurs :
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Inclusion de l'autoloader :
require_once __DIR__ . '/../autoload.php';
// Inclusion du fichier de configuration :
require_once __DIR__ . '/config.php';

// constantes globales de l'application :
define('ROOT_PATH', dirname(__DIR__));
define('PUBLIC_PATH', ROOT_PATH . '/public');
define('UPLOAD_PATH', PUBLIC_PATH . '/assets/imgs/uploads');
// define('MAX_FILE_SIZE', 5 * 1024 * 1024); => 5MB

// constantes pour les rôles utilisateurs :
define('ROLE_ADMIN', 'admin');
define('ROLE_TEACHER', 'teacher');
define('ROLE_STUDENT', 'student');

// fonctions utilitaires de base :
function redirect($path) {
    header("Location: " . $path);
    exit();
}

function isLoggedIn() {
    return isset($_SESSION['user_id']);
}

function getCurrentUser() {
    if (!isLoggedIn()) {
        return null;
    }
    try {
        $userId = $_SESSION['user_id'];
        $role = $_SESSION['user_role'];

        switch ($role) {
            case ROLE_ADMIN:
                return Admin::createFromId($userId);
            case ROLE_TEACHER:
                return Teacher::createFromId($userId);
            case ROLE_STUDENT:
                return Student::createFromId($userId);
            default:
                return null;
        }
    } catch (Exception $e) {
        error_log("Erreur lors de la récupération de l'utilisateur : " . $e->getMessage());
        return null;
    }
}

// configuration des headers de sécurité
header('X_Frame-options : DENY');
header('X-Content-Type-Options: nosniff');
header('X-XSS-Protection: 1; mode=block');

// Initialisation du gestionnaire de session
SessionManager::init();
?>