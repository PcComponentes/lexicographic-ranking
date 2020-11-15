<?php declare(strict_types=1);

namespace AdnanMula\LexRanking;

use AdnanMula\LexRanking\Exception\InvalidInputException;

final class RankingCalculator
{
    private $tokenSet;
    private $gap;

    public function __construct(RankingCalculatorConfig $config)
    {
        $this->tokenSet = $config->tokenSet();
        $this->gap = $config->gap();
    }

    public function between(?string $prev, ?string $next)
    {
        $this->assert($prev, $next);

        $rank = '';
        $i = 0;

        while (true) {
            $prevToken = $this->getChar($prev, $i);
            $nextToken = $this->getChar($next, $i);

            $nextTokenIndex = null !== $nextToken
                ? $this->tokenSet->getIndex($nextToken)
                : $this->tokenSet->getIndex($this->tokenSet->maxToken());

            if ((null !== $prevToken || null !== $nextToken)
                && ($prevToken === $nextToken || $this->gap >= $nextTokenIndex)) {

                $rank .= $prevToken ?? $this->tokenSet->minToken();
                $i++;

                continue;
            }

            $possibleTokenIndex = $this->tokenSet->getIndex($prevToken ?? $this->tokenSet->minToken()) + $this->gap;

            if ($possibleTokenIndex >= $nextTokenIndex) {
                $rank .= $prevToken;
                $i++;

                continue;
            }

            $rank .= self::next($prevToken, $nextToken);

            break;
        }

        return $rank;
    }

    private function getChar(?string $input, int $i): ?string
    {
        if (null === $input) {
            return null;
        }

        return $input[$i] ?? null;
    }

    private function next(?string $prev, ?string $next): string
    {
//      TODO encapsulate gap logic
//      TODO check if prev + gap > next -> mid = next - prev / 2
        if (null === $prev) {
            return $this->tokenSet->getToken($this->gap);
        }

        return $this->tokenSet->getToken((int) ($this->tokenSet->getIndex($prev) + $this->gap));
    }

    private function assert(?string $prev, ?string $next): void
    {
        if ((null !== $prev && false === $this->tokenSet->isValid($prev))
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
