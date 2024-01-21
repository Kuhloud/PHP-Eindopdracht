<?php
require __DIR__ . '/../repositories/threadrepository.php';


class ThreadService {
    public function getAll($boardId) {
        // retrieve data
        $repository = new ThreadRepository();
        $threads = $repository->getAll($boardId);
        return $threads;
    }

    public function insert($thread) {
        // retrieve data
        $repository = new ThreadRepository();
        $repository->insert($thread);        
    }
}
