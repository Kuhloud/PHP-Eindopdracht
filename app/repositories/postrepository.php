<?php
require __DIR__ . '/repository.php';
require __DIR__ . '/../models/post.php';

class PostRepository extends Repository
{
    function insert($thread_id, $user_id, $message)
    {
            $stmt = $this->connection->prepare("INSERT into posts (thread_id, user_id, message, posted_at) VALUES (:thread_id, :user_id, :message , NOW())");
            $stmt->bindParam(':thread_id', $thread_id);
            $stmt->bindParam(':user_id', $user_id);
            $stmt->bindParam(':message', $message);
            $stmt->execute();

            return $this->connection->lastInsertId();
    }
    }