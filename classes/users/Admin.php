<?php
require_once '../../classes/database/Database.php';
require_once 'User.php';

class Admin extends User {
    public function __construct($email, $password) {
        parent::__construct($email, $password);
        $this->role = 'admin';
    }

    public function authenticate() {
        $db = Database::getInstance()->getConnection();
        $stmt = $db->prepare("SELECT * FROM users WHERE email = :email AND role = 'admin'");
        $stmt->bindParam(':email', $this->email);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($this->password, $user['password'])) {
            $this->id = $user['id'];
            $this->role = $user['role'];
            return $user;
        }
    }

    public static function getAllUsers() {
        try {
            $db = Database::getInstance()->getConnection();
            $stmt = $db->prepare("SELECT * FROM users ORDER BY role DESC");
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Erreur lors de la récupération des informations des utilisateurs : " . $e->getMessage();
            return false;
        }
    }
    

    public function save() {
        $db = Database::getInstance()->getConnection();
        $stmt = $db->prepare("INSERT INTO users (email, password, first_name, last_name, role)
        VALUES (?, ?, ?, ?, ?)");
        return $stmt->execute([$this->email, $this->password, $this->first_name, $this->last_name, $this->role]);
    }

    public function delete() {
        $db = Database::getInstance()->getConnection();
        $stmt = $db->prepare("DELETE FROM users WHERE id = ?");
        return $stmt->execute([$this->id]);
    }

    public function validateTeacher($teacherId) {
        $db = Database::getInstance()->getConnection();
        $stmt = $db->prepare("UPDATE users SET is_validated = true WHERE id = ? AND role = 'teacher'");
        return $stmt->execute([$teacherId]);
    }

    public function getGlobalStatistics() {
        $db = Database::getInstance()->getConnection();
        $stats = [];

        // total des cours :
        $stmt = $db->query("SELECT COUNT (*) as total FROM courses");
        $stats['total_cours'] = $stmt->fetch(PDO::FETCH_ASSOC)['total'];
        
        // top 3 enseignants :
        $stmt = $db->query("
        SELECT u.firs_name, u.last_name, COUNT(c.id) as total_cours
        FROM users u
        JOIN courses c ON u.id = c.teacher_id
        GROUP BY total_cours DESC
        LIMIT 3
        ");
        $stats['top_enseignants'] = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $stats;
    }
}
?>