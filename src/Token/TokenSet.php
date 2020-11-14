<?php declare(strict_types=1);

namespace AdnanMula\LexRanking\Token;

abstract class TokenSet implements TokenSetInterface
{
    protected $set;

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

        return (string) $this->set[$index];
    }

    public function getIndex(string $token)
    {
        $index = \array_search($token, $this->set, true);

        if (false === $index) {
            throw new \InvalidArgumentException('Invalid token ' . $token);
        }

        return $index;
    }

    public function isValid(string $input): bool
    {
        return \count(\array_diff(\str_split($input), $this->set)) === 0;
    }

    public function toArray(): array
    {
        return $this->set;
    }
}
