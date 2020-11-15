<?php declare(strict_types=1);

namespace AdnanMula\LexRanking\Gap;

use AdnanMula\LexRanking\Exception\InvalidGapException;

final class Gap
{
    const TYPE_FIXED_AMOUNT = 'fixed';
    const TYPE_DYNAMIC_MID = 'dynamic-mid';
    const DEFAULT_VALUE = 8;

    private string $type;

    private ?int $value;

    public function __construct(string $type, ?int $value)
    {
        if (self::TYPE_FIXED_AMOUNT === $type && (null === $value || 0 >= $value)) {
            throw new InvalidGapException();
        }

        $this->type = $type;
        $this->value = $value;
    }

    public function type(): string
    {
        return $this->type;
    }

    public function value(): ?int
    {
        return $this->value;
    }
}
