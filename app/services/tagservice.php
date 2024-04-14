<?php
namespace Services;
use Repositories\TagRepository;


class TagService {

    public function insert($tag) {
        // retrieve data
        $repository = new TagRepository();
        if (!$repository->existingTag($tag->getTagName())) {
            $repository->insert($tag->getTagName()); 
        }
        return $repository->getTagIdByName($tag->getTagName());
    }
}