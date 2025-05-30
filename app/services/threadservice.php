<?php
require __DIR__ . '/../repositories/threadrepository.php';


class ThreadService {
    public function getAllThreads() {
        // retrieve data
        $repository = new ThreadRepository();
        return $repository->getAllThreads();
    }
    public function getThreadsByBoardId($boardId) {
        // retrieve data
        $repository = new ThreadRepository();
        $threads = $repository->getThreadsByBoardId($boardId);
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
        return $repository->insert($thread->getBoardId(), $thread->getTitle(), $thread->getFirstPost(), $thread->getUserId());
    }
    public function deleteThread($threadId) {
        // retrieve data
        $repository = new ThreadRepository();
        $repository->deleteThread($threadId);
    }
    public function updatePostCount($threadId, $postCountChange) {
        $repository = new ThreadRepository();
        $repository->updatePostCount($threadId, $postCountChange);
    }
}
