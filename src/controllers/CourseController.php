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
        $pageTitle = $course['name'];
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

    public function edit($slug) {
        $this->userModel->requireLogin();
        $error = null;
        $message = null;

        $course = $this->courseModel->getBySlug($slug);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $result = $this->courseModel->saveCourse($course['id'], $_POST);
            if (isset($result["success"])) {
                $message = $result["success"];

                $course = $this->courseModel->getBySlug($slug);
                
            } elseif (isset($result["error"])) {
                $error = $result["error"];
            }
        }
        
        if (!$course) {
            http_response_code(404);
            $pageTitle = 'Curso não encontrado';
            $view = '404';
            require __DIR__ . '/../views/layouts/main.php';
            return;
        }

        $this->renderView('course-edit', compact(
            'course', 'error', 'message'
        ));
    }
}