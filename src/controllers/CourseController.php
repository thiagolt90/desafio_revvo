<?php

class CourseController extends BaseController {
    private $courseModel;

    public function __construct() {
        parent::__construct();
        $this->courseModel = new CourseModel();
    }

    private function renderView($view, $data) {
        $data['currentUser'] = $this->currentUser;
        extract($data);
        $pageTitle = ($course['name'] ?? "Novo Curso");
        require_once __DIR__ . '/../views/layouts/main.php';
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

    public function new() {
        $this->edit();
    }

    public function edit($slug = null) {
        $this->userModel->requireLogin();
        $error = null;
        $message = null;
        $course = null;
        $course_id = ($course['id'] ?? 0);

        if ($slug != null) {
            $course = $this->courseModel->getBySlug($slug);
            
            if (!$course) {
                http_response_code(404);
                $pageTitle = 'Curso não encontrado';
                $view = '404';
                require __DIR__ . '/../views/layouts/main.php';
                return;
            } else {
                $course_id = $course['id'];
            }
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $result = $this->courseModel->saveCourse($course_id, $_POST);
            if (isset($result["success"])) {
                $message = $result["success"];
                $slug = $result["slug"];
                if ($course_id == 0) {
                    header('Location: ' . BASE_URL . '/course/' . $slug);
                    exit();
                } else {
                    $course = $this->courseModel->getBySlug($slug);
                }
            } elseif (isset($result["error"])) {
                $error = $result["error"];
            }
        }

        $this->renderView('course-edit', compact(
            'course', 'error', 'message'
        ));
    }
}