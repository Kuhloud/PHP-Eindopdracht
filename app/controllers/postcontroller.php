<?php
require __DIR__ . '/controller.php';
require __DIR__ . '/../services/threadservice.php';


class PostController extends Controller {

    private $threadService; 

    // initialize services
    function __construct() {
        $this->threadService = new ThreadService();
    }

    // router maps this to /article and /article/index automatically
    public function index() {
        
        $currentboard = $_SESSION['currentboard'];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $postMessage = $this->sanitizeInput($_POST['postMessage']);
            $threadId = $_SESSION['thread_id'];
            $userId = $_SESSION['user'];
        } 
      
        // Retrieve the previous URL
        require __DIR__ . "/../views/thread/index.php";
    }
}