<?php
class Post implements \JsonSerializable {

private int $post_id;
private int $thread_id;
private int $user_id;
private string $message;
private DateTime $posted_at;

public function jsonSerialize() : mixed {
    return get_object_vars($this);
}
}