<?php declare(strict_types=1);

namespace AdnanMula\LexRanking;

use AdnanMula\LexRanking\Exception\InvalidInputException;
use AdnanMula\LexRanking\Gap\Gap;
use AdnanMula\LexRanking\Token\TokenSet;

final class RankingCalculator
{
    private TokenSet $tokenSet;
    private Gap $gap;

    public function __construct(RankingCalculatorConfig $config)
    {
        $this->tokenSet = $config->tokenSet();
        $this->gap = $config->gap();
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

            if ($prevToken === $nextToken || $this->gap->value() >= $nextTokenIndex) {
                $rank .= $prevToken;
                $i++;

                continue;
            }

            $possibleTokenIndex = $this->tokenSet->getIndex($prevToken) + $this->gap->value();

            if ($possibleTokenIndex >= $nextTokenIndex) {
                $rank .= $prevToken;
                $i++;

                continue;
            }

            $rank .= $this->tokenSet->next($this->gap, $prevToken, $nextToken);

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
