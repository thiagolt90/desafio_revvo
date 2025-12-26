<?php

class HomeController extends BaseController {
    private $courseModel;

    public function __construct() {
        parent::__construct();
        $this->courseModel = new CourseModel();
    }

    public function index() {
        $courses = $this->courseModel->getRecentCourses(11);
        $banners = $this->courseModel->getNewCourses(5);
        
        $this->renderView('home', compact(
            'banners', 'courses'
        ));
    }
    
    private function renderView($view, $data) {
        extract($data);
        require_once __DIR__ . '/../views/layouts/main.php';
    }
}