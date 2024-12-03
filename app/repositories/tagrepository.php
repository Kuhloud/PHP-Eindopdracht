<?php
require __DIR__ . '/repository.php';
require __DIR__ . '/../models/tag.php';

class TagRepository extends Repository
{
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

function insert($tag_name)
{
        try
        {
                $stmt = $this->connection->prepare("INSERT into tags (tag_name) VALUES (:tag_name)");
                $stmt->bindParam(':tag_name', $tag_name);
                $stmt->execute(); 
                
        }
        catch (PDOException $e) 
        {
                echo "Error: " . $e->getMessage();
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