<?php
namespace Repositories;

use PDO;
use PDOException;
use Repositories\Repository;

class ThreadTagRepository extends Repository
{
function getTagsByThreadId($thread_id)
{
        $sql = "SELECT tag_name
                FROM tags t
                JOIN thread_tags th ON t.tag_id = th.tag_id
                WHERE th.thread_id = :thread_id";

        $stmt = $this->connection->prepare($sql);
        $stmt->bindParam(':thread_id', $thread_id);
        $stmt->execute();

        $stmt->setFetchMode(PDO::FETCH_COLUMN, 0);
        $tags = $stmt->fetchAll();
        if (empty($tags)) {
                return null; // or return [];
            }
        return $tags;
}
function addTagToThread(int $thread_id, int $tag_id)
{
        try {
                $stmt = $this->connection->prepare("INSERT into thread_tags (thread_id, tag_id) VALUES (:thread_id, :tag_id)");
                $stmt->bindParam(':thread_id', $thread_id);
                $stmt->bindParam(':tag_id', $tag_id);
                $stmt->execute();

        }
        catch (PDOException $e) {
                throw new Exception("Error adding tag to thread: " . $e->getMessage());
        }
}
}