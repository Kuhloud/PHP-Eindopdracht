<?php
require __DIR__ . '/../repositories/tagrepository.php';


class TagService {
    public function GetTagsByThreadId($threadid) {
        // retrieve data
        $repository = new TagRepository();
        $threadTags = $repository->GetTagsByThreadId($threadid);
        return $threadTags;
    }
    public function AddTagsToThread($threadid, $tag) {
        // retrieve data
        $repository = new TagRepository();
        if (!$repository->existingTag($tag->getTagName())) {
            $this->insert($tag->getTagName());  
        }  
        $tagId = $repository->getTagById($tag->getTagId());
        $repository->connectTagsToThread($threadid, $tagId);        
    }
    function insert($tagName) {
        // retrieve data
        $repository = new TagRepository();
        $repository->insert($tagName);      
    }
}