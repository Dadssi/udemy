<?php
class sessionManager {
    public static function init() {
        // configuration sécurisée des cookies de session:
        ini_set('session.cookie_httponly', 1);
        ini_set('session.use_only_cookies', 1);
        ini_set('session.cookie_secure', 1);

        // configuration de la durée de vie :
        ini_set('session.gc_maxlifetime', 3600);
        ini_set('session.cookie_lifetime', 0);

        // Démarre la session si ce n'est pas déjà fait:
        self::start();
        
        // regénère l'ID de session pour plus de sécurité:
        if (session_status() === PHP_SESSION_ACTIVE) {
            session_regenerate_id(true);
        }
    }
    public static function start() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    public static function set($key, $value) {
        self::start();
        $_SESSION[$key] = $value;
    }

    public static function get($key) {
        self::start();
        return $_SESSION[$key] ?? null;
    }

    public static function destroy() {
        self::start();
        session_destroy();
    }

    public static function isAuthenticated() {
        return self::get('user_id') !== null;
    }

    public static function requiredAuth() {
        if (!self::isAuthenticated()) {
            header('Location: ../../public/login.php');
            exit;
        }
    }
}
?>