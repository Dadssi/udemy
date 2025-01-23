<?php
// require_once '../database/Database.php';
require_once 'DocumentCourse.php';
require_once 'VideoCourse.php';

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

    public function toArray() {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
            'teacher_id' => $this->teacherId,
            'category_id' => $this->categoryId,
            'tags' => $this->tags,
            'created_at' => $this->createdAt,
            'updated_at' => $this->updatedAt,
        ];
    }

    public function setTeacherId($teacherId) {
        $this->teacherId = $teacherId;
    }

    public function addTag($tag) {
        $this->tags[] = $tag;
    }

    public function save() {
        $db = Database::getInstance()->getConnection();
        
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
        
        $content = $this->getContent();
        if ($stmt->execute([
            $this->title,
            $this->description,
            $this->teacherId,
            $this->categoryId,
            $content['video_source'] ?? null,
            $content['content'] ?? null,
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
        
            $stmt = $db->prepare("INSERT IGNORE INTO tags (name) VALUES (?)");
            $stmt->execute([$tag]);
            
            $stmt = $db->prepare("SELECT id FROM tags WHERE name = ?");
            $stmt->execute([$tag]);
            $tagId = $stmt->fetchColumn();
    
            if ($tagId) {

                $stmt = $db->prepare("INSERT IGNORE INTO course_tags (course_id, tag_id) VALUES (?, ?)");
                $stmt->execute([$this->id, $tagId]);
            }
        }
    }


    public static function getAllCourses() {
        $db = Database::getInstance()->getConnection();


        // $stmt = $db->prepare("SELECT * FROM courses");
        $stmt = $db->prepare("SELECT 
                u.first_name, 
                u.last_name, 
                c.title, 
                c.description, 
                c.video_source, 
                c.teacher_id, 
                c.category_id, 
                c.created_at
            FROM 
                courses c
            JOIN 
                users u
            ON 
                c.teacher_id = u.id
            ORDER BY 
                c.created_at DESC");
        $stmt->execute();

        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $courses = [];
        foreach ($rows as $row) {
            if ($row['video_source']) {
                $course = new VideoCourse($row['title'], $row['description'], $row['category_id'], $row['video_source']);
            } else {
                $course = new DocumentCourse($row['title'], $row['description'], $row['category_id'], $row['content']);
            }
            // $course->id = $row['id'];
            $course->teacherId = $row['teacher_id'];
        //     $course->createdAt = $row['created_at'];
        //     $course->updatedAt = $row['updated_at'];
        //     $courses[] = $course;
        }

        return $courses;

    }
}


// $courses = Course::getAllCourses();
// echo '<pre>';
// print_r($courses);
// echo '</pre>';
// echo '<br>';
// echo '<br>';
// echo '<br>';

// foreach ($courses as $course) {
//     echo $course['title'];
//     // print_r($course);

// }

// foreach ($courses as $course) {
//     echo "<h2>" . $course->getTitle() . "</h2>";
//     echo "<p>" . $course->getDescription() . "</p>";
// }

