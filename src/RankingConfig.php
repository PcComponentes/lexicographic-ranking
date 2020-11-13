<?php declare(strict_types=1);

namespace AdnanMula\LexRanking;

use AdnanMula\LexRanking\Exception\InvalidGapException;

final class RankingConfig
{
    public const TOKEN_SET_NUMERIC = 'token10';
    public const TOKEN_SET_ALPHANUMERIC_36 = 'token36';
    public const TOKEN_SET_ALPHANUMERIC_62 = 'token62';

    public const DEFAULT_GAP = 8;

    private $tokenSet;
    private $gap;

    public function __construct(
        string $tokenSet = self::TOKEN_SET_ALPHANUMERIC_36,
        int $gap = self::DEFAULT_GAP
    ) {
        if (self::TOKEN_SET_NUMERIC === $tokenSet) {
            $this->tokenSet = \array_map('strval', \range('0', '9'));
        }

        if (self::TOKEN_SET_ALPHANUMERIC_36 === $tokenSet) {
            $this->tokenSet = \array_merge(
                \array_map('strval', \range('0', '9')),
                \range('A', 'Z')
            );
        }

        if (self::TOKEN_SET_ALPHANUMERIC_62 === $tokenSet) {
            $this->tokenSet = \array_merge(
                \array_map('strval', \range('0', '9')),
                \range('A', 'Z'),
                \range('a', 'z')
            );
        }

        if (0 === $gap) {
            throw new InvalidGapException();
        }

        $this->gap = $gap;
    }

    public function tokenSet(): array
    {
        return $this->tokenSet;
    }

    public function gap(): int
    {
        return $this->gap;
    }

    public function minToken(): string
    {
        return $this->tokenSet[0];
    }

    public function maxToken(): string
    {
        return \end($this->tokenSet);
    }
}
