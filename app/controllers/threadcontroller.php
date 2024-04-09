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
    public function index()
    {
        $threadId = $_SESSION['thread_id'];
        $thread = $this->threadService->getThreadById($threadId);
        $this->currentThread($thread);
        $this->displayView($thread);
    }
    function currentThread($thread)
    {
        $_SESSION['currentthread'] = $thread;
    }
    public function createthread() {
        
        $currentboard = $_SESSION['currentboard'];
        $boardId = $_SESSION['board_id'];
        $userId = $_SESSION['user_id'];
      
        // Retrieve the previous URL
        require __DIR__ . "/../views/thread/createthread.php";
    }
}