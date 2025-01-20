<?php
class Category {
    private $id;
    private $name;
    private $description;
    private $courses = []; // Liste des cours liés à cette catégorie

    public function __construct($name, $description) {
        $this->name = $name;
        $this->description = $description;
    }

    public function create($name, $description) {
        try {
            $db = Database::getInstance()->getConnection();

            $stmt = $db->prepare("INSERT INTO categories (name, description) VALUES (:name, :description)");
            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':description', $description);

            if ($stmt->execute()) {
                $_SESSION['success'] = "Catégorie ajoutée avec Succès";
            } else {
                $_SESSION['error'] = "Une erreur est survenue lors de l'ajout de la catégorie";
            }
        } catch (PDOException $e) {
            $_SESSION['error'] = "Erreur : " . $e->getMessage();
        }
    }

    public static function getAllCategories() {
        try {
            $db = Database::getInstance()->getConnection();
    
            $stmt = $db->prepare("SELECT * FROM categories");
            $stmt->execute();
    
            $categories = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
            return $categories; // Retourner un tableau contenant toutes les catégories
        } catch (PDOException $e) {
            $_SESSION['error'] = "Erreur lors de la récupération des catégories : " . $e->getMessage();
            return [];
        }
    }
    
    




















    // Ajouter un cours à la catégorie
    // public function addCourse(Cours $course)
    // {
    //     $this->courses[] = $course;
    // }

    // // Obtenir tous les cours liés à cette catégorie
    // public function getCourses()
    // {
    //     return $this->courses;
    // }
}
?>





















?>
