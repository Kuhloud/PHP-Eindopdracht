<?php
class Thread implements \JsonSerializable {

private int $thread_id;
private int $board_id;
private string $title;
private string $description;
private DateTime $created_at;

public function jsonSerialize() : mixed {
    $vars = get_object_vars($this);
    return $vars;
}
public function setBoardId(int $board_id) {
    $this->board_id = $board_id;
}
public function setTitle(string $title) {
    $this->title = $title;
}
public function setDescription(string $description) {
    $this->description = $description;
}
}
