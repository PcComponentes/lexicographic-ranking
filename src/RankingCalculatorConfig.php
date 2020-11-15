<?php declare(strict_types=1);

namespace AdnanMula\LexRanking;

use AdnanMula\LexRanking\Gap\Gap;
use AdnanMula\LexRanking\Token\TokenSet;

final class RankingCalculatorConfig
{
    private TokenSet $tokenSet;
    private Gap $gap;

    public function __construct(TokenSet $tokenSet, Gap $gap)
    {
        $this->tokenSet = $tokenSet;
        $this->gap = $gap;
    }

    public function tokenSet(): TokenSet
    {
        return $this->tokenSet;
    }

    public function gap(): Gap
    {
        return $this->gap;
    }
}
