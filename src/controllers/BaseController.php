<?php

abstract class BaseController {
    public $userModel;
    public $currentUser = null;

    public function __construct() {
        $this->userModel = new UserModel();
        $this->loadCurrentUser();
    }

    private function loadCurrentUser() {
        $this->currentUser = $this->userModel->getCurrentUser();
    }
}