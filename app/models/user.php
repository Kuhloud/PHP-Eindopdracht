<?php
class User implements \JsonSerializable {

private int $user_id;
private string $username;
private string $email;
private string $password;
private DateTime $joined_at;
private int $role_id;

public function __construct($user_id, $username, $email) {
    $this->user_id = $user_id;
    $this->username = $username;
    $this->email = $email;
}

public function jsonSerialize() : mixed {
    return get_object_vars($this);
}
public function getUserId() : int {
    return $this->user_id;
}
public function getUsername() : string {
    return $this->username;
}
public function getEmail() : string {
    return $this->email;
}
public function getPassword() : string {
    return $this->password;
}
public function getJoinedAt() : DateTime {
    return $this->joined_at;
}
}