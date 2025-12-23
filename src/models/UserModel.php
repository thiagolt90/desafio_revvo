<?php

class UserModel {

    public function login($email, $password) {
        $db = Database::getInstance();
        $sql = "SELECT id, password FROM users WHERE email = ?";
        $stmt = $db->query($sql, [$email]);
        
        $user = $stmt->fetch();
        if ($user && password_verify($password, $user['password'])) {
            return $user['id'];
        }
        return false;
    }

}
