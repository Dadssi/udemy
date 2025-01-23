<?php


date_default_timezone_set('Africa/Casablanca');


error_reporting(E_ALL);
ini_set('display_errors', 1);


require_once __DIR__ . '/../autoload.php';

require_once __DIR__ . '/config.php';


define('ROOT_PATH', dirname(__DIR__));
define('PUBLIC_PATH', ROOT_PATH . '/public');
define('INCLUDES_PATH', ROOT_PATH . '/includes');
define('CLASSES_PATH', ROOT_PATH . '/classes');
define('CONFIG_PATH', ROOT_PATH . '/config');
define('UPLOAD_PATH', PUBLIC_PATH . '/assets/imgs/uploads');



define('ROLE_ADMIN', 'admin');
define('ROLE_TEACHER', 'teacher');
define('ROLE_STUDENT', 'student');


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


header('X_Frame-options : DENY');
header('X-Content-Type-Options: nosniff');
header('X-XSS-Protection: 1; mode=block');


SessionManager::init();
?>