<?php

class HomeController {
    public function index() {
        session_start();
        
        // Usuário não logado: mostra página inicial com botão login
        $this->renderView('home');
    }
    
    private function renderView($view) {
        require_once '../src/views/layouts/main.php';
    }
    
    public function about() {
        $pageTitle = 'Sobre o Sistema';
        require_once '../src/views/layouts/main.php';
        require_once '../src/views/about.php';
    }
}