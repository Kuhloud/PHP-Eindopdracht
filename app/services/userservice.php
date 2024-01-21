<?php
require __DIR__ . '/../repositories/userrepository.php';


class UserService {
    function isValidEmail($email) {
        return filter_var($email, FILTER_VALIDATE_EMAIL);

    }
    function isUniqueUsername($username) {
        $repository = new UserRepository();
        return $repository->isUniqueUsername($username);
    }
    function isUniqueEmail($email)
    {
        $repository = new UserRepository();
        return $repository->isUniqueEmail($email);
    }
    public function insert($username, $plainPassword, $email) {
        
        $repository = new UserRepository();

        $hashedPassword = $this->hashPassword($plainPassword);
        $repository->insert($username, $hashedPassword, $email);       
    }

    function hashPassword($plainPassword) {
        return password_hash($plainPassword, PASSWORD_DEFAULT);
    }

}