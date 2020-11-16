<?php declare(strict_types=1);

namespace AdnanMula\LexRanking;

use AdnanMula\LexRanking\Exception\InvalidInputException;
use AdnanMula\LexRanking\Position\Position;
use AdnanMula\LexRanking\Token\TokenSet;

final class RankingCalculator
{
    private TokenSet $tokenSet;
    private Position $position;

    public function __construct(TokenSet $tokenSet, Position $position)
    {
        $this->tokenSet = $tokenSet;
        $this->position = $position;
    }

    public function between(?string $prev, ?string $next): string
    {
        $this->assert($prev, $next);

        $rank = '';
        $i = 0;

        while (true) {
            $prevToken = $prev[$i] ?? $this->tokenSet->minToken();
            $nextToken = $next[$i] ?? $this->tokenSet->maxToken();

            $possibleToken = $this->tokenSet->mid($this->position, $prevToken, $nextToken);

            if (null === $possibleToken) {
                $rank .= $prevToken;
                $i++;

                continue;
            }

            $rank .= $possibleToken;

            break;
        }

        return $rank;
    }

    private function assert(?string $prev, ?string $next): void
    {
        if (null !== $prev && false === $this->tokenSet->isValid($prev)
            || (null !== $next && false === $this->tokenSet->isValid($next))) {
            throw new InvalidInputException();
        }

        if ((null !== $prev || null !== $next) && $prev === $next) {
            throw new InvalidInputException();
        }

        if (null === $prev || null === $next) {
            return;
        }

        $lexicographicOrder = [$prev, $next];
        \natsort($lexicographicOrder);
        $lexicographicOrder = \array_values($lexicographicOrder);

        if ($lexicographicOrder[0] !== $prev || $lexicographicOrder[1] !== $next) {
            throw new InvalidInputException();
        }
    }
}
