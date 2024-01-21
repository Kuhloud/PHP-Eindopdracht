<?php
require __DIR__ . '/controller.php';
require __DIR__ . '/../services/threadservice.php';
require __DIR__ . '/../services/boardservice.php';

class ThreadController extends Controller {

    private $threadService; 
    private $boardService;

    // initialize services
    function __construct() {
        $this->threadService = new ThreadService();
        $this->boardService = new BoardService();
    }

    // router maps this to /article and /article/index automatically
    public function index() {
      
        // Retrieve the previous URL
        $boardUrl = isset($_SESSION['previous_url']) ? $_SESSION['previous_url'] : null;

        $UrlLastPart = explode('/', rtrim($boardUrl , '/'));
        $boardName = end($UrlLastPart);

        // retrieve data 
        $threads = $this->boardService->getBoardIdWithName($boardName);
    
        // show view, param = accessible as $model in the view
        // displayView maps this to /views/boards/index.php automatically
        $this->displayView($threads);

        // Clear the previous URL from the session (optional, depending on your requirements)

        require __DIR__ . "/../views/thread/index.php";
    }
}