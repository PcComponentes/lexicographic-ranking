<?php
declare(strict_types=1);

namespace PcComponentes\LexRanking\Tests;

use PcComponentes\LexRanking\Exception\InvalidInputException;
use PcComponentes\LexRanking\Position\DynamicMidPosition;
use PcComponentes\LexRanking\Position\FixedEndPosition;
use PcComponentes\LexRanking\Position\FixedStartPosition;
use PcComponentes\LexRanking\RankingCalculator;
use PcComponentes\LexRanking\Tests\DataProvider\DataProvider;
use PcComponentes\LexRanking\Tests\DataProvider\Numeric\NumericGap8EndProvider;
use PcComponentes\LexRanking\Tests\DataProvider\Numeric\NumericGap8StartProvider;
use PcComponentes\LexRanking\Tests\DataProvider\Numeric\NumericGapMidProvider;
use PcComponentes\LexRanking\Token\NumericTokenSet;
use PHPUnit\Framework\TestCase;

final class NumericSetRankingCalculatorTest extends TestCase
{
    /**
     * @test
     * @dataProvider valid_numeric_gap8_start_provider
     */
    public function valid_numeric_gap8_start_test(?string $prev, ?string $next, string $result): void
    {
        $calculator = new RankingCalculator(
            new NumericTokenSet(),
            new FixedStartPosition(8),
        );

        $this->assertEquals($result, $calculator->between($prev, $next));
    }

    public function valid_numeric_gap8_start_provider(): DataProvider
    {
        return NumericGap8StartProvider::valid();
    }

    /**
     * @test
     * @dataProvider invalid_numeric_gap8_start_provider
     */
    public function invalid_numeric_gap8_start_test(?string $prev, ?string $next): void
    {
        $this->expectException(InvalidInputException::class);

        $calculator = new RankingCalculator(
            new NumericTokenSet(),
            new FixedStartPosition(8),
        );

        $calculator->between($prev, $next);
    }

    public function invalid_numeric_gap8_start_provider(): DataProvider
    {
        return NumericGap8StartProvider::invalid();
    }

    /**
     * @test
     * @dataProvider valid_numeric_gap8_end_provider
     */
    public function valid_numeric_gap8_end_test(?string $prev, ?string $next, string $result): void
    {
        $calculator = new RankingCalculator(
            new NumericTokenSet(),
            new FixedEndPosition(8),
        );

        $this->assertEquals($result, $calculator->between($prev, $next));
    }

    public function valid_numeric_gap8_end_provider(): DataProvider
    {
        return NumericGap8EndProvider::valid();
    }

    /**
     * @test
     * @dataProvider invalid_numeric_gap8_end_provider
     */
    public function invalid_numeric_gap8_end_test(?string $prev, ?string $next): void
    {
        $this->expectException(InvalidInputException::class);

        $calculator = new RankingCalculator(
            new NumericTokenSet(),
            new FixedEndPosition(8),
        );

        $calculator->between($prev, $next);
    }

    public function invalid_numeric_gap8_end_provider(): DataProvider
    {
        return NumericGap8EndProvider::invalid();
    }

    /**
     * @test
     * @dataProvider valid_numeric_gap_mid_provider
     */
    public function valid_numeric_gap_mid_test(?string $prev, ?string $next, string $result): void
    {
        $calculator = new RankingCalculator(
            new NumericTokenSet(),
            new DynamicMidPosition(),
        );

        $this->assertEquals($result, $calculator->between($prev, $next));
    }

    public function valid_numeric_gap_mid_provider(): DataProvider
    {
        return NumericGapMidProvider::valid();
    }

    /**
     * @test
     * @dataProvider invalid_numeric_gap_mid_provider
     */
    public function invalid_numeric_gap_mid_test(?string $prev, ?string $next): void
    {
        $this->expectException(InvalidInputException::class);

        $calculator = new RankingCalculator(
            new NumericTokenSet(),
            new DynamicMidPosition(),
        );

        $calculator->between($prev, $next);
    }

    public function invalid_numeric_gap_mid_provider(): DataProvider
    {
        return NumericGapMidProvider::invalid();
    }
}
