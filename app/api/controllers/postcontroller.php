<?php
require __DIR__ . '/apicontroller.php';
require __DIR__ . '/../../services/postservice.php';

class PostController extends ApiController
{
    private $postService;

    // initialize services
    function __construct()
    {
        $this->postService = new PostService();
    }

    public function index()
    {
        header("Content-type: application/json");

        if (!$this->postRequest()) {
            return;
        }
        $postMessage = $this->getJsonData();
        $this->handlePostRequest($postMessage);
        //$this->quickJsonTest($postMessage->user_id);

    }
    private function handlePostRequest($postMessage)
    {
        try {
            $post = $this->createPost($postMessage);
            echo json_encode(["status" => "success", "thread_id" => $post->getThreadId(), "post" => $post], JSON_THROW_ON_ERROR);
        } catch (Exception $e) {
            echo json_encode(["status" => "error", "message" => $e->getMessage()], JSON_THROW_ON_ERROR);
        }
    }
    private function createPost($postMessage)
    {
        if (!isset($postMessage->thread_id, $postMessage->post, $postMessage->user_id)) {
            $this->checkRequiredFields($postMessage);
            return;
        }
        $resanitizedMessage = $this->sanitizeInput($postMessage->post);
    
        $post = new Post();
        $post->setThreadId($postMessage->thread_id);
        $post->setUserId($postMessage->user_id);
        $post->setMessage($resanitizedMessage);
        $post->setPostId($this->postService->insert($post));

        return $post;
    }
    public function thread()
    {
        header("Content-type: application/json");
        if ($this->getRequest() && isset($_GET['thread_id'])) {
            $threadId = $_GET['thread_id'];
            $posts = $this->postService->getPostsByThreadId($threadId);
            echo json_encode($posts);
        }
    }
    public function user($userId)
    {
        $posts = $this->postService->getPostsByUserId($userId);
        header("Content-type: application/json");
        echo json_encode($posts);
    }
    private function checkRequiredFields($firstPost)
    {
        $requiredFields = ['thread_id', 'user_id', 'first_post'];
        $missingFields = [];

        foreach ($requiredFields as $field) {
            if (!isset($firstPost->$field)) 
            {
                $missingFields[] = $field;
            }
        }

        if (!empty($missingFields)) {
            echo json_encode([
            "status" => "error", 
            "message" => "Missing required fields", 
            "missing_fields" => $missingFields
            ], JSON_THROW_ON_ERROR);
        return;
        }
    }
}