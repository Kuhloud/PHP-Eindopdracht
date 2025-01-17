<?php
require __DIR__ . '/controller.php';
require __DIR__ . '/../services/threadservice.php';


class ThreadController extends Controller {

    private $threadService; 

    // initialize services
    function __construct() {
        $this->threadService = new ThreadService();
    }
    public function index()
    {
        $threadId = $_SESSION['idForController'];
        $thread = $this->threadService->getThreadById($threadId);
        $this->currentThread($thread);
        $this->displayView($thread);
    }
    function currentThread($thread)
    {
        $_SESSION['currentthread'] = $thread;
    }
    public function create() {
        
        $currentboard = $_SESSION['currentboard'];
        $boardId = $_SESSION['idForController'];
        $userId = $_SESSION['user'];
      
        // Retrieve the previous URL
        require __DIR__ . "/../views/thread/create.php";
    }
}