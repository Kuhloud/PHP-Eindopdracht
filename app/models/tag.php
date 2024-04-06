<?php
class Tag implements \JsonSerializable {

private int $tag_id;
private string $tag_name;

public function jsonSerialize() : mixed {
    return get_object_vars($this);
}
public function setTagName(string $tag_name) {
    $this->tag_name = $tag_name;
}
public function getTagName() {
    return $this->tag_name;
}
public function getTagId() {
    return $this->tag_id;  
}
}