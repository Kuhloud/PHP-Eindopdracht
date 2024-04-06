<?php
require __DIR__ . '/repository.php';
require __DIR__ . '/../models/post.php';

class PostRepository extends Repository
{
    function getTagByName($tag_name)
    {
        $stmt = $this->connection->prepare("SELECT * FROM tags WHERE tag_name = :tag_name");
        $stmt->bindParam(':tag_name', $tag_name);
        $stmt->execute();

        $stmt->setFetchMode(PDO::FETCH_CLASS, 'Tag');
        $tag = $stmt->fetch();
        return $tag;
    }
    function connectTagsToThread($threadid, $tag)
    {
            $stmt = $this->connection->prepare("INSERT into thread_tags (thread_id, tag_id) VALUES (:thread_id, :tag_id)");
            $stmt->bindParam(':thread_id', $threadid);
            $stmt->bindParam(':tag_id', $tag->getTagId());
            $stmt->execute();
    }
    function insert($post)
    {
            $stmt = $this->connection->prepare("INSERT into post (thread_id, user_id, message) VALUES (:thread_id, :user_id, :message)");
            $stmt->bindParam(':thread_id', $post->getThreadId());
            $stmt->bindParam(':user_id', $post->getUserId());
            $stmt->bindParam(':message', $post->getMessage());
            $stmt->execute();
    }
    }