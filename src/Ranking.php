<?php declare(strict_types=1);

namespace AdnanMula\LexRanking;

use AdnanMula\LexRanking\Exception\InvalidInputException;

final class Ranking
{
    private $config;

    public function __construct(RankingConfig $config)
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

            $nextTokenIndex = (null !== $nextToken ? $this->getIndex($nextToken) : $this->getIndex($this->config->maxToken()));

            if ((null !== $prevToken || null !== $nextToken)
                && ($prevToken === $nextToken || $this->config->gap() >= $nextTokenIndex)) {

                $rank .= $prevToken ?? $this->config->minToken();
                $i++;

                continue;
            }

            $possibleTokenIndex = $this->getIndex($prevToken ?? $this->config->minToken()) + $this->config->gap();

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

    private function getToken(int $index): string
    {
        $tokenSet = $this->config->tokenSet();

        if (\count($tokenSet) - 1 < $index) {
            $index %= \count($tokenSet);
        }

        return (string) $tokenSet[$index];
    }

    private function getIndex(string $token)
    {
        $index = \array_search($token, $this->config->tokenSet(), true);

        if (false === $index) {
            throw new \InvalidArgumentException('Invalid token ' . $token);
        }

        return $index;
    }

    private function next(?string $prev, ?string $next): string
    {
//      TODO check if prev + gap > next -> mid = next - prev / 2
        if (null === $prev) {
            return $this->getToken($this->config->gap());
        }

        return $this->getToken((int) ($this->getIndex($prev) + $this->config->gap()));
    }

    private function assert(?string $prev, ?string $next): void
    {
        $invalidTokens = \array_diff(
            \array_merge(
                $prev ? \str_split($prev) : [],
                $next ? \str_split($next) : []
            ),
            $this->config->tokenSet()
        );

        if (\count($invalidTokens) > 0) {
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
