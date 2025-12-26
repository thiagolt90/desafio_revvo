<?php

class UserModel {
    private $db;

    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
    }

    public function login($email, $password) {
        $sql = "SELECT id, email, password FROM users WHERE email = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$email]);
        $user = $stmt->fetch();

        if ($user && password_verify($password, $user['password'])) {
            return $user['id'];
        }
        return false;
    }

    public function getById($id) {
        $sql = "SELECT * FROM courses WHERE id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    public function requireLogin() {
        session_start();
        if (!isset($_SESSION['user_id'])) {
            header('Location: ' . BASE_URL . '/user/login?return=' . urlencode($_SERVER['REQUEST_URI']));
            exit();
        }
    }

    public function loggedId() {
        return ($_SESSION['user_id']) ? $_SESSION['user_id'] : 0;
    }

    public function isLoggedIn() {
        return isset($_SESSION['user_id']);
    }

    public function logout() {
        unset($_SESSION['user_id']);
    }

}
