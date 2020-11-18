<?php
declare(strict_types=1);

namespace PcComponentes\LexRanking\Position;

use PcComponentes\LexRanking\Exception\InvalidPositionException;

final class Position
{
    public const TYPE_FIXED_GAP_START = 'fixed_start';
    public const TYPE_FIXED_GAP_END = 'fixed_end';
    public const TYPE_DYNAMIC_MID = 'dynamic_mid';

    public const TYPES = [
        self::TYPE_FIXED_GAP_START,
        self::TYPE_FIXED_GAP_END,
        self::TYPE_DYNAMIC_MID,
    ];

    public const DEFAULT_GAP = 8;

    private string $type;
    private ?int $gap;

    public function __construct(string $type, ?int $gap)
    {
        $this->assert($type, $gap);

        $this->type = $type;
        $this->gap = $gap;
    }

    public function type(): string
    {
        return $this->type;
    }

    public function gap(): ?int
    {
        return $this->gap;
    }

    private function assert(string $type, ?int $gap): void
    {
        if (false === \in_array($type, self::TYPES, true)) {
            throw new InvalidPositionException();
        }

        if (true === \in_array($type, [self::TYPE_FIXED_GAP_START, self::TYPE_FIXED_GAP_END], true)
            && (null === $gap || 0 >= $gap)) {
            throw new InvalidPositionException();
        }
    }
}
