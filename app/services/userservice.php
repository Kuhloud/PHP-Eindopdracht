<?php
require __DIR__ . '/../repositories/userrepository.php';


class UserService {
    function isValidEmail($email) {
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo "The email address is valid.";
        } else {
            echo "The email address is not valid.";
        }
    }
    function isUniqueUsername($username) {
        $repository = new UserRepository();
        $user = $repository->isUniqueUsername($username);
        if ($user) {
            return true;
        } else {
            echo "Username already exists";
        }
    }
    function isUniqueEmail($email)
    {
        $repository = new UserRepository();
        $user = $repository->isUniqueEmail($email);
        if ($user) {
            return true;
        } else {
            echo "Email already exists";
        }
    }
    public function insert($username, $plainPassword, $email) {
        
        $repository = new UserRepository();
        $username = $this->isUniqueUsername($username);
        $email = $this->isUniqueEmail($email);
        $hashedPassword = $this->hashPassword($plainPassword);
        $repository->insert($username, $hashedPassword, $email);       
    }

    function hashPassword($plainPassword) {
        return password_hash($plainPassword, PASSWORD_DEFAULT);
    }
    function verifyPassword($plainPassword) {
        return password_hash($plainPassword, PASSWORD_DEFAULT);
    }

}