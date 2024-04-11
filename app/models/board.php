<?php
namespace Models;
class Board implements \JsonSerializable {

    private int $board_id;
    private string $board_name;
    private string $board_description;
    private int $total_threads;
    private int $total_messages;

    public function jsonSerialize() : mixed {
        return get_object_vars($this);
    }
    
    /**
     * Get the value of id
     *
     * @return int
     */
    public function getBoardId(): int
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
    public function getBoardDescription(): string
    {
        return $this->board_description;
    }
    public function setBoardDescription(string $board_description): self
    {
        $this->board_description = $board_description;

        return $this;
    }
    public function getTotalThreads(): int
    {
        return $this->total_threads;
    }
    public function setTotalThreads(int $total_threads): self
    {
        $this->total_threads = $total_threads;

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
