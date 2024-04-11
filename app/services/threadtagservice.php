<?php
namespace Services;
use Repository\ThreadTagRepository;


class ThreadTagService {
    public function getTagsByThreadId(int $thread_id) {
        // retrieve data
        $repository = new ThreadTagRepository();
        $threadTags = $repository->getTagsByThreadId($thread_id);
        return $threadTags;
    }
    public function addTagToThread(ThreadTag $thread_tag) {
        // retrieve data
        $repository = new ThreadTagRepository();
        $repository->addTagToThread($thread_tag->getThreadId(), $thread_tag->getTagId());     
    }
}