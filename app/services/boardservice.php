<?php
require __DIR__ . '/../repositories/boardrepository.php';


class BoardService {
    public function getAll() {
        // retrieve data
        $repository = new BoardRepository();
        $articles = $repository->getAll();
        return $articles;
    }

    public function insert($article) {
        // retrieve data
        $repository = new BoardRepository();
        $repository->insert($article);        
    }
}

?>