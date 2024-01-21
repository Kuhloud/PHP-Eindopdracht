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
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = htmlspecialchars($_POST['inputUsername']);
            $email = htmlspecialchars($_POST['inputEmail']);
            $password = htmlspecialchars($_POST['inputPassword']);
            $errorMessage = $this->checkForErrors($username, $password, $email);
            if (empty($errorMessage)) {
                $this->userService->insert($username, $password, $email);
                header("Location: /");
            }
        } 
        require __DIR__ . "/../views/user/index.php";
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
        elseif ($this->userService->isExistingUsername($username) == true) {
            $errorMessage = "Username already exists";
        }
        elseif ($this->userService->isExistingEmail($email) == true) {
            $errorMessage = "Email already exists";
        }
        else {
            $errorMessage = "";
        }
        return $errorMessage;
    }
}