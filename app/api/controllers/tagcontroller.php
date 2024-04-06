<?php

class TagController
{
    private $tagService;

    // initialize services
    function __construct()
    {
        $this->tagService = new TagService();
    }

    public function index()
    {
        // Respond to a POST request to /api/thread
        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            // read JSON from the request, convert it to an article object
            // and have the service insert the article into the database
            $json = file_get_contents('php://input');
            $newThread = json_decode($json);

            $tags = explode(",", $newThread->tags);

            if (!empty($tags))
            {
                $this->addTags($tags, $newThread->thread_id);
            }
            header("Location: ../");
        }
        if ($_SERVER["REQUEST_METHOD"] == "GET") {
            $thread_id = $_GET['thread_id'];
            $this->getTags($thread_id);
        }
    }
    function addTags($tags, $thread_id)
    {
        foreach ($tags as $tagName) {
            $tag = new Tag();
            $tag->setTagName(htmlspecialchars($tagName, ENT_QUOTES, 'UTF-8'));
            $this->tagService->addTagsToThread($thread_id, $tag);
        }
    }
    function getTags($thread_id)
    {
        $tags = $this->tagService->getTagsByThreadId($thread_id);
        header("Content-type: application/json");
        echo json_encode($tags);
    }
}