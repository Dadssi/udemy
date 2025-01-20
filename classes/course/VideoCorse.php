<?php
class VideoCourse extends Course {
    private $videoUrl;

    public function __construct($title, $description, $category, $videoUrl) {
        parent::__construct($title, $description, $category);
        $this->videoUrl = $videoUrl;
    }

    public function display() {
        // Extraction de l'ID de la vidéo YouTube depuis l'URL
        $videoId = $this->getYoutubeVideoId($this->videoUrl);
        
        return "
            <div class='video-course'>
                <h2>{$this->title}</h2>
                <div class='video-player'>
                    <iframe 
                        width='100%' 
                        height='400' 
                        src='https://www.youtube.com/embed/{$videoId}' 
                        frameborder='0' 
                        allowfullscreen>
                    </iframe>
                </div>
                <div class='course-info'>
                    <p class='description'>{$this->description}</p>
                </div>
            </div>";
    }

    private function getYoutubeVideoId($url) {
        $pattern = '/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/\s]{11})/';
        preg_match($pattern, $url, $matches);
        return isset($matches[1]) ? $matches[1] : '';
    }

    protected function validateContent() {
        return filter_var($this->videoUrl, FILTER_VALIDATE_URL) 
            && $this->getYoutubeVideoId($this->videoUrl) !== '';
    }

    protected function saveSpecificContent() {
        $db = Database::getInstance()->getConnection();
        $stmt = $db->prepare("
            INSERT INTO video_courses (course_id, video_url)
            VALUES (?, ?)
        ");
        return $stmt->execute([
            $this->id,
            $this->videoUrl
        ]);
    }
}

?>