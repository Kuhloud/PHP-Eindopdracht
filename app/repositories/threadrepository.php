<?php
require __DIR__ . '/repository.php';
require __DIR__ . '/../models/thread.php';

class ThreadRepository extends Repository
{
        function getAll($boardId)
        {

                $stmt = $this->connection->prepare("SELECT * FROM threads WHERE board_id = ?");
                $stmt->execute([$boardId]);

                $stmt->setFetchMode(PDO::FETCH_CLASS, 'Thread');
                $threads = $stmt->fetchAll();

                return $threads;

        }

        function insert($thread)
        {
                $stmt = $this->connection->prepare("INSERT into threads (board_name) VALUES (?)");

                $stmt->execute([$thread->getBoardName()]);

        }
    }