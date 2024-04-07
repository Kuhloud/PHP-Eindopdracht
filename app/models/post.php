<?php
class Post implements \JsonSerializable {

private int $post_id;
private int $thread_id;
private int $user_id;
private string $message;
private string $posted_at;

public function jsonSerialize() : mixed {
    return get_object_vars($this);
}
public function setPostId(int $post_id) {
    $this->post_id = $post_id;
}
public function getPostId() {
    return $this->post_id;
}
public function setThreadId(int $thread_id) {
    $this->thread_id = $thread_id;
}
public function getThreadId()
{
    return $this->thread_id;
}
public function setUserId(int $user_id) {
    $this->user_id = $user_id;
}
public function getUserId() {
    return $this->user_id;
}
public function setMessage(string $message) {
    $this->message = $message;
}
public function getMessage() {
    return $this->message;
}
}