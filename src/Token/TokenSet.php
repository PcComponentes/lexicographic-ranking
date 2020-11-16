<?php declare(strict_types=1);

namespace AdnanMula\LexRanking\Token;

use AdnanMula\LexRanking\Exception\InvalidPositionException;
use AdnanMula\LexRanking\Exception\InvalidInputException;
use AdnanMula\LexRanking\Position\Position;

abstract class TokenSet
{
    protected array $set;

    protected function __construct(array $set)
    {
        $this->set = $set;
    }

    public function minToken(): string
    {
        return $this->set[0];
    }

    public function maxToken(): string
    {
        return \end($this->set);
    }

    public function getToken(int $index): string
    {
        if (\count($this->set) - 1 < $index) {
            $index %= \count($this->set);
        }

        return $this->set[$index];
    }

    public function getIndex(string $token): int
    {
        $index = \array_search($token, $this->set, true);

        if (false === $index || \is_string($index)) {
            throw new InvalidInputException();
        }

        return $index;
    }

    public function next(Position $position, string $prev, string $next): string
    {
        if (Position::TYPE_DYNAMIC_MID === $position->type()) {
//              TODO check if prev + gap > next -> mid = next - prev / 2
            throw new \Exception('Mid gap type not supported yet');
        }

        if (null === $position->gap()) {
            throw new InvalidPositionException();
        }

        return $this->getToken($this->getIndex($prev) + $position->gap());
    }

    public function isValid(string $input): bool
    {
        return 0 === \count(\array_diff(\str_split($input), $this->set));
    }
}
