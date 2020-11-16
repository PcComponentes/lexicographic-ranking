<?php declare(strict_types=1);

namespace AdnanMula\LexRanking\Tests;

use AdnanMula\LexRanking\Exception\InvalidInputException;
use AdnanMula\LexRanking\Position\Position;
use AdnanMula\LexRanking\RankingCalculator;
use AdnanMula\LexRanking\RankingCalculatorConfig;
use AdnanMula\LexRanking\Tests\DataProvider\DataProvider;
use AdnanMula\LexRanking\Tests\DataProvider\NumericGap8DataProvider;
use AdnanMula\LexRanking\Token\NumericTokenSet;
use PHPUnit\Framework\TestCase;

final class NumericSetRankingCalculatorTest extends TestCase
{
    /**
     * @test
     * @dataProvider valid_numeric_gap8_provider
     */
    public function valid_numeric_gap8_test(?string $prev, ?string $next, string $result): void
    {
        $calculator = new RankingCalculator(
            new RankingCalculatorConfig(
                new NumericTokenSet(),
                new Position(Position::TYPE_FIXED_GAP_START, Position::DEFAULT_GAP),
            ),
        );

        $this->assertEquals($result, $calculator->between($prev, $next));
    }

    public function valid_numeric_gap8_provider(): DataProvider
    {
        return NumericGap8DataProvider::valid();
    }

    /**
     * @test
     * @dataProvider invalid_numeric_gap8_provider
     */
    public function invalid_numeric_input_test(?string $prev, ?string $next): void
    {
        $this->expectException(InvalidInputException::class);

        $calculator = new RankingCalculator(
            new RankingCalculatorConfig(
                new NumericTokenSet(),
                new Position(Position::TYPE_FIXED_GAP_START, Position::DEFAULT_GAP),
            ),
        );

        $calculator->between($prev, $next);
    }

    public function invalid_numeric_gap8_provider(): DataProvider
    {
        return NumericGap8DataProvider::invalid();
    }
}
