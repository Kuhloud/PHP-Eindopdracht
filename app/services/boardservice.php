<?php
require __DIR__ . '/../repositories/boardrepository.php';


class BoardService {
    public function getAll() {
        // retrieve data
        $repository = new BoardRepository();
        $boards = $repository->getAll();
        return $boards;
    }
    public function getBoardById($boardId) {
        // retrieve data
        $repository = new BoardRepository();
        $board = $repository->getBoardById($boardId);
        return $board;
    }
    public function getBoardIdWithName($boardName) {
        // retrieve data
        $repository = new BoardRepository();
        $boardId = $repository->getBoardIdWithName($boardName);
        return $boardId;
    }
    public function insert($board) {
        // retrieve data
        $repository = new BoardRepository();
        $repository->insert($board);        
    }
    public function updateThreadCount($board_id, $threadCountChange) {
        $repository = new BoardRepository();
        $repository->updateThreadCount($board_id, $threadCountChange);
    }
}