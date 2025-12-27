<?php

class CourseModel {
    private $db;

    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
    }

    public function getRecentCourses($search = null, $limit = 10) {

        $search_str = "";
        $searchTerm = "";
        if ($search != null) {
            $search_str = "WHERE name LIKE :name OR slug LIKE :slug OR description LIKE :description";
            $searchTerm = '%' . $search . '%';
        }

        $sql = "SELECT id, name, description, slug, is_new, picture, created_at
                FROM courses
                " . $search_str . "
                ORDER BY created_at DESC 
                LIMIT :limit";
                
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        if ($search != null) {
            $stmt->bindValue(':name', $searchTerm, PDO::PARAM_STR);
            $stmt->bindValue(':slug', $searchTerm, PDO::PARAM_STR);
            $stmt->bindValue(':description', $searchTerm, PDO::PARAM_STR);
        }
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

    public function saveCourse($id, $data) {
        $pictureFilename = null;
        
        if (!empty($_FILES['picture_upload']['name'])) {
            $uploadResult = uploadImage($_FILES['picture_upload'], "course");
            if (isset($uploadResult['error'])) {
                return ['error' => $uploadResult['error']];
            }
            $pictureFilename = $uploadResult['filename'];
        } else {
            $pictureFilename = $data['picture'];
        }

        $slug = $data['slug'] ?? $this->generateSlug($data['name']);

        if ($this->slugExists($id, $slug)) {
            return ['error' => 'Slug já existe'];
        }

        if ($id > 0) {
            $sql = "UPDATE courses SET 
                    name = ?, description = ?, slug = ?, is_new = ?, picture = ?
                    WHERE id = ?";

            $stmt = $this->db->prepare($sql);

            if ($stmt->execute([
                $data['name'],
                $data['description'],
                $slug, 
                isset($data['is_new']) ? 1 : 0,
                $pictureFilename,
                $id
            ]) !== false) {
                return ['success' => 'Curso atualizado com sucesso!'];
            } else {
                return ['error' => 'Problemas ao atualizar curso, tente novamente.'];
            }
        } else {
            $sql = "INSERT INTO courses 
                    (name, description, slug, is_new, picture)
                    VALUES
                    (?, ?, ?, ?, ?)";

            $stmt = $this->db->prepare($sql);

            if ($stmt->execute([
                $data['name'],
                $data['description'],
                $slug, 
                isset($data['is_new']) ? 1 : 0,
                $pictureFilename
            ]) !== false) {
                return ['success' => 'Curso criado com sucesso!'];
            } else {
                return ['error' => 'Problemas ao criar curso, tente novamente.'];
            }
        }
        
    }

    private function generateSlug($name) {
        $slug = strtolower(preg_replace('/[^a-z0-9]+/', '-', $name));
        $slug = trim($slug, '-');
        return $slug ?: 'curso-' . time();
    }

    private function slugExists($id, $slug) {
        $sql = "SELECT id FROM courses WHERE slug = ? AND id != ?";
        $params = [$slug, $id];
        $stmt = $this->db->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetch() !== false;
    }
}
