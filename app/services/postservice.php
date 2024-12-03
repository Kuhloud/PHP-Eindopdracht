<?php
require __DIR__ . '/../repositories/postrepository.php';


class PostService {
    public function insert($post) {
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