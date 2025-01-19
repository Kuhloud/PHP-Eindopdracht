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
    public function signin() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $this->sanitizeInput($_POST['inputUsername']);
            $email = $this->sanitizeInput($_POST['inputEmail']);
            $password = $_POST['inputPassword'];
            $errorMessage = $this->checkValidSignupInput($username, $email, $password);
            if (empty($errorMessage)) {
                $this->userService->insert($username, $email, $password);
                $errorMessage = $this->getUser($username, $password);
            }
        } 
        require __DIR__ . "/../views/user/index.php";
    }
    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $input = $this->sanitizeInput($_POST['UserInput']);
            $password = $_POST['UserPassword'];
            $errorMessage = $this->checkValidLoginInput($input, $password);
            if (empty($errorMessage)) {
                $errorMessage = $this->getUser($input, $password);
            }
        } 
        require __DIR__ . "/../views/user/login.php";
    }
    function getUser($input, $password)
    {
        try {
            $usernameOrEmail = $this->checkIfEmail($input);
            $user = $this->userService->getUser($usernameOrEmail, $password);
            if ($user == null) {
                return "Invalid username or password";
            }
            $this->currentUser($user);
            header("Location: /");
        }
        catch (Exception $e) {

        }
    }

    public function logout()
    {
        session_destroy();
        header("Location: /");
    }
    function currentUser($user)
    {
        $_SESSION['user'] = $user->getUserId();
        $_SESSION['username'] = $user->getUsername();
        $_SESSION['user_role'] = $user->getRoleId();
    }
    function checkValidLoginInput($input, $password) {
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
    public function checkIfEmail($loginInput) {
        $sanitizedUsername = filter_var($loginInput, FILTER_SANITIZE_EMAIL);
        if (filter_var($loginInput, FILTER_VALIDATE_EMAIL)) {
            return $sanitizedUsername;
        }
        return htmlspecialchars($loginInput, ENT_QUOTES, 'UTF-8');
    }
    function checkValidSignupInput($username, $email, $password) {
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