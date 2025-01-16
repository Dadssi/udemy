<?php
include '../classes/database/Classe-Database.php';
abstract class User {
    protected $id;
    protected $email;
    protected $password;
    protected $first_name;
    protected $last_name;
    protected $role;
    protected $status;

    public function __construct($email, $password) {
        $this->email = $email;
        $this->password = password_hash($password, PASSWORD_DEFAULT);
        // $this->first_name = $first_name;
        // $this->last_name = $last_name;
    }

    public static function createFromId($id) {
        $db = Database::getInstance()->getConnection();
        $stmt = $db->prepare("SELECT * FROM users WHERE id = ?");
        $stmt->execute([$id]);
        $userData = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if (!$userData) {
            return null;
        }

        $user = new static($userData['email'], $userData['password'], $userData['first_name'], $userData['last_name']);
        $user->id = $userData['id'];
        return $user;
    }

    abstract public function save();
    abstract public function delete();

    public function authenticate($email, $password) {
        $db = Database::getInstance()->getConnection();
        $stmt = $db->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([$email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && $password) {
            return $user;
        }
        return false;
    }
}
?>