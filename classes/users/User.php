<?php

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
        // $this->password = password_hash($password, PASSWORD_DEFAULT);
        $this->password = $password;
    }

    public static function getInfoUser($id) {
        try {
            $db = Database::getInstance()->getConnection();
            $stmt = $db->prepare("SELECT * FROM users WHERE id = :id");
            $stmt->execute(['id' => $id]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Erreur lors de la récupération des informations de l'utilisateur : " . $e->getMessage();
            return false;
        }
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

    abstract public function authenticate();

    public function logout() {
        session_start();
        session_unset();
        session_destroy();
    }
}
?>