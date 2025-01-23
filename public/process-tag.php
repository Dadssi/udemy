<?php
session_start();
require_once '../classes/database/Database.php';
require_once '../classes/course/Tag.php';
require_once '../classes/users/Admin.php';


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['tags']) && is_array($_POST['tags'])) {
     
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

   
    header("Location: admin/admin-dashboard.php");
    exit();
}


?>












