<?php

class CourseModel {
    private $db;

    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
    }

    public function getRecentCourses($limit = 10) {
        $sql = "SELECT id, name, description, slug, is_new, picture, created_at
                FROM courses 
                ORDER BY created_at DESC 
                LIMIT :limit";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getNewCourses($limit = 5) {
        $sql = "SELECT id, name, description, slug, is_new, picture, created_at
                FROM courses 
                WHERE is_new = 1
                ORDER BY created_at DESC 
                LIMIT :limit";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getBySlug($slug) {
        $sql = "SELECT * FROM courses WHERE slug = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$slug]);
        return $stmt->fetch();
    }
}
