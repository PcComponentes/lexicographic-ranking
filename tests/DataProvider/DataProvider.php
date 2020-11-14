<?php declare(strict_types=1);

namespace AdnanMula\LexRanking\Tests\DataProvider;

abstract class DataProvider implements \Iterator
{
    private $items;
    private $index;

    protected function __construct(array $items)
    {
        $this->items = $items;
        $this->index = 0;
    }

    public function current()
    {
        return $this->items[$this->index];
    }

    public function next(): void
    {
        $this->index ++;
    }

    public function key()
    {
        return $this->index;
    }

    public function valid(): bool
    {
        return isset($this->items[$this->key()]);
    }

    public function rewind(): void
    {
        $this->index = 0;
    }
}
