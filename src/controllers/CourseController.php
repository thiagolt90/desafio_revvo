<?php

class CourseController extends BaseController {
    private $courseModel;

    public function __construct() {
        parent::__construct();
        $this->courseModel = new CourseModel();
    }

    public function viewSlug($slug) {
        $course = $this->courseModel->getBySlug($slug);
        if (!$course) {
            http_response_code(404);
            $pageTitle = 'Curso não encontrado';
            $view = '404';
            require __DIR__ . '/../views/layouts/main.php';
            return;
        }

        $banners = array($course);

        $this->renderView('course', compact(
            'banners', 'course'
        ));
    }
    
    private function renderView($view, $data) {
        extract($data);
        require_once __DIR__ . '/../views/layouts/main.php';
    }

    public function edit($slug) {
        $this->userModel->requireLogin();

        $course = $this->courseModel->getBySlug($slug);
        if (!$course) {
            http_response_code(404);
            $pageTitle = 'Curso não encontrado';
            $view = '404';
            require __DIR__ . '/../views/layouts/main.php';
            return;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if ($this->saveCourse($course['id'], $_POST)) {
                header('Location: ' . BASE_URL . '/course/' . $slug);
                exit();
            }
        }

        $pageTitle = 'Editar: ' . $course['name'];
        $view = 'course-edit';
        require __DIR__ . '/../views/layouts/main.php';
    }

    private function saveCourse($id, $data) {
        $this->userModel->requireLogin();

        if ($id > 0) {
            $sql = "UPDATE courses SET 
                    name = ?, description = ?, slug = ?, is_new = ?, picture = ?
                    WHERE id = ?";

            $stmt = $this->db->prepare($sql);

            return $stmt->execute([
                $data['name'],
                $data['description'],
                $data['slug'], 
                isset($data['is_new']) ? 1 : 0,
                $data['picture'] ?? null,
                $id
            ]);
        } else {
            $sql = "INSERT INTO courses 
                    (name, description, slug, is_new, picture)
                    VALUES
                    (?, ?, ?, ?, ?)";

            $stmt = $this->db->prepare($sql);

            return $stmt->execute([
                $data['name'],
                $data['description'],
                $data['slug'], 
                isset($data['is_new']) ? 1 : 0,
                $data['picture'] ?? null
            ]);
        }
        
    }


}