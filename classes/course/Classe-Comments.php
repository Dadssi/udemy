<?php 
require_once '../autoload.php';
 ?>
<?php
class Comment {
    private $id;
    private $courseId;
    private $userId;
    private $content;
    private $createdAt;
    private const MAX_CONTENT_LENGTH = 1000;

    public function __construct($courseId, $userId, $content) {
        $this->setCourseId($courseId);
        $this->setUserId($userId);
        $this->setContent($content);
    }

    // Getters :
    public function getId() {
        return $this->id;
    }

    public function getCourseId() {
        return $this->courseId;
    }
    public function getUserId() {
        return $this->userId;
    }
    public function getContent() {
        return $this->content;
    }
    public function getCreatedAt() {
        return $this->createdAt;
    }

    // Setters + Validation :
    public function setCourseId($courseId) {
        if (!is_numeric($courseId)) {
            throw new Exception("L'ID du cours doit être numérique");
        }
        $this->courseId = $courseId;
    }

    public function setUserId($userId) {
        if (!is_numeric($userId)) {
            throw new Exception("L'ID de l'Utilisateur doit être numérique");
        }
        $this->userId = $userId;
    }

    public function setContent($content) {
        $content = trim($content);
        if (empty($content)) {
            throw new Exception("Le contenu du commentaire ne peut pas être vide");
        }
        if (strlen($content) > self::MAX_CONTENT_LENGTH) {
            throw new Exception("Le commentaire ne peut pas dépasser " . self::MAX_CONTENT_LENGTH . "caractères");
        }
        $this->content = Security::sanitizeInput($content);
    }

    // Méthode d'nregistrer le commentaire :
    public function save() {
        $db = Database::getInstance()->getConnection();

        // verification si l'étudiant est inscrit au cours :
        if (!$this->canUserComment()) {
            throw new Exception("L'Utilisateur doit être inscrit au cours pour commenter");
        }

        $stmt = $db->prepare("INSERT INTO comments (course_id, user_id, content) VALUES (?, ?, ?)");

        if ($stmt->execute([$this->courseId, $this->userId, $this->content])) {
            $this->id = $db->lastInsertedId();
            $this->createdId = date('Y-m-d H:i:s');
            return true;
        }
        return false;
    }

    // Méthode pour supprimer le commentaire :
    public function delete() {
        if (!this->id) {
            return false;
        }

        $db = Database::getInstance()->getConnection();
        $stmt = $db->prepare("DELETE FROM comments WHERE id = ? AND user_d = ?");
        return $stmt->execute([$this->id, $this->userId]);
    }

    // Méthode pour verifier si l'utilisateur peut commenter ou non :
    private function canUserComment() {
        $db = Database::getInstance()->getConnection();
        $stmt = $db->prepare("
        SELECT COUNT(*)
        FROM inscriptions
        WHERE student_id = ? AND course_id = ?
        ");
        $stmt->execute([$this->userId, $this->courseId]);
        return $stmt->fetchColumn() > 0;
    }

    // Méthode statique pour récupérer tous les commentaires d'un cours :
    public static function getCommentByCourse($courseId, $limit = 10, $offset = 0) {
        $db = Database::getInstance()->getConnection();
        $stmt = $db->prepare("
        SELECT c.*, u.nom, u.prenom
        FROM comments c
        JOIN users u ON c.user_id = u.id
        WHERE c.course_id = ?
        ORDER BY c.created_at DESC
        LIMITE ? OFFSET ?
        ");
        $stmt->execute([$courseId, $limit, $offset]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Méthode pour mettre à jour le contenu du commentaire
    public function update($newContent) {
        $this->setContent($newContent);

        $db = Database::getInstance()->getConnection();
        $stmt = $db->prepare("
        UPDATE comments
        SET content = ?
        WHERE id = ? AND user_id = ?
        ");
        return $stmt->execute([$this->content, $this->id, $this->userId]);
    }

    // Méthode pour compter le nombre de commentaires d'un cours
    public static function countCommentByCourse($courseId) {
        $db = Database::getInstance()->getConnection();
        $stmt = $db->prepare("
        SELECT COUNT(*) 
        FROM comments 
        WHERE course_id = ?
        ");
        $stmt->execute([$courseId]);
        return $stmt->fetchColumn();
    }
}
?>