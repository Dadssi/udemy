<?php
class Course {
    private $id;
    private $title;
    private $description;
    private $content;
    private $teacherId;
    private $category;
    private $tags = [];

    public function __construct($title, $description, $content, $category) {
        $this->title = $title;
        $this->description = $description;
        $this->content = $content;
        $this->category = $category;
    }

    public function save() {
        $db = Database::getInstance()->getConnection();
        $stmt = $db->prepare("
        INSERT INTO courses (title, description, content, teacher_id, category)
        VALUES (?, ?, ?, ?, ?)
        ");
        if ($stmt->execute([$this->title, $this->description, $this->content, $this->teacherId, $this->category])) {
            $this->id = $db->lastInsertId();
            $this->saveTags();
            return true;
        }
        return false;
    }

    public function setTeacherId($teacherId) {
        $this->teacherId = $teacherId;
    }

    public function addTag($tag) {
        $this->tags[] = $tag;
    }

    private function saveTags() {
        if (empty($this->tags)) return ;

        $db = Database::getInstance()->getConnection();
        foreach ($this->tags as $tag) {
            // Insérer ou récupérer l'ID du Tag :
            $stmt = $db->prepare("INSERT IGNORE INTO tags (name) VALUES (?)");
            $stmt->execute([$tag]);
            
            $tagId = $db->lastInsertId() ?: $db->query("
            SELECT id 
            FROM tags 
            WHERE name = '$tag'
            ")->fetch()['id'];

            // créer la relation cours-tag
            $stmt = $db->prepare("
            INSERT INTO course_tags (course_id, tag_id)
            VALUES (?, ?)
            ");
            $stmt->execute([$this->id, $tagId]);
        }
    }

    public static function search($keywords, $category = null, $tags = []) {
        $db = Database::getInstance()->getConnection();
        $sql = "
        SELECT DISTINCT c.*
        FROM courses c
        LEFT JOIN course_tags ct ON c.id = ct.course_id
        LEFT JOIN tags t ON ct.tag_id = t.id
        WHERE (c.title LIKE ? OR c.description LIKE ?)
        ";
        $params = ["%$keywords%, %$keywords%"];

        if ($category) {
            $sql .= "AND c.category = ?";
            $params[] = $category;
        }
        if (!empty($tags)) {
            $placeholders = str_repeat('?,', count($tags) - 1) . '?';
            $sql .= "AND t.name IN ($placeholders)";
            $params = array_merge($params, $tags);
        }

        $stmt = $db->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>