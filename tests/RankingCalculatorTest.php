<?php declare(strict_types=1);

namespace AdnanMula\LexRanking\Tests;

use AdnanMula\LexRanking\Exception\InvalidGapException;
use AdnanMula\LexRanking\RankingCalculator;
use AdnanMula\LexRanking\RankingCalculatorConfig;
use AdnanMula\LexRanking\Token\NumericTokenSet;
use PHPUnit\Framework\TestCase;

final class RankingCalculatorTest extends TestCase
{
    /**
     * @test
     * @dataProvider invalid_gap_provider
     */
    public function invalid_gap_test($gap): void
    {
        $this->expectException(InvalidGapException::class);

        new RankingCalculator(
            new RankingCalculatorConfig(new NumericTokenSet(), $gap)
        );
    }

    public function invalid_gap_provider()
    {
        return [[0], [-1], [-99]];
    }
}
