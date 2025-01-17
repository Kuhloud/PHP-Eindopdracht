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
        if (isset($_SESSION['idForController'])) {
            $boardId = $_SESSION['idForController'];
        } else {
            echo "No Session";
        }
        $board = $this->boardService->getBoardById($boardId);
        $this->currentBoard($board);

        // $threads = $this->threadService->getThreads($board->getId());
        // $this->displayView($threads);


        require __DIR__ . "/../views/board/index.php";
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