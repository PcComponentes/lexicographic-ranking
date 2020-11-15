<?php declare(strict_types=1);

namespace AdnanMula\LexRanking\Tests\DataProvider;

abstract class DataProvider implements \Iterator
{
    private array $items;
    private int $index;

    protected function __construct(array $items)
    {
        $this->items = $items;
        $this->index = 0;
    }

    public function current(): array
    {
        return $this->items[$this->index];
    }

    public function next(): void
    {
        $this->index++;
    }

    public function key(): int
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
