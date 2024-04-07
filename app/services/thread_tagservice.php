<?php
require __DIR__ . '/../repositories/thread_tagrepository.php';


class Thread_TagService {
    public function getTagsByThreadId($thread_id) {
        // retrieve data
        $repository = new Thread_TagRepository();
        $threadTags = $repository->getTagsByThreadId($thread_id);
        return $threadTags;
    }
    public function addTagToThread($thread_tag) {
        // retrieve data
        $repository = new Thread_TagRepository();
        $repository->addTagToThread($thread_tag->getThreadId(), $thread_tag->getTagId());     
    }
}