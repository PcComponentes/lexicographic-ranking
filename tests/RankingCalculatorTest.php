<?php declare(strict_types=1);

namespace AdnanMula\LexRanking\Tests;

use AdnanMula\LexRanking\Exception\InvalidGapException;
use AdnanMula\LexRanking\Exception\InvalidInputException;
use AdnanMula\LexRanking\RankingCalculator;
use AdnanMula\LexRanking\RankingCalculatorConfig;
use AdnanMula\LexRanking\Tests\DataProvider\Alpha32Gap8Provider;
use AdnanMula\LexRanking\Tests\DataProvider\DataProvider;
use AdnanMula\LexRanking\Tests\DataProvider\NumericGap8DataProvider;
use AdnanMula\LexRanking\Token\Alpha36TokenSet;
use AdnanMula\LexRanking\Token\NumericTokenSet;
use PHPUnit\Framework\TestCase;

final class RankingCalculatorTest extends TestCase
{
    /**
     * @test
     * @dataProvider valid_alpha36_gap8_provider
     */
    public function valid_alpha36_gap8_test(?string $prev, ?string $next, string $result): void
    {
        $calculator = new RankingCalculator(new RankingCalculatorConfig(new Alpha36TokenSet(), 8));

        $this->assertEquals($result, $calculator->between($prev, $next));
    }

    public function valid_alpha36_gap8_provider(): DataProvider
    {
        return new Alpha32Gap8Provider();
    }

    /**
     * @test
     * @dataProvider valid_numeric_gap8_provider
     */
    public function valid_numeric_gap8_test(?string $prev, ?string $next, string $result): void
    {
        $calculator = new RankingCalculator(new RankingCalculatorConfig(new NumericTokenSet(), 8));

        $this->assertEquals($result, $calculator->between($prev, $next));
    }

    public function valid_numeric_gap8_provider(): DataProvider
    {
        return new NumericGap8DataProvider();
    }

    /** @test */
    public function invalid_gap_test(): void
    {
        $this->expectException(InvalidGapException::class);

        new RankingCalculator(
            new RankingCalculatorConfig(new NumericTokenSet(), 0)
        );
    }

    /** @test */
    public function invalid_numeric_input_test(): void
    {
        $this->expectException(InvalidInputException::class);

        $calculator = new RankingCalculator(
            new RankingCalculatorConfig(new NumericTokenSet(), 1)
        );

        $calculator->between('A', 'F');
    }

    /** @test */
    public function invalid_alpha36_input_test(): void
    {
        $this->expectException(InvalidInputException::class);

        $calculator = new RankingCalculator(
            new RankingCalculatorConfig(new NumericTokenSet(), 1)
        );

        $calculator->between('a', 'z');
    }

    /** @test */
    public function invalid_alpha62_input_test(): void
    {
        $this->expectException(InvalidInputException::class);

        $calculator = new RankingCalculator(
            new RankingCalculatorConfig(new NumericTokenSet(), 1)
        );

        $calculator->between('.', '');
    }
}
