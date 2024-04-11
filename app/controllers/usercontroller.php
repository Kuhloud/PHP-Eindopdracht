<?php
namespace Controllers;
use Services\UserService;

class UserController extends Controller {

    private $userService; 

    // initialize services
    function __construct() {
        $this->userService = new UserService();
    }

    // router maps this to /article and /article/index automatically
    public function signin() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $this->sanitizeInput($_POST['inputUsername']);
            $email = $this->sanitizeInput($_POST['inputEmail']);
            $password = $_POST['inputPassword'];
            $errorMessage = $this->checkForErrors($username, $email, $password);
            if (empty($errorMessage)) {
                $this->userService->insert($username, $email, $password);
                $user = $this->userService->getUser($username, $password);
                $this->currentUser($user);
                header("Location: /");
            }
        } 
        require __DIR__ . "/../views/user/index.php";
    }
    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $input = $this->sanitizeInput($_POST['UserInput']);
            $password = $_POST['UserPassword'];
            $errorMessage = $this->checkValidUser($input, $password);
            if (empty($errorMessage)) {
                $user = $this->userService->getUser($input, $password);
                $this->currentUser($user);
                header("Location: /");
            }
        } 
        require __DIR__ . "/../views/user/login.php";
    }

    public function logout()
    {
        session_destroy();
        header("Location: /");
    }
    function checkValidUser($input, $password) {
        if (empty($input)) {
            $errorMessage = "Username/Email address is required";
        }
        elseif (empty($password)) {
            $errorMessage = "Password is required";
        }
        else {
            $errorMessage = "";
        }
        return $errorMessage;
    }
    function checkForErrors($username, $email, $password) {
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