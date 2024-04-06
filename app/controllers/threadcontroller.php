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
        
        $currentboard = $_SESSION['currentboard'];
        $userId = $_SESSION['user'];
        // if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        //     // $threadTitle = htmlspecialchars($_POST['ThreadTitle']);
        //     // $threadTags = htmlspecialchars($_POST['ThreadTags']);
        // }
      
        // Retrieve the previous URL
        require __DIR__ . "/../views/thread/index.php";
    }
}