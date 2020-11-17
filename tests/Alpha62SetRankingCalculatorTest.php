<?php declare(strict_types=1);

namespace PcComponentes\LexRanking\Tests;

use PcComponentes\LexRanking\Exception\InvalidInputException;
use PcComponentes\LexRanking\Position\Position;
use PcComponentes\LexRanking\RankingCalculator;
use PcComponentes\LexRanking\Tests\DataProvider\Alpha62Gap8Provider;
use PcComponentes\LexRanking\Tests\DataProvider\DataProvider;
use PcComponentes\LexRanking\Token\Alpha62TokenSet;
use PHPUnit\Framework\TestCase;

final class Alpha62SetRankingCalculatorTest extends TestCase
{
    /**
     * @test
     * @dataProvider valid_alpha62_gap8_provider
     */
    public function valid_alpha62_gap8_test(?string $prev, ?string $next, string $result): void
    {
        $calculator = new RankingCalculator(
            new Alpha62TokenSet(),
            new Position(Position::TYPE_FIXED_GAP_START, Position::DEFAULT_GAP),
        );

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
    public function invalid_alpha62_gap8_test(?string $prev, ?string $next): void
    {
        $this->expectException(InvalidInputException::class);

        $calculator = new RankingCalculator(
            new Alpha62TokenSet(),
            new Position(Position::TYPE_FIXED_GAP_START, Position::DEFAULT_GAP),
        );

        $calculator->between($prev, $next);
    }

    public function invalid_alpha62_gap8_provider(): DataProvider
    {
        return Alpha62Gap8Provider::invalid();
    }
}
