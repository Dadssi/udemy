<?php
session_start();
require_once '../classes/database/Database.php';
require_once '../classes/utils/category.php';
require_once '../classes/users/Admin.php';
require_once '../classes/course/Course.php';
require_once '../classes/course/VideoCourse.php';
require_once '../classes/course/DocumentCourse.php';

function getYoutubeEmbedUrl($url) {
    parse_str(parse_url($url, PHP_URL_QUERY), $queryParams);
    return isset($queryParams['v']) ? "https://www.youtube.com/embed/" . $queryParams['v'] : null;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  
    $title = $_POST['course-title'];
    $description = $_POST['course-description'];
    $categoryId = $_POST['course-category'];
    $contentType = $_POST['content-type'];
    $contentLink = $_POST['content-link'];
    $tags = isset($_POST['tags']) ? $_POST['tags'] : [];

    
    if ($contentType === 'video') {
        $contentLink = getYoutubeEmbedUrl($contentLink);
        if (!$contentLink) {
            $_SESSION['error'] = "Le lien vidéo fourni n'est pas valide.";
            header('Location: teacher/teacher-dashboard.php');
            exit;
        }
    }

    
    $course = null;
    
    if ($contentType === 'video') {
       
        $course = new VideoCourse($title, $description, $categoryId, $contentLink);
    } else if ($contentType === 'pdf') {
       
        $course = new DocumentCourse($title, $description, $categoryId, $contentLink);
    }

    if ($course) {
       
        foreach ($tags as $tag) {
            $course->addTag($tag);
        }

       
        $course->setTeacherId($_SESSION['user_id'] ?? 1);
       
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