<?php
require __DIR__ . '/repository.php';
require __DIR__ . '/../models/thread_tag.php';

class Thread_TagRepository extends Repository
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
function addTagToThread($thread_id, $tag_id)
{
        try {
                $stmt = $this->connection->prepare("INSERT into thread_tags (thread_id, tag_id) VALUES (:thread_id, :tag_id)");
                $stmt->bindParam(':thread_id', $thread_id);
                $stmt->bindParam(':tag_id', $tag_id);
                $stmt->execute();
                } catch (PDOException $e) {
                echo "Error: " . $e->getMessage();
        }
}
function existingTag($tag_name) {
        $stmt = $this->connection->prepare("SELECT * FROM tags WHERE tag_name = :tag_name");
        $stmt->bindParam(':tag_name', $tag_name);
        $stmt->execute();
        if ($stmt->fetch()) 
        {
                return true;
        } 
        else 
        {
                return false;
        }
}

function getTagIdByName($tag_name)
{
        $stmt = $this->connection->prepare("SELECT tag_id FROM tags WHERE tag_name = :tag_name");
        $stmt->bindParam(':tag_name', $tag_name);
        $stmt->execute();

        $stmt->setFetchMode(PDO::FETCH_COLUMN, 0);
        $tagId = $stmt->fetch();
        return $tagId;
}
}