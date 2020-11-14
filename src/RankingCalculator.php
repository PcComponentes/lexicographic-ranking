<?php declare(strict_types=1);

namespace AdnanMula\LexRanking;

use AdnanMula\LexRanking\Exception\InvalidInputException;

final class RankingCalculator
{
    private $config;

    public function __construct(RankingCalculatorConfig $config)
    {
        $this->config = $config;
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
                ? $this->config->tokenSet()->getIndex($nextToken)
                : $this->config->tokenSet()->getIndex($this->config->tokenSet()->maxToken());

            if ((null !== $prevToken || null !== $nextToken)
                && ($prevToken === $nextToken || $this->config->gap() >= $nextTokenIndex)) {

                $rank .= $prevToken ?? $this->config->tokenSet()->minToken();
                $i++;

                continue;
            }

            $possibleTokenIndex = $this->config->tokenSet()->getIndex($prevToken ?? $this->config->tokenSet()->minToken()) + $this->config->gap();

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
//      TODO check if prev + gap > next -> mid = next - prev / 2
        if (null === $prev) {
            return $this->config->tokenSet()->getToken($this->config->gap());
        }

        return $this->config->tokenSet()->getToken((int) ($this->config->tokenSet()->getIndex($prev) + $this->config->gap()));
    }

    private function assert(?string $prev, ?string $next): void
    {
        if ((null !== $prev && false === $this->config->tokenSet()->isValid($prev))
            || (null !== $next && false === $this->config->tokenSet()->isValid($next))) {
            throw new InvalidInputException();
        }

//        if ($prev === $next) {
//            throw new InvalidRankingInputException();
//        }

        $lexicographicOrder = [$prev, $next];
        \natsort($lexicographicOrder);

        if ($lexicographicOrder[0] !== $prev || $lexicographicOrder[1] !== $next) {
            throw new InvalidInputException();
        }
    }
}
