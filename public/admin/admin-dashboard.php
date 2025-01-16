<?php
session_start();
include '../../config/init.php';
require_once ROOT_PATH . '/autoload.php';

// require_once '__DIR__autoload.php';
require_once '../config/config.php';

PageManager::setTitle("Admin-Tableau de bord");
PageManager::setDescription("Tableau de Bord de l'Administrateur UDEMY");

include '../../includes/header.php';

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header('Location: ../login.php');
    exit;
}
?>
