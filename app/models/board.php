<?php

class Board implements \JsonSerializable {

    private int $board_id;
    private string $board_name;
    private int $total_messages;

    public function jsonSerialize() : mixed {
        return get_object_vars($this);
    }
    
    /**
     * Get the value of id
     *
     * @return int
     */
    public function getId(): int
    {
        return $this->board_id;
    }

public function getBoardName(): string
    {
        return $this->board_name;
    }

    /**
     * Set the value of id
     *
     * @param int $id
     *
     * @return self
     */
    public function setBoardName(string $board_name): self
    {
        $this->board_name = $board_name;

        return $this;
    }
public function getTotalMessages(): int
    {
        return $this->total_messages;
    }
    public function setTotalMessages(int $total_messages): self
    {
        $this->total_messages = $total_messages;

        return $this;
    }
}

?>