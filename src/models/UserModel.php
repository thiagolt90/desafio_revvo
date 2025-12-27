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
            return $user;
        }
        return false;
    }

    public function saveUser($id, $data) {

        $pictureFilename = null;
        if (!empty($_FILES['picture_upload']['name'])) {
            $uploadResult = uploadImage($_FILES['picture_upload'], "user");
            if (isset($uploadResult['error'])) {
                return ['error' => $uploadResult['error']];
            }
            $pictureFilename = $uploadResult['filename'];
        } else {
            $pictureFilename = $data['picture'];
        }

        if ($this->emailExists($id, $data['email'])) {
            return ['error' => 'Email já cadastrado'];
        }

        $hashedPassword = password_hash($data['password'], PASSWORD_DEFAULT);

        if ($id > 0) {
            $sql = "UPDATE users SET 
                    name = ?, email = ?, picture = ?, password = ?
                    WHERE id = ?";

            $stmt = $this->db->prepare($sql);

            if ($stmt->execute([
                $data['name'],
                $data['email'],
                $pictureFilename,
                $hashedPassword,
                $id
            ])) {
                return ['success' => 'Usuário alterado com sucesso!'];
            } else {
                return ['error' => 'Erro ao salvar usuário, tente novamente!'];
            }
        } else {
            $sql = "INSERT INTO users 
                    (name, email, picture, password)
                    VALUES
                    (?, ?, ?, ?)";

            $stmt = $this->db->prepare($sql);

            if ($stmt->execute([
                $data['name'],
                $data['email'],
                $pictureFilename,
                $hashedPassword
            ])) {
                return ['success' => 'Usuário criado com sucesso!'];
            } else {
                return ['error' => 'Erro ao salvar usuário, tente novamente!'];
            }
        }
        
    }

    public function getById($id) {
        $sql = "SELECT * FROM users WHERE id = ?";
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
        return (isset($_SESSION['user_id'])) ? $_SESSION['user_id'] : 0;
    }

    public function loggedName() {
        return (isset($_SESSION['user_name'])) ? $_SESSION['user_name'] : "";
    }

    public function isLoggedIn() {
        return isset($_SESSION['user_id']);
    }

    public function logout() {
        unset($_SESSION['user_id']);
        unset($_SESSION['user_name']);
    }

    private function emailExists($id, $email) {
        $sql = "SELECT id FROM users WHERE email = ? AND id <> ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$email, $id]);
        return $stmt->fetch() !== false;
    }

    public function getCurrentUser() {
        $id = $_SESSION['user_id'] ?? null;
        if (!$id) {
            return null;
        }
        return $this->getById($id);
    }

}
