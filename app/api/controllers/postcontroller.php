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
        $firstPost = $this->getJsonData();
    
        if (!isset($firstPost->thread_id, $firstPost->user_id, $firstPost->first_post)) {
            $this->checkRequiredFields($firstPost);
            return;
        }
    
        $resanitizedMessage = $this->sanitizeInput($firstPost->first_post);
    
        $post = new Post();
        $post->setThreadId($firstPost->thread_id);
        $post->setUserId($firstPost->user_id);
        $post->setMessage($resanitizedMessage);
    
        try {
            $post->setPostId($this->postService->insert($post));
            echo json_encode(["status" => "success", "post" => $post], JSON_THROW_ON_ERROR);
        } catch (Exception $e) {
            echo json_encode(["status" => "error", "message" => $e->getMessage()], JSON_THROW_ON_ERROR);
        }
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