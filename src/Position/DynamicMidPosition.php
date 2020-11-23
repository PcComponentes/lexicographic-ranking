<?php
declare(strict_types=1);

namespace PcComponentes\LexRanking\Position;

use PcComponentes\LexRanking\Token\TokenSet;

final class DynamicMidPosition extends Position
{
    public function next(TokenSet $set, string $prev, string $next): ?string
    {
        if ($prev === $next || $set->getIndex($prev) === $set->getIndex($next) - 1) {
            return null;
        }

        $midIndex = $set->getIndex($prev) + (int) \floor(($set->getIndex($next) - $set->getIndex($prev)) / 2);

        return $set->getToken($midIndex);
    }
}
