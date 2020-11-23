<?php
declare(strict_types=1);

namespace PcComponentes\LexRanking\Position;

use PcComponentes\LexRanking\Exception\InvalidPositionException;
use PcComponentes\LexRanking\Token\TokenSet;

final class FixedEndPosition extends Position
{
    private int $gap;

    public function __construct(int $gap)
    {
        $this->assert($gap);

        $this->gap = $gap;
    }

    public function next(TokenSet $set, string $prev, string $next): ?string
    {
        if ($this->gap > $set->maxIndex()) {
            throw new InvalidPositionException();
        }

        if ($set->getIndex($next) - $this->gap <= $set->getIndex($prev)) {
            return null;
        }

        return $set->getToken($set->getIndex($next) - $this->gap);
    }

    public function assert(int $gap): void
    {
        if (0 >= $gap) {
            throw new InvalidPositionException();
        }
    }
}
