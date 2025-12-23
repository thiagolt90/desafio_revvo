<?php

class HomeController {
    private $courseModel;

    public function __construct() {
        $this->courseModel = new CourseModel();
    }

    public function index() {
        session_start();

        $cursos = $this->courseModel->getRecentCourses(11);
        
        $this->renderView('home', compact(
            'cursos'
        ));
    }
    
    private function renderView($view, $data) {
        extract($data);
        require_once __DIR__ . '/../views/layouts/main.php';
    }
}