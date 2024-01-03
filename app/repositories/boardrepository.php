<?php
require __DIR__ . '/repository.php';
require __DIR__ . '/../models/board.php';

class BoardRepository extends Repository
{
        function getAll()
        {

                $stmt = $this->connection->prepare("SELECT * FROM article");
                $stmt->execute();

                $stmt->setFetchMode(PDO::FETCH_CLASS, 'Article');
                $articles = $stmt->fetchAll();

                return $articles;

        }

        function insert($article)
        {
                $stmt = $this->connection->prepare("INSERT into article (title, content, author, posted_at) VALUES (?,?,?, NOW())");

                $stmt->execute([$article->getTitle(), $article->getContent(), $article->getAuthor()]);

        }
}