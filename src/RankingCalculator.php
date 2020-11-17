<?php declare(strict_types=1);

namespace PcComponentes\LexRanking;

use PcComponentes\LexRanking\Exception\InvalidInputException;
use PcComponentes\LexRanking\Exception\InvalidPositionException;
use PcComponentes\LexRanking\Position\Position;
use PcComponentes\LexRanking\Token\TokenSet;

final class RankingCalculator
{
    private TokenSet $tokenSet;
    private Position $position;

    public function __construct(TokenSet $tokenSet, Position $position)
    {
        if ($position->gap() > $tokenSet->maxIndex()) {
            throw new InvalidPositionException();
        }

        $this->tokenSet = $tokenSet;
        $this->position = $position;
    }

    public function between(?string $prev, ?string $next): string
    {
        $prev ??= $this->tokenSet->minToken();
        $next ??= \str_repeat($this->tokenSet->maxToken(), \strlen($prev));

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

    private function assert(string $prev, string $next): void
    {
        if (false === $this->tokenSet->isValid($prev) || (false === $this->tokenSet->isValid($next))) {
            throw new InvalidInputException();
        }

        if ($prev === $next) {
            throw new InvalidInputException();
        }

        $lexicographicOrder = [$prev, $next];
        \natsort($lexicographicOrder);
        $lexicographicOrder = \array_values($lexicographicOrder);

        if ($lexicographicOrder[0] !== $prev || $lexicographicOrder[1] !== $next) {
            throw new InvalidInputException();
        }
    }
}
