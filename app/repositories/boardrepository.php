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

        function insert($board)
        {
                $stmt = $this->connection->prepare("INSERT into boards (board_name) VALUES (?)");

                $stmt->execute([$board->getBoardName()]);

        }
}