<?php
require __DIR__ . '/repository.php';
require __DIR__ . '/../models/user.php';

class UserRepository extends Repository
{
        function getAll()
        {

                $stmt = $this->connection->prepare("SELECT * FROM boards");
                $stmt->execute();

                $stmt->setFetchMode(PDO::FETCH_CLASS, 'Board');
                $boards = $stmt->fetchAll();

                return $boards;

        }
        function getBoardById($boardId)
        {

                $stmt = $this->connection->prepare("SELECT * FROM boards WHERE board_id = ?");
                $stmt->execute([$boardId]);

                $stmt->setFetchMode(PDO::FETCH_CLASS, 'Board');
                $board = $stmt->fetch();

                return $board;

        }
        function getBoardIdWithName(string $boardName)
        {

                $stmt = $this->connection->prepare("SELECT board_id FROM boards WHERE board_name = ?");
                $stmt->execute([$boardName]);

                $stmt->setFetchMode(PDO::FETCH_COLUMN, 0);
                $boardId = $stmt->fetch();

                return $boardId;

        }

        function insert($board)
        {
                $stmt = $this->connection->prepare("INSERT into boards (board_name) VALUES (?)");

                $stmt->execute([$board->getBoardName()]);

        }
}