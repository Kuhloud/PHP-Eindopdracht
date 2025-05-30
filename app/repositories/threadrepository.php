<?php
require __DIR__ . '/repository.php';
require __DIR__ . '/../models/thread.php';

class ThreadRepository extends Repository
{
        function getAllThreads()
        {

                $stmt = $this->connection->prepare("SELECT * FROM threads");
                $stmt->execute();

                $stmt->setFetchMode(PDO::FETCH_CLASS, 'Thread');
                $threads = $stmt->fetchAll();

                return $threads;

        }
        function getThreadsByBoardId($boardId)
        {

                $stmt = $this->connection->prepare("SELECT * FROM threads WHERE board_id = :board_id");
                $stmt->bindParam(':board_id', $boardId);
                $stmt->execute();

                $stmt->setFetchMode(PDO::FETCH_CLASS, 'Thread');
                $threads = $stmt->fetchAll();

                return $threads;

        }
        function getThreadById($threadId)
        {

                $stmt = $this->connection->prepare("SELECT * FROM threads WHERE thread_id = :thread_id");
                $stmt->bindParam(':thread_id', $threadId);
                $stmt->execute();

                $stmt->setFetchMode(PDO::FETCH_CLASS, 'Thread');
                $threads = $stmt->fetch();

                return $threads;
        }

        function insert($board_id, $title, $first_post, $user_id)
        {
                $stmt = $this->connection->prepare("INSERT into threads (board_id, title, first_post, user_id, created_at) VALUES (:board_id, :title, :first_post, :user_id, NOW())");
                $stmt->bindParam(':board_id', $board_id);
                $stmt->bindParam(':title', $title);
                $stmt->bindParam(':first_post', $first_post);
                $stmt->bindParam(':user_id', $user_id);

                $stmt->execute();
                return $this->connection->lastInsertId();
        }
        function deleteThread($thread_id)
        {
            $stmt = $this->connection->prepare("DELETE FROM threads WHERE thread_id = :thread_id");
            $stmt->bindParam(':thread_id', $thread_id);
            $stmt->execute();
        }
        function updatePostCount($threadId, $postCountChange)
        {
            $stmt = $this->connection->prepare("UPDATE threads t JOIN boards b ON t.board_id = b.board_id SET t.post_count = t.post_count + :post_count, b.total_messages = b.total_messages + :post_count WHERE t.thread_id = :thread_id");
            $stmt->bindParam(':thread_id', $threadId);
            $stmt->bindParam(':post_count', $postCountChange);
            $stmt->execute();
        }
    }