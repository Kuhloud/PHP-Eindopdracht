<?php
require __DIR__ . '/apicontroller.php';
require __DIR__ . '/../../services/tagservice.php';

class TagController extends ApiController
{
    private $tagService;

    // initialize services
    function __construct()
    {
        $this->tagService = new TagService();
    }

    public function index()
    {
        header("Content-type: application/json");
    
        if ($this->postRequest()) {
            $newThread = $this->getJsonData();

            if (!isset($newThread->thread_id, $newThread->tags)) {
                $this->checkRequiredFields($newThread);
                return;
            }
            $this->handleAddTagsRequest($newThread->thread_id, $newThread->tags);
        }
    
        // if ($this->getRequest() && isset($_GET['thread_id'])) {
        //     $this->getTags($_GET['thread_id']);
        // }
    }
    private function handleAddTagsRequest(int $thread_id, array $addedTags)
    {
        try {
            $tags = $this->addTags($addedTags);
            echo json_encode(["status" => "success", "thread_id" => $thread_id, "tags" => $tags], JSON_THROW_ON_ERROR);
        } catch (Exception $e) {
            echo json_encode(["status" => "error", "message" => $e->getMessage()], JSON_THROW_ON_ERROR);
        }
    }
    private function addTags(array $tags)
    {
        $new_tags = [];
        foreach ($tags as $tagName) {
            $tag = new Tag();
            $tag->setTagName($this->sanitizeInput($tagName));
            $tag->setTagId($this->tagService->insert($tag));
            $new_tags[] = $tag;
        }
        return $new_tags;
    }
    
    private function checkRequiredFields(string $newThread)
    {
        $requiredFields = ['thread_id, tags'];
        $missingFields = [];

        foreach ($requiredFields as $field) {
            if (!isset($newThread->$field)) 
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