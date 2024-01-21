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
    public function register() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $username = $_POST['username'];
            $password = $_POST['password'];
            $email = $_POST['email'];
            if (!$this->checkForErrors($username, $password, $email)) {
                $this->userService->insert($username, $password, $email);
                header("Location: /");
            }
        } 
    }
    function checkForErrors($username, $password, $email) {
        if (empty($username)) {
            $errorMessage = "Username is required";
        }
        elseif (empty($email)) {
            $errorMessage = "Email is required";
        }
        elseif (empty($password)) {
            $errorMessage = "Password is required";
        }
        elseif ($this->userService->isValidEmail($email) == false) {
            $errorMessage = "Email is not valid";
        }
        elseif ($this->userService->isUniqueUsername($username) == false) {
            $errorMessage = "Username already exists";
        }
        elseif ($this->userService->isUniqueEmail($email) == false) {
            $errorMessage = "Email already exists";
        }
        else{
            return false;
        }
        echo $errorMessage;
        return true;
    }
}