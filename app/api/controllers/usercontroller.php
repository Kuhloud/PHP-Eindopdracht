<?php
namespace Api\Controllers;
use Services\UserService;

class UserController extends ApiController {

    private $userService; 

    // initialize services
    function __construct() {
        $this->userService = new UserService();
    }

    // router maps this to /article and /article/index automatically
    public function username() {
        header("Content-type: application/json");
        if (!$this->getRequest() || !isset($_GET['user_id'])) {
        }
        $user_id = $_GET['user_id'];
        $user = $this->userService->getUsername($user_id);
        echo json_encode($user);
    }
}