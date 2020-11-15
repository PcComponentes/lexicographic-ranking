<?php declare(strict_types=1);

namespace AdnanMula\LexRanking\Tests;

use AdnanMula\LexRanking\Exception\InvalidInputException;
use AdnanMula\LexRanking\RankingCalculator;
use AdnanMula\LexRanking\RankingCalculatorConfig;
use AdnanMula\LexRanking\Tests\DataProvider\Alpha62Gap8Provider;
use AdnanMula\LexRanking\Tests\DataProvider\DataProvider;
use AdnanMula\LexRanking\Token\Alpha62TokenSet;
use PHPUnit\Framework\TestCase;

final class Alpha62SetRankingCalculatorTest extends TestCase
{
    /**
     * @test
     * @dataProvider valid_alpha62_gap8_provider
     */
    public function valid_alpha62_gap8_test(?string $prev, ?string $next, string $result): void
    {
        $calculator = new RankingCalculator(new RankingCalculatorConfig(new Alpha62TokenSet(), 8));

        $this->assertEquals($result, $calculator->between($prev, $next));
    }

    public function valid_alpha62_gap8_provider(): DataProvider
    {
        return Alpha62Gap8Provider::valid();
    }
    /**
     * @test
     * @dataProvider invalid_alpha62_gap8_provider
     */
    public function invalid_alpha62_input_test(?string $prev, ?string $next): void
    {
        $this->expectException(InvalidInputException::class);

        $calculator = new RankingCalculator(new RankingCalculatorConfig(new Alpha62TokenSet(), 8));

        $calculator->between($prev, $next);
    }

    public function invalid_alpha62_gap8_provider(): DataProvider
    {
        return Alpha62Gap8Provider::invalid();
    }
}
