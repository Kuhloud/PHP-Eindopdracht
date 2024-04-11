<?php
namespace Models;
class User {

private int $user_id;
private string $username;
private string $email;
private string $password;
private string $joined_at;
private int $role_id;

public function getUserId() : int {
    return $this->user_id;
}
public function getUsername() : string {
    return $this->username;
}
public function setUsername(string $username) {
    $this->username = $username;
}
public function getEmail() : string {
    return $this->email;
}
public function setEmail(string $email) {
    $this->email = $email;
}
public function getPassword() : string {
    return $this->password;
}
public function setPassword(string $password) {
    $this->password = $password;
}
public function getJoinedAt() : string {
    return $this->joined_at;
}
public function getRoleId() : int {
    return $this->role_id;
}
}