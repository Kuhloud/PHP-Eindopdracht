<?php
require __DIR__ . '/../repositories/threadrepository.php';


class ThreadService {
    public function getThreads($boardId) {
        // retrieve data
        $repository = new ThreadRepository();
        $threads = $repository->getThreads($boardId);
        return $threads;
    }
    public function getThreadById($threadId) {
        // retrieve data
        $repository = new ThreadRepository();
        $thread = $repository->getThreadById($threadId);
        return $thread;
    }

    public function insert($thread) {
        // retrieve data
        $repository = new ThreadRepository();
        $repository->insert($thread->getBoardId(), $thread->getTitle(), $thread->getFirstPost(), $thread->getUserId());        
    }
}
