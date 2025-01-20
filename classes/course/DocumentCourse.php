<?php
class DocumentCourse extends Course {
    private $documentPath;

    public function __construct($title, $description, $category, $documentPath) {
        parent::__construct($title, $description, $category);
        $this->documentPath = $documentPath;
    }

    public function display() {
        return "
            <div class='document-course'>
                <h2>{$this->title}</h2>
                <div class='document-viewer'>
                    <iframe src='{$this->documentPath}' width='100%' height='600px'></iframe>
                </div>
                <div class='course-info'>
                    <p class='description'>{$this->description}</p>
                    <a href='{$this->documentPath}' class='btn btn-primary' download>
                        Télécharger le PDF
                    </a>
                </div>
            </div>";
    }

    protected function validateContent() {
        if (!file_exists($this->documentPath)) {
            return false;
        }
        
        $fileInfo = pathinfo($this->documentPath);
        return strtolower($fileInfo['extension']) === 'pdf';
    }

    protected function saveSpecificContent() {
        $db = Database::getInstance()->getConnection();
        $stmt = $db->prepare("
            INSERT INTO document_courses (course_id, document_path)
            VALUES (?, ?)
        ");
        return $stmt->execute([
            $this->id,
            $this->documentPath
        ]);
    }
}
?>