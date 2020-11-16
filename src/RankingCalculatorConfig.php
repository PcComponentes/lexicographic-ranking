<?php declare(strict_types=1);

namespace AdnanMula\LexRanking;

use AdnanMula\LexRanking\Position\Position;
use AdnanMula\LexRanking\Token\TokenSet;

final class RankingCalculatorConfig
{
    private TokenSet $tokenSet;
    private Position $position;

    public function __construct(TokenSet $tokenSet, Position $position)
    {
        $this->tokenSet = $tokenSet;
        $this->position = $position;
    }

    public function tokenSet(): TokenSet
    {
        return $this->tokenSet;
    }

    public function position(): Position
    {
        return $this->position;
    }
}
