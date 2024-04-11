<?php
namespace Services;
use Repository\PostRepository;


class PostService {
    public function insert(Post $post) {
        // retrieve data
        $repository = new PostRepository();
        return $repository->insert($post->getThreadId(), $post->getUserId(), $post->getMessage());        
    }
    public function getPostsByThreadId($threadId) {
        // retrieve data
        $repository = new PostRepository();
        $posts = $repository->getPostsByThreadId($threadId);
        return $posts;
    }
}