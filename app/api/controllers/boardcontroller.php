<?php
require __DIR__ . '/../services/threadservice.php';

class BoardController
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

        $threads = $this->threadService->getThreads($board->getId());
        $this->displayView($threads);

        require __DIR__ . "/../views/board/board.php";
    }
}
