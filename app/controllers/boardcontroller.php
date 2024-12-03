<?php
require __DIR__ . '/controller.php';
require __DIR__ . '/../services/boardservice.php';


class BoardController extends Controller {

    private $boardService;

    // initialize services
    function __construct() {
        $this->boardService = new BoardService();
    }
    public function index() {
      
        // retrieve data 
        $boards = $this->boardService->getAll();
    
        // show view, param = accessible as $model in the view
        // displayView maps this to /views/boards/index.php automatically
        $this->displayView($boards);

    }
    
    public function board() {  

        $boardId = $_SESSION['board_id'];
        $board = $this->boardService->getBoardById($boardId);
        $this->currentBoard($board);

        // $threads = $this->threadService->getThreads($board->getId());
        // $this->displayView($threads);
        

        require __DIR__ . "/../views/board/board.php";
    }
    function currentBoard($board)
    {
        $_SESSION['currentboard'] = $board->getBoardName();
    }
    function getBoardByIdWithName($boardName) {
        // retrieve data
        return $this->boardService->getBoardIdWithName($boardName);
    }
    public function getBoardById($boardName) {
        // retrieve data
        return $this->boardService->getBoardById($boardName);
    }
}