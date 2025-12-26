<?php

class UserController {
    private $userModel;

    public function __construct() {
        $this->userModel = new UserModel();
    }

    /** Views */
    public function login() {
        if ($this->userModel->isLoggedIn()) {
            header('Location: ' . BASE_URL . '/');
            exit();
        }

        $error = null;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = trim($_POST['email'] ?? '');
            $password = $_POST['password'] ?? '';

            if (empty($email) || empty($password)) {
                $error = 'Preencha todos os campos';
            } else {
                $userId = $this->userModel->login($email, $password);
                if ($userId) {
                    $_SESSION['user_id'] = $userId;
                    header('Location: ' . BASE_URL . '/');
                    exit();
                } else {
                    $error = 'Usuário ou senha inválidos';
                }
            }
        }

        $this->renderView('user-login', compact(
            'error'
        ));
    }

    public function new() {
        $this->edit();
    }

    public function edit() {
        $user = null;
        $error = null;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->saveUser($user['id'], $_POST);
        }

        if ($this->userModel->isLoggedIn()) {
            $user = $this->userModel->getById( $this->userModel->getLoggedId() );
        }

        $this->renderView('user-edit', compact(
            'error', 'user'
        ));
    }
    
    private function renderView($view, $data = null) {
        if ($data != null) {
            extract($data);
        }
        require_once __DIR__ . '/../views/layouts/main.php';
    }

    /** Validações */
    public function isLoggedIn() {
        return isset($_SESSION['user_id']);
    }

    public function getCurrentUserId() {
        return $_SESSION['user_id'] ?? null;
    }

    public function logout() {
        $this->userModel->logout();
        header('Location: ' . BASE_URL . '/');
        exit();
    }

    private function emailExists($id, $email) {
        $sql = "SELECT id FROM users WHERE email = ? AND id <> ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$email, $id]);
        return $stmt->fetch() !== false;
    }
}
