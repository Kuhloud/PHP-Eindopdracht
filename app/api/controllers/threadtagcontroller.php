<?php
namespace Api\Controllers;
use Services\ThreadTagService;

class ThreadTagController extends ApiController
{
    private $threadTagService;

    // initialize services
    function __construct()
    {
        $this->threadTagService = new ThreadTagService();
    }

    public function index()
    {
        header("Content-type: application/json");
    
        if ($this->postRequest()) {
            $threadTags = $this->getJsonData();

            if (!isset($threadTags->thread_id, $threadTags->tags)) {
                $this->checkRequiredFields($threadTags);
                return;
            }
            //$this->quickJsonTest($threadTags);
            //$threadTags = $this->databaseTest($threadTags->thread_id, $threadTags->tags);
            $this->handleAddTagsRequest($threadTags->thread_id, $threadTags->tags);
        }
    
        if ($this->getRequest() && isset($_GET['thread_id'])) {
            $this->getTags($_GET['thread_id']);
        }
    }
    private function handleAddTagsRequest(int $thread_id, array $tags)
    {
        try {
            $threadTags = $this->addThreadTags($thread_id, $tags);
            echo json_encode(["status" => "success", "thread_id" => $thread_id, "thread_tags" => $threadTags], JSON_THROW_ON_ERROR);
        } catch (Exception $e) {
            echo json_encode(["status" => "error", "message" => $e->getMessage()], JSON_THROW_ON_ERROR);
        }
    }
    private function addThreadTags(int $thread_id, array $tags)
    {
        $threadTags = [];
        foreach ($tags as $tag) {
            $threadTag = new ThreadTag();
            $threadTag->setThreadId($thread_id);
            $threadTag->setTagId($tag->tag_id);
            $this->threadTagService->addTagToThread($threadTag);
            $threadTags[] = $threadTag;
        }
        if (empty($threadTags)) {
            return;
        }
        return $threadTags;
    }
    
    private function getTags(int $thread_id)
    {
        try 
        {
            $tags = $this->threadTagService->getTagsByThreadId($thread_id);
            if (empty($tags)) {
                echo json_encode([]);
                return;
            }
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