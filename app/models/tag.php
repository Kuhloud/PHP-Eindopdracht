<?php
abstract class Tag implements \JsonSerializable {

private int $role_id;
private string $role_name;

public function jsonSerialize() : mixed {
    return get_object_vars($this);
}
}