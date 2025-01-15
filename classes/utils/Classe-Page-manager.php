<?php
class PageManager {
    private static $title = "Udemy";
    private static $description = "";

    public static function setTitle($title) {
        self::$title = $title . " - Udemy";
    }

    public static function getTitle() {
        return self::$title;
    }

    public static function setDescription($description) {
        self::$description = $description;
    }

    public static function getDescription() {
        return self::$description;
    }
}
?>