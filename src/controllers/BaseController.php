<?php

abstract class BaseController {
    protected $userModel;

    public function __construct() {
        $this->userModel = new UserModel();
    }
}