<?php
require __DIR__ . '/repository.php';
require __DIR__ . '/../models/tag.php';

class TagRepository extends Repository
{
function getTagsByThreadId($thread_id)
{
        $sql = "SELECT *
                FROM tags t
                JOIN thread_tags th ON t.tag_id = th.tag_id
                WHERE th.thread_id = :thread_id";

        $stmt = $this->connection->prepare($sql);
        $stmt->bindParam(':thread_id', $thread_id);
        $stmt->execute();

        $stmt->setFetchMode(PDO::FETCH_CLASS, 'Tag');
        $tags = $stmt->fetchAll();
        return $tags;
}
function connectTagsToThread($threadid, $tag_id)
{
        $stmt = $this->connection->prepare("INSERT into thread_tags (thread_id, tag_id) VALUES (:thread_id, :tag_id)");
        $stmt->bindParam(':thread_id', $threadid);
        $stmt->bindParam(':tag_id', $tag_id);
        $stmt->execute();
}
function existingTag($tag_name) {
        $stmt = $this->connection->prepare("SELECT * FROM tags WHERE tag_name = :tag_name");
        $stmt->bindParam(':tag_name', $tag_name);
        $stmt->execute();
        if ($stmt->fetchAll()) 
        {
                return true;
        } 
        else 
        {
                return false;
        }
}

function insert($tag_name)
{
        $stmt = $this->connection->prepare("INSERT into tags (tag_name) VALUES (:tag_name)");
        $stmt->bindParam('tag_name', $tag_name);
        $stmt->execute();
        
}
function getTagById($tag_id)
{
        $stmt = $this->connection->prepare("SELECT tag_id FROM tags WHERE tag_id = :tag_id");
        $stmt->bindParam(':tag_id', $tag_id);
        $stmt->execute();

        $stmt->setFetchMode(PDO::FETCH_COLUMN, 0);
        $tagId = $stmt->fetch();
        return $tagId;
}
}