<?php
require __DIR__ . '/repository.php';
require __DIR__ . '/../models/user.php';

class UserRepository extends Repository
{
        function getUser($userInput)
        {
            try {
                $stmt = $this->connection->prepare("SELECT * FROM users WHERE username = :username OR email = :email");
                $stmt->bindParam(':username', $userInput);
                $stmt->bindParam(':email', $userInput);
                $stmt->execute();
    
                $stmt->setFetchMode(PDO::FETCH_CLASS, 'User');
                return $stmt->fetch();
            } catch (PDOException $e) {
                echo $e;
            }
        }
        function getUsername($userId)
        {
                $stmt = $this->connection->prepare("SELECT username FROM users WHERE user_id = :user_id");
                $stmt->bindParam(':user_id', $userId);
                $stmt->execute();

                $stmt->setFetchMode(PDO::FETCH_COLUMN, 0);
                return $stmt->fetch();
        }
        function insert($user)
        {
                $stmt = $this->connection->prepare("INSERT into users (username, email, password, joined_at) 
                VALUES (:username, :email, :password, NOW())");
                $username = $user->getUsername();
                $email = $user->getEmail();
                $password = $user->getPassword();
                $stmt->bindParam(':username', $username);
                $stmt->bindParam(':email', $email);
                $stmt->bindParam(':password', $password);
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
    function verifyPassword($password, $hashedPassword)
    {
        return password_verify($password, $hashedPassword);
    }
}