<?php

namespace webignition\SfsResultModels;

use webignition\SfsResultInterfaces\ResultInterface;
use webignition\SfsResultInterfaces\ResultSetInterface;

class ResultSet implements ResultSetInterface
{
    private $results = [];
    private $iteratorPosition = 0;

    public function addResult(ResultInterface $result): void
    {
        $this->results[] = $result;
    }

    /**
     * \Iterator methods
     */
    public function rewind()
    {
        $this->iteratorPosition = 0;
    }

    public function current(): ResultInterface
    {
        return $this->results[$this->iteratorPosition];
    }

    public function key()
    {
        return $this->iteratorPosition;
    }

    public function next()
    {
        ++$this->iteratorPosition;
    }

    public function valid()
    {
        return isset($this->results[$this->iteratorPosition]);
    }

    /**
     * \Countable methods
     */
    public function count(): int
    {
        return count($this->results);
    }
}
