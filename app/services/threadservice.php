<?php
namespace Services;
use Repositories\ThreadRepository;


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
        $threadId = $repository->insert($thread->getBoardId(), $thread->getTitle(), $thread->getFirstPost(), $thread->getUserId());   
        return $threadId;   
    }
    public function updateReplies($threadId) {
        // retrieve data
        $repository = new ThreadRepository();
        $repository->updateReplies($threadId);
    }
}
