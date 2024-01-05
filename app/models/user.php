<?php
class User implements \JsonSerializable {

private int $user_id;
private string $username;
private string $email;
private string $password;
private DateTime $joined_at;
private int $role_id;

public function __construct($user_id, $username, $email, $password, $joined_at, $role_id) {
    $this->user_id = $user_id;
    $this->username = $username;
    $this->email = $email;
    $this->password = $password;
    $this->joined_at = $joined_at;
    $this->role_id = $role_id;
}

public function jsonSerialize() : mixed {
    return get_object_vars($this);
}
}