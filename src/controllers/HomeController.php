<?php

class HomeController extends BaseController {
    private $courseModel;

    public function __construct() {
        parent::__construct();
        $this->courseModel = new CourseModel();
    }

    public function index() {

        $query = trim($_GET['q'] ?? '');
        if ($query) {
            $courses = $this->courseModel->getRecentCourses($query, 11);
        } else {
            $courses = $this->courseModel->getRecentCourses(null, 11);
        }
        $banners = $this->courseModel->getNewCourses(5);
        
        $this->renderView('home', compact(
            'banners', 'courses'
        ));
    }
    
    private function renderView($view, $data) {
        $data['currentUser'] = $this->currentUser;
        extract($data);
        require_once __DIR__ . '/../views/layouts/main.php';
    }
}