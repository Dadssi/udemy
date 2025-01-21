<?php
class VideoCourse extends Course {
    private $videoUrl;

    public function __construct($title, $description, $categoryId, $videoUrl) {
        parent::__construct($title, $description, $categoryId);
        $this->videoUrl = $videoUrl;
    }

    public function display() {
        // Démonstration du polymorphisme : affichage spécifique pour les vidéos
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
                <p>{$this->description}</p>
            </div>";
    }

    private function getYoutubeVideoId($url) {
        $pattern = '/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/\s]{11})/';
        preg_match($pattern, $url, $matches);
        return isset($matches[1]) ? $matches[1] : '';
    }

    protected function getContent() {
        return [
            'video_source' => $this->videoUrl,
            'content' => null
        ];
    }

}
?>