<?php declare(strict_types=1);

namespace AdnanMula\LexRanking\Tests;

use AdnanMula\LexRanking\Exception\InvalidPositionException;
use AdnanMula\LexRanking\Position\Position;
use AdnanMula\LexRanking\RankingCalculator;
use AdnanMula\LexRanking\RankingCalculatorConfig;
use AdnanMula\LexRanking\Token\NumericTokenSet;
use PHPUnit\Framework\TestCase;

final class RankingCalculatorTest extends TestCase
{
    /**
     * @test
     * @dataProvider invalid_fixed_gap_provider
     */
    public function invalid_fixed_gap_test(?int $gap): void
    {
        $this->expectException(InvalidPositionException::class);

        new RankingCalculator(
            new RankingCalculatorConfig(
                new NumericTokenSet(),
                new Position(Position::TYPE_FIXED_GAP_START, $gap),
            ),
        );
    }

    public function invalid_fixed_gap_provider(): array
    {
        return [[null], [0], [-1], [-99]];
    }
}
