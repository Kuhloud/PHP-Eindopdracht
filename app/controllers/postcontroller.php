<?php
require __DIR__ . '/controller.php';
require __DIR__ . '/../services/postservice.php';


class PostController extends Controller {

    private $postService; 

    // initialize services
    function __construct() {
        $this->postService = new PostService();
    }

    // router maps this to /article and /article/index automatically
    public function index() {
        $threadId = $_SESSION['thread_id'];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $postMessage = $this->sanitizeInput($_POST['postMessage']);
            $userId = $_SESSION['user'];

            $post = new Post();
            $post->setThreadId($threadId);
            $post->setUserId($userId);
            $post->setMessage($postMessage);
            $this->postService->insert($post);
        }
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $posts = $this->postService->getPostsByThreadId($threadId);
        }
      
        // Retrieve the previous URL
        require __DIR__ . "/../views/thread/index.php";
    }
}