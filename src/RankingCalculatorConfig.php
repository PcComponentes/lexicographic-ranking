<?php declare(strict_types=1);

namespace AdnanMula\LexRanking;

use AdnanMula\LexRanking\Exception\InvalidGapException;
use AdnanMula\LexRanking\Token\TokenSet;

final class RankingCalculatorConfig
{
    public const DEFAULT_GAP = 8;

    private $tokenSet;
    private $gap;

    public function __construct(TokenSet $tokenSet, int $gap = self::DEFAULT_GAP)
    {
        $this->tokenSet = $tokenSet;

        if ($gap < 1) {
            throw new InvalidGapException();
        }

        $this->gap = $gap;
    }

    public function tokenSet(): TokenSet
    {
        return $this->tokenSet;
    }

    public function gap(): int
    {
        return $this->gap;
    }
}
