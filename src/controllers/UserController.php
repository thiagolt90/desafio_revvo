<?php

class UserController extends BaseController {
    public $userModel;

    public function __construct() {
        parent::__construct();
        $this->userModel = new UserModel();
    }

    private function renderView($view, $data = null) {
        $data['currentUser'] = $this->currentUser;
        extract($data);
        require_once __DIR__ . '/../views/layouts/main.php';
    }

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
                $user = $this->userModel->login($email, $password);
                if ($user) {
                    $_SESSION['user_id'] = $user["id"];
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
        if ($this->userModel->isLoggedIn()) {
            header('Location: ' . BASE_URL . '/user/edit');
            exit();
        }

        $this->edit();
    }

    public function edit() {
        $user = null;
        $error = null;
        $message = null;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $result = $this->userModel->saveUser($this->userModel->loggedId(), $_POST);

            if (isset($result["error"])) {
                $error = $result["error"];
            } elseif (isset($result["success"])) {
                $message = "Usuário criado/alterado com sucesso!";
            }
        }

        if ($this->userModel->isLoggedIn()) {
            $user = $this->userModel->getById( $this->userModel->loggedId() );
        }

        $this->renderView('user-edit', compact(
            'error', 'message', 'user'
        ));
    }

    public function logout() {
        $this->userModel->logout();
        header('Location: ' . BASE_URL . '/');
        exit();
    }
    
}
