<?php declare(strict_types=1);

namespace PcComponentes\LexRanking\Token;

use PcComponentes\LexRanking\Exception\InvalidPositionException;
use PcComponentes\LexRanking\Exception\InvalidInputException;
use PcComponentes\LexRanking\Exception\InvalidTokenSetException;
use PcComponentes\LexRanking\Position\Position;

abstract class TokenSet
{
    protected array $set;

    protected function __construct(array $set)
    {
        $this->assert($set);

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

    public function midToken(): string
    {
        return $this->set[floor(\count($this->set) / 2)];
    }

    public function maxIndex(): int
    {
        return \count($this->set);
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

    public function mid(Position $position, string $prev, string $next): ?string
    {
        if (Position::TYPE_DYNAMIC_MID === $position->type()) {
//              TODO check if prev + gap > next -> mid = next - prev / 2
            throw new \Exception('Mid gap type not supported yet');
        }

        if (null === $position->gap()) {
            throw new InvalidPositionException();
        }

        if (Position::TYPE_FIXED_GAP_START === $position->type()) {
            if ($this->getIndex($prev) + $position->gap() >= $this->getIndex($next)) {
                return null;
            }

            return $this->getToken($this->getIndex($prev) + $position->gap());
        }

        if (Position::TYPE_FIXED_GAP_END === $position->type()) {
            if ($this->getIndex($next) - $position->gap() < $this->getIndex($prev)) {
                return null;
            }

            return $this->getToken($this->getIndex($next) - $position->gap());
        }

        throw new InvalidPositionException();
    }

    public function isValid(string $input): bool
    {
        return 0 === \count(\array_diff(\str_split($input), $this->set));
    }

    private function assert(array $set): void
    {
        if (0 === \count($set)) {
            throw new InvalidTokenSetException();
        }

        foreach ($set as $token) {
            if (false === \is_string($token)) {
                throw new InvalidTokenSetException();
            }
        }
    }
}
