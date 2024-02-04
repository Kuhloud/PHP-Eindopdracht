<?php
require __DIR__ . '/repository.php';
require __DIR__ . '/../models/user.php';

class UserRepository extends Repository
{
        function getUser($userInput, $password)
        {
            try {
                $stmt = $this->connection->prepare("SELECT * FROM users WHERE username = :username OR email = :email AND password = :password");
                $stmt->bindParam(':username', $userInput);
                $stmt->bindParam(':email', $userInput);
                $stmt->bindParam(':password', $password);
                $stmt->execute();
    
                $stmt->setFetchMode(PDO::FETCH_CLASS, 'User');
                $user = $stmt->fetch();
    
                return $user;
            } catch (PDOException $e) {
                echo $e;
            }
        }
        function insert($user)
        {
                $stmt = $this->connection->prepare("INSERT into users (username, email, password, joined_at) 
                VALUES (:username, :email, :password, NOW())");
                $stmt->bindParam(':username', $user->getUsername());
                $stmt->bindParam(':email', $user->getEmail());
                $stmt->bindParam(':password', $user->getPassword());

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