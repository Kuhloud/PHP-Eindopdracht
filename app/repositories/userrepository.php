<?php
require __DIR__ . '/repository.php';
require __DIR__ . '/../models/user.php';

class UserRepository extends Repository
{
        function insert($username, $email , $hashedPassword)
        {
                $stmt = $this->connection->prepare("INSERT into users VALUES (username, email, password, joined_at) 
                VALUES (:username, :email, :password, NOW())");
                $stmt->bindParam(':username', $username);
                $stmt->bindParam(':email', $email);
                $stmt->bindParam(':password', $hashedPassword);

                try
                {
                $stmt->execute();
                }
                catch (PDOException $e)
                {
                echo "Error: " . $e->getMessage();
                }

        }
        function isExistingUsername($username) {
                $stmt = $this->connection->prepare("SELECT * FROM users WHERE username = ?");
                $stmt->execute([$username]);
                if ($stmt->fetchAll()) 
                {
                        return true;
                } else {
                        return false;
                }
        }
        function isExistingEmail($email){
                $stmt = $this->connection->prepare("SELECT * FROM users WHERE email = ?");
                $stmt->execute([$email]);
                if ($stmt->fetchAll()) 
                {
                        return true;
                } else {
                        return false;
                }
        }
}