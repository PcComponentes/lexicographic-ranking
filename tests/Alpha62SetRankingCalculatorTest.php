<?php
declare(strict_types=1);

namespace PcComponentes\LexRanking\Tests;

use PcComponentes\LexRanking\Exception\InvalidInputException;
use PcComponentes\LexRanking\Position\Position;
use PcComponentes\LexRanking\RankingCalculator;
use PcComponentes\LexRanking\Tests\DataProvider\Alpha62\Alpha62Gap8EndProvider;
use PcComponentes\LexRanking\Tests\DataProvider\Alpha62\Alpha62Gap8StartProvider;
use PcComponentes\LexRanking\Tests\DataProvider\Alpha62\Alpha62GapMidProvider;
use PcComponentes\LexRanking\Tests\DataProvider\DataProvider;
use PcComponentes\LexRanking\Token\Alpha62TokenSet;
use PHPUnit\Framework\TestCase;

final class Alpha62SetRankingCalculatorTest extends TestCase
{
    /**
     * @test
     * @dataProvider valid_alpha62_gap8_start_provider
     */
    public function valid_alpha62_gap8_start_test(?string $prev, ?string $next, string $result): void
    {
        $calculator = new RankingCalculator(
            new Alpha62TokenSet(),
            new Position('fixed_start', 8),
        );

        $this->assertEquals($result, $calculator->between($prev, $next));
    }

    public function valid_alpha62_gap8_start_provider(): DataProvider
    {
        return Alpha62Gap8StartProvider::valid();
    }

    /**
     * @test
     * @dataProvider invalid_alpha62_gap8_start_provider
     */
    public function invalid_alpha62_gap8_start_test(?string $prev, ?string $next): void
    {
        $this->expectException(InvalidInputException::class);

        $calculator = new RankingCalculator(
            new Alpha62TokenSet(),
            new Position('fixed_start', 8),
        );

        $calculator->between($prev, $next);
    }

    public function invalid_alpha62_gap8_start_provider(): DataProvider
    {
        return Alpha62Gap8StartProvider::invalid();
    }

    /**
     * @test
     * @dataProvider valid_alpha62_gap8_end_provider
     */
    public function valid_alpha62_gap8_end_test(?string $prev, ?string $next, string $result): void
    {
        $calculator = new RankingCalculator(
            new Alpha62TokenSet(),
            new Position('fixed_end', 8),
        );

        $this->assertEquals($result, $calculator->between($prev, $next));
    }

    public function valid_alpha62_gap8_end_provider(): DataProvider
    {
        return Alpha62Gap8EndProvider::valid();
    }

    /**
     * @test
     * @dataProvider invalid_alpha62_gap8_end_provider
     */
    public function invalid_alpha62_gap8_end_test(?string $prev, ?string $next): void
    {
        $this->expectException(InvalidInputException::class);

        $calculator = new RankingCalculator(
            new Alpha62TokenSet(),
            new Position('fixed_end', 8),
        );

        $calculator->between($prev, $next);
    }

    public function invalid_alpha62_gap8_end_provider(): DataProvider
    {
        return Alpha62Gap8EndProvider::invalid();
    }

    /**
     * @test
     * @dataProvider valid_alpha62_gap_mid_provider
     */
    public function valid_alpha62_gap_mid_test(?string $prev, ?string $next, string $result): void
    {
        $calculator = new RankingCalculator(
            new Alpha62TokenSet(),
            new Position('dynamic_mid', null),
        );

        $this->assertEquals($result, $calculator->between($prev, $next));
    }

    public function valid_alpha62_gap_mid_provider(): DataProvider
    {
        return Alpha62GapMidProvider::valid();
    }

    /**
     * @test
     * @dataProvider invalid_alpha62_gap_mid_provider
     */
    public function invalid_alpha62_gap_mid_test(?string $prev, ?string $next): void
    {
        $this->expectException(InvalidInputException::class);

        $calculator = new RankingCalculator(
            new Alpha62TokenSet(),
            new Position('dynamic_mid', null),
        );

        $calculator->between($prev, $next);
    }

    public function invalid_alpha62_gap_mid_provider(): DataProvider
    {
        return Alpha62GapMidProvider::invalid();
    }
}
