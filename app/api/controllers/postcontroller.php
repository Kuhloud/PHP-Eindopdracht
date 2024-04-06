<?php

class PostController
{
    private $postService;

    // initialize services
    function __construct()
    {
        $this->postService = new PostService();
    }

    public function index()
    {

        // Respond to a POST request to /api/post
        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            // read JSON from the request, convert it to an article firstPost
            // and have the service insert the article into the database
            $json = file_get_contents('php://input');
            $firstPost = json_decode($json);

            $resanitizedMessage = htmlspecialchars($firstPost->message, ENT_QUOTES, 'UTF-8');


            $post = new Post();
            $post->setThreadId($firstPost->thread_id);
            $post->setUserId($firstPost->userId);
            $post->setMessage($resanitizedMessage);

            $this->postService->insert($post);
        }
    }
}