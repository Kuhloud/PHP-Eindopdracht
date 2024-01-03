<?php
class Thread implements \JsonSerializable {

private int $thread_id;
private int $board_id;
private string $title;
private string $description;
private DateTime $created_at;

public function jsonSerialize() : mixed {
    return get_object_vars($this);
}
}
