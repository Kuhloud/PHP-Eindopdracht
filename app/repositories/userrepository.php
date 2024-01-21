<?php
require __DIR__ . '/repository.php';
require __DIR__ . '/../models/user.php';

class UserRepository extends Repository
{
        function insert($username, $password, $email)
        {
                $stmt = $this->connection->prepare("INSERT into users VALUES (username, email, password, joined_at) 
                VALUES (:username, :email, :password, now())");
                $stmt->bindParam(':username', $username);
                $stmt->bindParam(':email', $email);
                $stmt->bindParam(':password', $password);

                $stmt->execute();

        }
        function isUniqueUsername($username) {
                $stmt = $this->connection->prepare("SELECT * FROM users WHERE username = ?");
                $stmt->execute([$username]);
                $result = $stmt->get_result();
                return $result->num_rows === 0;
        }
        function isUniqueEmail($email){
                $stmt = $this->connection->prepare("SELECT * FROM users WHERE email = ?");
                $stmt->execute([$email]);
                $result = $stmt->get_result();
                return $result->num_rows === 0;
        }
}