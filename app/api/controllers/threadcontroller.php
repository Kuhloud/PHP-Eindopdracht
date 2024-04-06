<?php

class ThreadController
{
    private $threadService;

    // initialize services
    function __construct()
    {
        $this->threadService = new ThreadService();
    }

    public function index()
    {
        $currentboard = $_SESSION['currentboard'];
        // Respond to a POST request to /api/thread
        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            // read JSON from the request, convert it to an article object
            // and have the service insert the article into the database
            $json = file_get_contents('php://input');
            $newThread = json_decode($json);

            $title = htmlspecialchars($newThread->title, ENT_QUOTES, 'UTF-8');
            $firstPost = htmlspecialchars($newThread->firstPost, ENT_QUOTES, 'UTF-8');

            $thread = new Thread();
            $thread->setBoardId($currentboard->getBoardId());
            $thread->setTitle($title);
            $thread->setFirstPost($firstPost);
            $thread->setUserId($_SESSION['user']);

            $this->threadService->insert($thread);
            header("Location: ../");
        }
    }
    public function threads()
    {
        if ($_SERVER["REQUEST_METHOD"] == "GET") {
            
            // return the thread as JSON
            $thread = $this->threadService->getThreads($_SESSION['board']->getId());
            header("Content-type: application/json");
            echo json_encode($thread);
        }
    }
}