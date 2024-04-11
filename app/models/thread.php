<?php
namespace Models;
class Thread implements \JsonSerializable {

private int $thread_id;
private int $board_id;
private int $user_id;
private string $title;
private string $first_post;
private int $post_count;
private string $created_at;

public function jsonSerialize() : mixed {
    $vars = get_object_vars($this);
    return $vars;
}
public function setThreadId(int $thread_id) {
    $this->thread_id = $thread_id;
}
public function getThreadId() {
    return $this->thread_id;
}
public function setBoardId(int $board_id) {
    $this->board_id = $board_id;
}
public function getBoardId() {
    return $this->board_id;
}
public function setUserId(int $user_id) {
    $this->user_id = $user_id;
}
public function getUserId()
{
    return $this->user_id;
}
public function setTitle(string $title) {
    $this->title = $title;
}
public function getTitle() {
    return $this->title;
}
public function setFirstPost(string $first_post) {
    $this->first_post = $first_post;
}
public function getFirstPost() {
    return $this->first_post;
}
public function getPostCount() {
    return $this->post_count;
}
}