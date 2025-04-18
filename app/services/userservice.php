<?php
require __DIR__ . '/../repositories/userrepository.php';


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
        $user = $this->createUser($username, $email, $hashedPassword);
        $repository->insert($user);       
    }
    function createUser($username, $email, $password) {
        $user = new User();
        $user->setUsername($username);
        $user->setEmail($email);
        $user->setPassword($password);
        return $user;
    }
    public function getUser($userInput, $password)
    {
        $repository = new UserRepository();
        $user = $repository->getUser($userInput);
        if (!$user || !$repository->verifyPassword($password, $user->getPassword())) {
            return false;
        }
        $user->setPassword("");
        return $user;
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