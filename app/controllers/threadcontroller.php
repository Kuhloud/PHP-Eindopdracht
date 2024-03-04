<?php
require __DIR__ . '/controller.php';
require __DIR__ . '/../services/threadservice.php';

class ThreadController extends Controller {

    private $threadService; 

    // initialize services
    function __construct() {
        $this->threadService = new ThreadService();
    }

    // router maps this to /article and /article/index automatically
    public function index() {
      
        // Retrieve the previous URL
        require __DIR__ . "/../views/thread/index.php";
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = htmlspecialchars($_POST['inputUsername']);
            $email = htmlspecialchars($_POST['inputEmail']);
            $password = $_POST['inputPassword'];
            $errorMessage = $this->checkForErrors($username, $email, $password);
            if (empty($errorMessage)) {
                $this->threadService->insert($_SESSION['board']->getId());
                $user = $this->userService->getUser($username, $password);
                $this->currentUser($user);
                header("Location: /");
            }
        } 

        
        // retrieve data 


    }
}