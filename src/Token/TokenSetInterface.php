<?php declare(strict_types=1);

namespace AdnanMula\LexRanking\Token;

interface TokenSetInterface
{
    public function minToken(): string;
    public function maxToken(): string;
    public function getIndex(string $token): int;
    public function getToken(int $index): string;
    public function toArray(): array;
    public function isValid(string $input): bool;
}
