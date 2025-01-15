<?php
class Teacher extends User {
    private $ownCourses = [];
    private $isValidated = false;

    public function __construct($email, $password, $first_name, $last_name)
    {
        parent::__construct($email, $password, $first_name, $last_name);
        $this->role = 'teacher';
    }

    public function save()
    {
        $db = Database::getInstance()->getConnection();
        $stmt = $db->prepare("
        INSERT INTO users (email, password, first_name, last_name, role, is_validated)
        VALUES
        (?, ?, ?, ?, ?, ?)");
        return $stmt->execute([$this->email, $this->password, $this->first_name, $this->last_name, $this->role, $this->isValidated]);
    }

    public function delete()
    {
        $db = Database::getInstance()->getConnection();
        $stmt = $db->prepare("
        DELETE FROM users WHERE id = ?");
        return $stmt->execute([$this->id]);
    }

    public function addCourse(Course $course) {
        if ($this->isValidated) {
            $course->setTeacherId($this->id);
            return $course->save();
        }
        return false;
    }

    public function getStatistics() {
        $db = Database::getInstance()->getConnection();
        $stmt = $db->prepare("
        SELECT
            COUNT(DISTINCT c.id) as total_cours,
            COUNT(DISTINCT i.student_id) as total_etudiants
        FROM courses c
        LEFT JOIN inscriptions i ON c.id = i.course_id
        WHERE c.teacher_id = ?
        ");
        $stmt->execute([$this->id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
?>