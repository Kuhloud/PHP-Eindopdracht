<?php
require __DIR__ . '/apicontroller.php';
require __DIR__ . '/../services/threadservice.php';

class BoardController extends ApiController
{
    private $threadService;

    // initialize services
    function __construct()
    {
        $this->threadService = new ThreadService();
    }
    public function board()
    {
        $boardId = $_SESSION['board_id'];

        $threads = $this->threadService->getThreadsByBoardId($board->getId());
        $this->displayView($threads);

        require __DIR__ . "/../views/board/board.php";
    }
}
