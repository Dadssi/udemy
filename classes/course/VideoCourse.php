<?php
require_once 'course.php';
class VideoCourse extends Course {
    private $videoUrl;

    public function __construct($title, $description, $categoryId, $videoUrl) {
        parent::__construct($title, $description, $categoryId);
        $this->videoUrl = $videoUrl;
    }

    public function toArray() {
        $baseData = parent::toArray();
        $baseData['type'] = 'video';
        $baseData['video_url'] = $this->videoUrl;
        return $baseData;
    }

    public function display() {
        $videoId = $this->getYoutubeEmbedUrl($this->videoUrl);
        return "
            <div class='video-course'>
                <h2>{$this->title}</h2>
                <iframe src='https://www.youtube.com/embed/{$this->videoUrl}'></iframe>
            </div>";
    }

    private function getYoutubeEmbedUrl($url) {
        parse_str(parse_url($url, PHP_URL_QUERY), $queryParams);
        return isset($queryParams['v']) ? "https://www.youtube.com/embed/" . $queryParams['v'] : null;
    }
    

    protected function getContent() {
        return [
            'video_source' => $this->videoUrl,
            'content' => null
        ];
    }
}
?>