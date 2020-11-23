<?php
declare(strict_types=1);

namespace PcComponentes\LexRanking\Position;

use PcComponentes\LexRanking\Token\TokenSet;

abstract class Position
{
    public const DEFAULT_GAP = 8;

    abstract public function next(TokenSet $tokenSet, string $prev, string $next): ?string;
}
