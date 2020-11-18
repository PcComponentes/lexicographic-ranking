<?php
declare(strict_types=1);

namespace PcComponentes\LexRanking\Tests;

use PcComponentes\LexRanking\Exception\InvalidPositionException;
use PcComponentes\LexRanking\Position\Position;
use PcComponentes\LexRanking\RankingCalculator;
use PcComponentes\LexRanking\Token\Alpha36TokenSet;
use PcComponentes\LexRanking\Token\Alpha62TokenSet;
use PHPUnit\Framework\TestCase;

final class RankingCalculatorTest extends TestCase
{
    /**
     * @test
     * @dataProvider valid_fixed_gap_provider
     * @doesNotPerformAssertions
     */
    public function valid_fixed_gap_start_test(?int $gap): void
    {
        new RankingCalculator(
            new Alpha62TokenSet(),
            new Position(Position::TYPE_FIXED_GAP_START, $gap),
        );
    }

    /**
     * @test
     * @dataProvider valid_fixed_gap_provider
     * @doesNotPerformAssertions
     */
    public function valid_fixed_gap_end_test(?int $gap): void
    {
        new RankingCalculator(
            new Alpha62TokenSet(),
            new Position(Position::TYPE_FIXED_GAP_END, $gap),
        );
    }

    public function valid_fixed_gap_provider(): array
    {
        return [[1], [20], [36], [62]];
    }

    /**
     * @test
     * @dataProvider invalid_fixed_gap_provider
     */
    public function invalid_fixed_gap_test(?int $gap): void
    {
        $this->expectException(InvalidPositionException::class);

        new RankingCalculator(
            new Alpha36TokenSet(),
            new Position(Position::TYPE_FIXED_GAP_START, $gap),
        );
    }

    public function invalid_fixed_gap_provider(): array
    {
        return [[null], [0], [-1], [-99], [37], [62]];
    }
}
