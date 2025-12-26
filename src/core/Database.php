<?php

class Database {
    private static $instance = null;
    private $pdo;
    
    private function __construct() {
        $db_config = require_once __DIR__ . '/../config/database.php';
        $dsn = "mysql:host={$db_config['host']};dbname={$db_config['dbname']};charset={$db_config['charset']}";
        $options = [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES   => false,
        ];

        try {
            $this->pdo = new PDO($dsn, $db_config['username'], $db_config['password'], $options);
        } catch (PDOException $e) {
            die("Erro de conexão: " . $e->getMessage());
        }
    }

    public static function getInstance() {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function getConnection() {
        return $this->pdo;
    }

    // Query helper com prepared statements
    public function query($sql, $params = []) {
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($params);
        return $stmt;
    }

    private function __clone() {}
    public function __wakeup() {
        throw new \Exception("Não é possível desserializar singleton");
    }
}