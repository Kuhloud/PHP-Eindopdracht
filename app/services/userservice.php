<?php
namespace Services;
use Repositories\UserRepository;


class UserService {
    function isValidEmail($email) {
        return filter_var($email, FILTER_VALIDATE_EMAIL);

    }
    function isExistingUsername($username) {
        $repository = new UserRepository();
        return $repository->isExistingUsername($username);
    }
    function isExistingEmail($email)
    {
        $repository = new UserRepository();
        return $repository->isExistingEmail($email);
    }
    public function insert($username, $email, $plainPassword) {
        
        $repository = new UserRepository();

        $hashedPassword = $this->hashPassword($plainPassword);
        $repository->insert($username, $email, $hashedPassword);       
    }
    public function getUser($userInput, $password)
    {
        $repository = new UserRepository();
        return $repository->getUser($userInput, $password);
    }
    public function getUsername($userId)
    {
        $repository = new UserRepository();
        return $repository->getUsername($userId);
    }
    function hashPassword($plainPassword) {
        return password_hash($plainPassword, PASSWORD_DEFAULT);
    }

}