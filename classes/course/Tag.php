<?php
class Tag {
    private $id;
    private $name;
    private static $allowedCharachters = '/^[a-zA-Z0-9\-_]+$/';

    public function __construct() {
    }

    public function getId() {
        return $this->id;
    }

    public function getName() {
        return $this->name;
    }

    public function setName($name) {
        // validation du format du tag :
        if (!preg_match(self::$allowedCharachters, $name)) {
            throw new Exception("Le tag ne peut contenir que des lettres, chiffres, tirets et underscores");
        }
        $this->name = strToLower($name);
    }

    public function create(array $names) {
        try {
            $db = Database::getInstance()->getConnection();
    
            $stmt = $db->prepare("INSERT INTO tags (name) VALUES (:name)");
    
            $db->beginTransaction();
    
            foreach ($names as $name) {
                $stmt->bindParam(':name', $name);
                if (!$stmt->execute()) {
                    // Si un insert échoue, on arrête la transaction
                    $db->rollBack();
                    $_SESSION['error'] = "Une erreur est survenue lors de l'ajout des tags.";
                    return false;
                }
            }
    
            // Confirmer la transaction si tout s'est bien passé
            $db->commit();
            $_SESSION['success'] = "Tous les tags ont été ajoutés avec succès.";
            return true;
        } catch (PDOException $e) {
            // Gérer les erreurs
            $db->rollBack();
            $_SESSION['error'] = "Erreur : " . $e->getMessage();
            return false;
        }
    }

    public static function getAllTags() {
        try {
            $db = Database::getInstance()->getConnection();
    
            $stmt = $db->prepare("SELECT * FROM tags ORDER BY NAME");
            $stmt->execute();
    
            $categories = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
            return $categories;
        } catch (PDOException $e) {
            $_SESSION['error'] = "Erreur lors de la récupération des catégories : " . $e->getMessage();
            return [];
        }
    }

    public function save() {
        $db = Database::getInstance()->getConnection();
        $stmt = $db->prepare("
        INSERT IFNORE INTO tags (name) VALUES (?)");

        if ($stmt->execute([$this->name])) {
            $this->id = $db->lastInsertId() ?:
                $db->query("SELECT id FROM tags WHERE name = '" . $this->name . "'")->fetch()['id'];
            return true;
        }
        return false;
    }

    public function delete() {
        if (!$this->id) {
            return false;
        }

        $db = Database::getInstance()->getConnection();
        $stmt = $db->prepare("DELETE FROM tags WHERE id = ?");
        return $stmt->execute([$this->id]);
    }

    // Méthode pour avoir les cours associé à ce tag :
    public function getAssociatedCourses() {
        $db = Database::getInstance()->getConnection();
        $stmt = $db->prepare("
        SELECT c.*
        FROM courses c
        JOIN course_tags ct ON c.id = ct.course_id
        WHERE ct.tag_id = ?
        ");
        $stmt->execute([$this->id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Méthode statique pour insertion en masse de tags :
    public static function bulkInsert(array $tags) {
        $db = Database::getInstance()->getConnection();
        $db->beginTransaction();

        try {
            foreach ($tags as $tagName) {
                $tag = new Tag($tagName);
                $tag->save();
            }
            $db->commit();
            return true;
        } catch (Exception $e) {
            $db->rollBack();
            throw $e;
        }

    }

    // Méthode pour vérifier si un tag existe déjà :
        public static function exists($name) {
            $db = Database::getInstance()->getConnection();
            $stmt = $db->prepare("SELECT COUNT(*) FROM tags WHERE name = ?");
            $stmt->execute([strToLower($name)]);
            return $stmt->fetchColumn() > 0;
        }
}
?>