<?php declare(strict_types=1);

namespace AdnanMula\LexRanking\Tests;

use AdnanMula\LexRanking\Exception\InvalidGapException;
use AdnanMula\LexRanking\Gap\Gap;
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
        $this->expectException(InvalidGapException::class);

        new RankingCalculator(
            new RankingCalculatorConfig(
                new NumericTokenSet(),
                new Gap(Gap::TYPE_FIXED_AMOUNT, $gap)
            )
        );
    }

    public function invalid_fixed_gap_provider(): array
    {
        return [[null], [0], [-1], [-99]];
    }
}
