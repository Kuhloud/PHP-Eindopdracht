<?php
class User implements \JsonSerializable {

private int $user_id;
private string $username;
private string $email;
private string $password;
private DateTime $joined_at;
private int $role_id;

public function jsonSerialize() : mixed {
    return get_object_vars($this);
}
}