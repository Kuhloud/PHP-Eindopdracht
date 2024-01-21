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
        $boardId = isset($_SESSION['board_id']) ? (int)$_SESSION['board_id'] : 0;

        
        // retrieve data 


        require __DIR__ . "/../views/thread/index.php";
    }
}