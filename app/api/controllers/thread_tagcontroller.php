<?php
require __DIR__ . '/apicontroller.php';
require __DIR__ . '/../../services/thread_tagservice.php';

class Thread_TagController extends ApiController
{
    private $threadTagService;

    // initialize services
    function __construct()
    {
        $this->threadTagService = new Thread_TagService();
    }

    public function index()
    {
        header("Content-type: application/json");
    
        if ($this->postRequest()) {
            $threadTags = $this->getJsonData();

            if (!isset($threadTags->thread_id, $threadTags->tags)) {
                $this->checkRequiredFields($threadTags->thread_id);
                return;
            }
                $this->handleAddTagsRequest($threadTags->thread_id, $threadTags->tags);
        }
    
        // if ($this->getRequest() && isset($_GET['thread_id'])) {
        //     $this->getTags($_GET['thread_id']);
        // }
    }
    private function handleAddTagsRequest(int $thread_id, array $tags)
    {
        try {
            $thread_tags = $this->addThreadTags($thread_id, $tags);
            echo json_encode(["status" => "success", "thread_id" => $thread_id, "thread_tags" => $thread_tags], JSON_THROW_ON_ERROR);
        } catch (Exception $e) {
            echo json_encode(["status" => "error", "message" => $e->getMessage()], JSON_THROW_ON_ERROR);
        }
    }
    private function addThreadTags(int $thread_id, array $tags)
    {
        $thread_tags = [];
        foreach ($tags as $tag) {
            $thread_tag = new Thread_Tag();
            $thread_tag->setThreadId($thread_id);
            $thread_tag->setTagId($tag->getTagId());
            $this->threadTagService->addTagToThread($thread_tag);
            $thread_tags[] = $thread_tag;
        }
        return $thread_tags;
    }
    
    function getTags(int $thread_id)
    {
        try 
        {
            $tags = $this->threadTagService->getTagsByThreadId($thread_id);
            header("Content-type: application/json");
            echo json_encode($tags);
        } 
        catch (Exception $e) {
            echo json_encode(['error' => $e->getMessage()]);
        }
    }
    private function checkRequiredFields(string $threadTags)
    {
        $requiredFields = ['thread_id', 'tags'];
        $missingFields = [];

        foreach ($requiredFields as $field) {
            if (!isset($threadTags->$field)) 
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