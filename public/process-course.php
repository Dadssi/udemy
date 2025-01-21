<?php
session_start();
require_once '../classes/database/Database.php';
require_once '../classes/utils/category.php';
require_once '../classes/users/Admin.php';
require_once '../classes/course/Course.php';
require_once '../classes/course/VideoCourse.php';
require_once '../classes/course/DocumentCourse.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Récupération des données du formulaire
    $title = $_POST['course-title'];
    $description = $_POST['course-description'];
    $categoryId = $_POST['course-category'];
    $contentType = $_POST['content-type'];
    $contentLink = $_POST['content-link'];
    $tags = isset($_POST['tags']) ? $_POST['tags'] : [];

    // Démonstration du polymorphisme : création de l'objet approprié selon le type
    $course = null;
    
    if ($contentType === 'video') {
        // Instanciation d'un nouveau cours vidéo
        $course = new VideoCourse($title, $description, $categoryId, $contentLink);
    } else if ($contentType === 'pdf') {
        // Instanciation d'un nouveau cours document
        $course = new DocumentCourse($title, $description, $categoryId, $contentLink);
    }

    if ($course) {
        // Ajout des tags sélectionnés
        foreach ($tags as $tag) {
            $course->addTag($tag);
        }

        // Définition de l'ID de l'enseignant (à adapter selon votre système)
        $course->setTeacherId($_SESSION['user_id'] ?? 1);

        // Sauvegarde du cours
        if ($course->save()) {
            $_SESSION['success'] = "Le cours a été ajouté avec succès !";
            header('Location: teacher/teacher-dashboard.php');
            exit;
        }
    }
    
    $_SESSION['error'] = "Erreur lors de l'ajout du cours";
    header('Location: teacher/teacher-dashboard.php');
    exit;
}
?>