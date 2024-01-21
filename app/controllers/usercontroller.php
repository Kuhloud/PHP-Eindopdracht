<?php
require __DIR__ . '/controller.php';
require __DIR__ . '/../services/userservice.php';

class UserController extends Controller {

    private $userService; 

    // initialize services
    function __construct() {
        $this->userService = new UserService();
    }

    // router maps this to /article and /article/index automatically
    public function index() {
      
    }
    public function login() {

    }
}