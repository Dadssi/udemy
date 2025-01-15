<?php
class Tag {
    private $id;
    private $name;
    private static $allowedCharachters = '/^[a-zA-Z0-9\-_]+$/';

    public function __construct($name) {
        $this->setName($name);
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

    // Méthode statique pour récupérer tous les tags :
    public static function getAllTags() {
        $db = Database::getInstance()->getConnection();
        $stmt = $db->prepare("SELECT * FROM tags ORDER BY name");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
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