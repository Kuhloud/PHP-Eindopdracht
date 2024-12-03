<?php
require __DIR__ . '/repository.php';
require __DIR__ . '/../models/board.php';

class BoardRepository extends Repository
{
        function getAll()
        {

                $stmt = $this->connection->prepare("SELECT * FROM boards");
                $stmt->execute();

                $stmt->setFetchMode(PDO::FETCH_CLASS, 'Board');
                $boards = $stmt->fetchAll();

                return $boards;

        }
        function getBoardById(int $boardId)
        {

                $stmt = $this->connection->prepare("SELECT * FROM boards WHERE board_id = :boardId");
                $stmt->bindParam(':boardId', $boardId);
                $stmt->execute();

                $stmt->setFetchMode(PDO::FETCH_CLASS, 'Board');
                $board = $stmt->fetch();

                return $board;

        }
        function getBoardIdWithName(string $boardName)
        {

                $stmt = $this->connection->prepare("SELECT board_id FROM boards WHERE board_name = :boardName");
                $stmt->bindParam(':boardName', $boardName);
                $stmt->execute();

                $stmt->setFetchMode(PDO::FETCH_COLUMN, 0);
                $boardId = $stmt->fetch();

                return $boardId;

        }

        function insert($board)
        {
                $stmt = $this->connection->prepare("INSERT into boards (board_name, board_description) VALUES (:boardName, :boardDescription)");
                $stmt->bindParam(':boardName', $board->getBoardName());
                $stmt->bindParam(':boardDescription', $board->getBoardDescription());

                $stmt->execute([$board->getBoardName()]);

        }
}