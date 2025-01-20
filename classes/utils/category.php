<?php
class Category {
    private $id;
    private $name;
    private $description;
    private $courses = []; // Liste des cours liés à cette catégorie

    public function __construct($name, $description)
    {
        $this->name = $name;
        $this->description = $description;
    }

    // Ajouter un cours à la catégorie
    public function addCourse(Cours $course)
    {
        $this->courses[] = $course;
    }

    // Obtenir tous les cours liés à cette catégorie
    public function getCourses()
    {
        return $this->courses;
    }
}
?>





















?>
