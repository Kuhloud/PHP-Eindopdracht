<?php
require __DIR__ . '/../repositories/boardrepository.php';


class BoardService {
    public function getAll() {
        // retrieve data
        $repository = new BoardRepository();
        $boards = $repository->getAll();
        return $boards;
    }

    public function insert($board) {
        // retrieve data
        $repository = new BoardRepository();
        $repository->insert($board);        
    }
}

?>