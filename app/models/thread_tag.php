<?php
abstract class Thread_Tag implements \JsonSerializable {

private int $thread_id;
private string $tag_id;

public function jsonSerialize() : mixed {
    return get_object_vars($this);
}
}