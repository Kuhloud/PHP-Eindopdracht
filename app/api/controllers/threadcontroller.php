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
        if ($this->postRequest()) {
            // read JSON from the request, convert it to a thread object
            // and have the service insert the thread into the database
            $newThread = $this->getJsonData();

            if (!isset($newThread->board_id, $newThread->user_id, $newThread->title, $newThread->first_post)) {
                $this->checkRequiredFields($newThread);
                return;
            }

            $title = $this->sanitizeInput($newThread->title);
            $firstPost = $this->sanitizeInput($newThread->first_post);

            $thread = new Thread();
            $thread->setBoardId($newThread->board_id);
            $thread->setTitle($title);
            $thread->setFirstPost($firstPost);
            $thread->setUserId($newThread->user_id);
            try
            {
                $threadId = $this->threadService->insert($thread);
                $thread->setThreadId($threadId);
                echo json_encode(["status" => "success", "thread" => $thread]);
            } catch (Exception $e) {
                echo json_encode(["status" => "error", "message" => $e->getMessage()]);
            }
        }

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
                "missing_fields" => $missingFields
            ]);
        }
    }
    public function threads()
    {
        if (!$this->getRequest()) {
            return json_encode("error: invalid request");;
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