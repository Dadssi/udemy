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
                  
                    $db->rollBack();
                    $_SESSION['error'] = "Une erreur est survenue lors de l'ajout des tags.";
                    return false;
                }
            }
    
           
            $db->commit();
            $_SESSION['success'] = "Tous les tags ont été ajoutés avec succès.";
            return true;
        } catch (PDOException $e) {
          
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

   
}
?>