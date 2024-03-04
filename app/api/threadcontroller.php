<?php

class ThreadController
{

    private $threadService;

    // initialize services
    function __construct()
    {
        $this->threadService = new ThreadService();
    }

    // router maps this to /api/article automatically
    public function index()
    {
        // Respond to a GET request to /api/article
        if ($_SERVER["REQUEST_METHOD"] == "GET") {

            // return all articles in the database as JSON
            $threads = $this->threadService->getThreads($_SESSION['board']->getId());
            $json = json_encode($threads);
            header("Content-type: application/json");
            echo $json;
        }

        // Respond to a POST request to /api/article
        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            // read JSON from the request, convert it to an article object
            // and have the service insert the article into the database
            $json = file_get_contents('php://input');
            $object = json_decode($json);

            $thread = new Thread();
            $thread->setBoardId($_SESSION['board']->getId());
            $thread->setTitle($object->title);
            $thread->setDescription($object->content);

            $this->threadService->insert($thread);
        }


    }
}