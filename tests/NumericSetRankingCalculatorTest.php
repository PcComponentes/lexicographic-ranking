<?php declare(strict_types=1);

namespace PcComponentes\LexRanking\Tests;

use PcComponentes\LexRanking\Exception\InvalidInputException;
use PcComponentes\LexRanking\Position\Position;
use PcComponentes\LexRanking\RankingCalculator;
use PcComponentes\LexRanking\Tests\DataProvider\DataProvider;
use PcComponentes\LexRanking\Tests\DataProvider\NumericGap8DataProvider;
use PcComponentes\LexRanking\Token\NumericTokenSet;
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
            new NumericTokenSet(),
            new Position(Position::TYPE_FIXED_GAP_START, Position::DEFAULT_GAP),
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
    public function invalid_numeric_gap8_test(?string $prev, ?string $next): void
    {
        $this->expectException(InvalidInputException::class);

        $calculator = new RankingCalculator(
            new NumericTokenSet(),
            new Position(Position::TYPE_FIXED_GAP_START, Position::DEFAULT_GAP),
        );

        $calculator->between($prev, $next);
    }

    public function invalid_numeric_gap8_provider(): DataProvider
    {
        return NumericGap8DataProvider::invalid();
    }
}
