<?php
require __DIR__ . '/controller.php';
require __DIR__ . '/../services/boardservice.php';

class BoardController extends Controller {

    private $boardService;

    // initialize services
    function __construct() {
        $this->boardService = new BoardService();
    }

    // router maps this to /article and /article/index automatically
    public function index() {
      
        // retrieve data 
        $boards = $this->boardService->getAll();
    
        // show view, param = accessible as $model in the view
        // displayView maps this to /views/boards/index.php automatically
        $this->displayView($boards);
    }
    
    public function board() {  

        $boardId = $_GET['board_id'];

        $board = $this->boardService->getBoardById($boardId);

        require __DIR__ . "/../views/board/board.php";


    }
    public function getBoardIdWithName($boardName) {
        // retrieve data
        return $this->boardService->getBoardIdWithName($boardName);
    }
}