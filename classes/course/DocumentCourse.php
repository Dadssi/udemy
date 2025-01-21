<?php
class DocumentCourse extends Course {
    private $documentUrl;

    public function __construct($title, $description, $categoryId, $documentUrl) {
        parent::__construct($title, $description, $categoryId);
        $this->documentUrl = $documentUrl;
    }

    public function display() {
        // Démonstration du polymorphisme : affichage spécifique pour les documents
        return "
            <div class='document-course'>
                <h2>{$this->title}</h2>
                <div class='document-viewer'>
                    <iframe src='{$this->documentUrl}' width='100%' height='600px'></iframe>
                </div>
                <p>{$this->description}</p>
                <a href='{$this->documentUrl}' class='btn btn-primary' target='_blank'>
                    Voir le PDF
                </a>
            </div>";
    }

    protected function getContent() {
        return [
            'video_source' => null,
            'content' => $this->documentUrl
        ];
    }
}
?>