<?php

require __DIR__ . '/apicontroller.php';
require __DIR__ . '/../../services/boardservice.php';


class BoardController extends ApiController
{
    private $boardService;

    // initialize services
    function __construct()
    {
        $this->boardService = new BoardService();
    }
    public function updateThreadCount()
    {
        header("Content-type: application/json");
        // Respond to a PUT request to /api/thread
        if (!$this->putRequest()) {
            return;
        }
        $boardId = $_GET['board_id'];
        $threadCountChange = $this->getJsonData();
        $this->boardService->updateThreadCount($boardId, $threadCountChange->thread_count);
    }
}