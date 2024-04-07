<?php
Class ThreadTag implements \JsonSerializable {

private int $thread_id;
private int $tag_id;

public function jsonSerialize() : mixed {
    return get_object_vars($this);
}
public function getThreadId() {
    return $this->thread_id;
}
public function setThreadId(int $thread_id) {
    $this->thread_id = $thread_id;
}
public function getTagId() {
    return $this->tag_id;
}
public function setTagId(int $tag_id) {
    $this->tag_id = $tag_id;
}
}