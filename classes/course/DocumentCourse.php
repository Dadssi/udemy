<?php
class DocumentCourse extends Course {
    private $documentUrl;

    public function __construct($title, $description, $categoryId, $documentUrl) {
        parent::__construct($title, $description, $categoryId);
        $this->documentUrl = $documentUrl;
    }

    public function toArray() {
        $baseData = parent::toArray();
        $baseData['type'] = 'pdf';
        $baseData['document_url'] = $this->documentUrl;
        return $baseData;
    }

    public function display() {
        return "
            <div class='document-course'>
                <h2>{$this->title}</h2>
                <iframe src='{$this->documentUrl}'></iframe>
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