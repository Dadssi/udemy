<?php
require_once '../classes/database/Database.php';
class Student extends User {
    private $enrolledCourses = [];

    public function authenticate() {
        $db = Database::getInstance()->getConnection();
        $stmt = $db->prepare("SELECT * FROM users WHERE email = :email AND role = 'student'");
        $stmt->bindParam(':email', $this->email);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($this->password, $user['password'])) {
            $this->id = $user['id'];
            $this->role = $user['role'];
            return $user;
        }
        return false;
    }
    

    public function __construct($email, $password) 
    {
        parent::__construct($email, $password);
        $this->role = 'student';
    }

    public function save() {
        $db = Database::getInstance()->getConnection();
        $stmt = $db->prepare("
        INSERT INTO users
        (email, password, first_name, last_name, role)
        VALUES
        (?, ?, ?, ?, ?)");
        return $stmt->execute([$this->email, $this->password, $this->first_name, $this->last_name, $this->role]);
    }

    public function delete()
    {
        $db = Database::getInstance()->getConnection();
        $stmt = $db->prepare("DELETE FROM users WHERE id = ?");
        return $stmt->execute([$this->id]);
    }

    public function registerForCourse($courseId) {
        $db = Database::getInstance()->getConnection();
    
        $stmt = $db->prepare("
            SELECT COUNT(*) FROM enrolled_courses 
            WHERE course_id = ? AND student_id = ?
        ");
        $stmt->execute([$courseId, $this->id]);
        if ($stmt->fetchColumn() > 0) {
            return false; //msajjal b3da
        }
    
        $stmt = $db->prepare("
            INSERT INTO enrolled_courses (course_id, student_id, enrolled_at) 
            VALUES (?, ?, NOW())
        ");
        if ($stmt->execute([$courseId, $this->id])) {
            return true; // ok
        }
    
        return false; 
    }
    
    public function getsubscribedCourses() {
        $db = Database::getInstance()->getConnection();
        $stmt = $db->prepare("SELECT c.* FROM courses c JOIN inscriptions i ON c.id = i.course_id WHERE i.student_id = ?");
        $stmt->execute([$this->id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>