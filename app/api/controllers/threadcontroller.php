<?php
require __DIR__ . '/apicontroller.php';
require __DIR__ . '/../../services/threadservice.php';

class ThreadController extends ApiController
{
    private $threadService;

    // initialize services
    function __construct()
    {
        $this->threadService = new ThreadService();
    }

    public function index()
    {
        header("Content-type: application/json");
        // Respond to a POST request to /api/thread
        if (!$this->postRequest()) {
            return;
        }
        // read JSON from the request, convert it to a thread object
        $newThread = $this->getJsonData();
        $this->checkRequiredFields($newThread);

        $title = $this->sanitizeInput($newThread->title);
        $firstPost = $this->sanitizeInput($newThread->first_post);

        $thread = new Thread();
        $thread->setBoardId($newThread->board_id);
        $thread->setTitle($title);
        $thread->setFirstPost($firstPost);
        $thread->setUserId($newThread->user_id);
        // and have the service insert the thread into the database
        try
        {
            $threadId = $this->threadService->insert($thread);
            $thread = $this->threadService->getThreadById($threadId);
            $thread->setThreadId($threadId);
            echo json_encode(["status" => "success", "thread" => $thread]);
        } catch (Exception $e) {
            echo json_encode(["status" => "error", "message" => $e->getMessage()]);
        }
    }
    public function updateCount()
    {
        header("Content-type: application/json");
        // Respond to a PUT request to /api/thread
        if (!$this->putRequest()) {
            return;
        }
        $threadId = $_GET['thread_id'];
        $postCountChange = $this->getJsonData();
        $this->threadService->updatePostCount($threadId, $postCountChange->post_count);
    }
    public function delete()
    {
        if (!$this->deleteRequest()) {
            return;
        }
        $threadId = $_GET['thread_id'];
        $this->threadService->deleteThread($threadId);
        echo json_encode([
            "status" => "success",
            "message" => "Thread deleted"
        ]);
    }
    private function checkRequiredFields($newThread)
    {
        $requiredFields = ['board_id', 'user_id', 'title', 'first_post'];
        $missingFields = [];

        foreach ($requiredFields as $field) {
            if (!isset($newThread->$field)) {
                $missingFields[] = $field;
            }
        }

        if (!empty($missingFields)) {
            echo json_encode([
                "status" => "error",
                "message" => "Missing required fields",
//                "missing_fields" => $missingFields
            ]);
        }
    }
    public function threads()
    {
        if (!$this->getRequest()) {
            return;
        }
        try 
        {
            $boardId = $_GET['board_id'];
            // return the thread as JSON
            $thread = $this->threadService->getThreadsByBoardId($boardId);
            header("Content-type: application/json");
            echo json_encode($thread);
        } catch (Exception $e) {
            echo json_encode(['error' => $e->getMessage()]);
        }
    }
}