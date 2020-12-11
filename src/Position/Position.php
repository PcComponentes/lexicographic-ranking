<?php
declare(strict_types=1);

namespace PcComponentes\LexRanking\Position;

use PcComponentes\LexRanking\Token\TokenSet;

interface Position
{
    public function next(TokenSet $tokenSet, string $prev, string $next, int $offset): ?string;

    public function availableSpace(TokenSet $tokenSet, string $prev, string $next): int;
}
