<?php declare(strict_types=1);

namespace AdnanMula\LexRanking;

use AdnanMula\LexRanking\Exception\InvalidInputException;
use AdnanMula\LexRanking\Position\Position;
use AdnanMula\LexRanking\Token\TokenSet;

final class RankingCalculator
{
    private TokenSet $tokenSet;
    private Position $position;

    public function __construct(RankingCalculatorConfig $config)
    {
        $this->tokenSet = $config->tokenSet();
        $this->position = $config->position();
    }

    public function between(?string $prev, ?string $next): string
    {
        $this->assert($prev, $next);

        $rank = '';
        $i = 0;

        while (true) {
            $prevToken = $prev[$i] ?? $this->tokenSet->minToken();
            $nextToken = $next[$i] ?? $this->tokenSet->maxToken();

            $nextTokenIndex = $this->tokenSet->getIndex($nextToken);
            $possibleTokenIndex = $this->tokenSet->getIndex($prevToken) + $this->position->gap();

            if ($possibleTokenIndex >= $nextTokenIndex) {
                $rank .= $prevToken;
                $i++;

                continue;
            }

            $rank .= $this->tokenSet->getToken($possibleTokenIndex);

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
