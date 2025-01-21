<?php
abstract class Course {
    protected $id;
    protected $title;
    protected $description;
    protected $teacherId;
    protected $categoryId;
    protected $tags = [];
    protected $createdAt;
    protected $updatedAt;

    public function __construct($title, $description, $categoryId) {
        $this->title = $title;
        $this->description = $description;
        $this->categoryId = $categoryId;
    }

    abstract public function display();

    public function setTeacherId($teacherId) {
        $this->teacherId = $teacherId;
    }

    public function addTag($tag) {
        $this->tags[] = $tag;
    }

    public function save() {
        $db = Database::getInstance()->getConnection();
        
        // Modification de la requête pour inclure video_source et content
        $stmt = $db->prepare("
            INSERT INTO courses (
                title, 
                description, 
                teacher_id, 
                category_id,
                video_source,
                content,
                created_at, 
                updated_at
            ) VALUES (?, ?, ?, ?, ?, ?, ?, ?)
        ");
        
        // Obtenir le contenu spécifique via une méthode abstraite
        $content = $this->getContent();
        
        if ($stmt->execute([
            $this->title,
            $this->description,
            $this->teacherId,
            $this->categoryId,
            $content['video_source'] ?? null,  // sera null pour les PDF
            $content['content'] ?? null,       // sera null pour les vidéos
            $this->createdAt,
            $this->updatedAt
        ])) {
            $this->id = $db->lastInsertId();
            $this->saveTags();
            return true;
        }
        return false;
    }

    abstract protected function getContent();

    protected function saveTags() {
        if (empty($this->tags)) return;
    
        $db = Database::getInstance()->getConnection();
        foreach ($this->tags as $tag) {
            // Insertion du tag s'il n'existe pas
            $stmt = $db->prepare("INSERT IGNORE INTO tags (name) VALUES (?)");
            $stmt->execute([$tag]);
            
            // Récupération de l'ID du tag
            $stmt = $db->prepare("SELECT id FROM tags WHERE name = ?");
            $stmt->execute([$tag]);
            $tagId = $stmt->fetchColumn();
    
            if ($tagId) {
                // Ajout de IGNORE pour éviter l'erreur de doublon
                $stmt = $db->prepare("INSERT IGNORE INTO course_tags (course_id, tag_id) VALUES (?, ?)");
                $stmt->execute([$this->id, $tagId]);
            }
        }
    }
}









































































// abstract class Course {
//     protected $id;
//     protected $title;
//     protected $description;
//     protected $teacherId;
//     protected $category;
//     protected $tags = [];
//     protected $createdAt;
//     protected $updatedAt;

//     public function __construct($title, $description, $category) {
//         $this->title = $title;
//         $this->description = $description;
//         $this->category = $category;
//         $this->createdAt = date('Y-m-d H:i:s');
//         $this->updatedAt = date('Y-m-d H:i:s');
//     }

//     // Méthode abstraite qui devra être implémentée par les classes enfants
//     abstract public function display();
    
//     // Méthode abstraite pour la validation du contenu spécifique
//     abstract protected function validateContent();

//     // Getters et setters communs
//     public function getId() { return $this->id; }
//     public function getTitle() { return $this->title; }
//     public function getDescription() { return $this->description; }
    
//     public function setTeacherId($teacherId) {
//         $this->teacherId = $teacherId;
//     }

//     public function addTag($tag) {
//         $this->tags[] = $tag;
//     }

//     public function save() {
//         if (!$this->validateContent()) {
//             return false;
//         }

//         $db = Database::getInstance()->getConnection();
//         $stmt = $db->prepare("
//             INSERT INTO courses (title, description, teacher_id, category, course_type, created_at, updated_at)
//             VALUES (?, ?, ?, ?, ?, ?, ?)
//         ");
        
//         if ($stmt->execute([
//             $this->title,
//             $this->description,
//             $this->teacherId,
//             $this->category,
//             static::class,
//             $this->createdAt,
//             $this->updatedAt
//         ])) {
//             $this->id = $db->lastInsertId();
//             $this->saveTags();
//             $this->saveSpecificContent();
//             return true;
//         }
//         return false;
//     }

//     // Méthode abstraite pour sauvegarder le contenu spécifique
//     abstract protected function saveSpecificContent();

//     protected function saveTags() {
//         if (empty($this->tags)) return;

//         $db = Database::getInstance()->getConnection();
//         foreach ($this->tags as $tag) {
//             $stmt = $db->prepare("INSERT IGNORE INTO tags (name) VALUES (?)");
//             $stmt->execute([$tag]);
            
//             $tagId = $db->lastInsertId() ?: $db->query("SELECT id FROM tags WHERE name = '$tag'")->fetch()['id'];

//             $stmt = $db->prepare("INSERT INTO course_tags (course_id, tag_id) VALUES (?, ?)");
//             $stmt->execute([$this->id, $tagId]);
//         }
//     }
// }
?>