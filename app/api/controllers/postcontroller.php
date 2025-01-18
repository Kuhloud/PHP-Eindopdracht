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
        $message = $this->getJsonData();
        $this->checkRequiredFields($message);
    
        $sanitizedMessage = $this->sanitizeInput($message->message);
    
        $post = new Post();
        $post->setThreadId($message->thread_id);
        $post->setUserId($message->user_id);
        $post->setMessage($sanitizedMessage);
    
        try {
            $post->setPostId($this->postService->insert($post));
            echo json_encode(["status" => "success"], JSON_THROW_ON_ERROR);
        } catch (Exception $e) {
            echo json_encode(["status" => "error", "message" => $e->getMessage()], JSON_THROW_ON_ERROR);
        }
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
        $requiredFields = ['thread_id', 'message', 'user_id'];
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