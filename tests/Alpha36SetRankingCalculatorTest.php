<?php declare(strict_types=1);

namespace AdnanMula\LexRanking\Tests;

use AdnanMula\LexRanking\Exception\InvalidInputException;
use AdnanMula\LexRanking\Gap\Gap;
use AdnanMula\LexRanking\RankingCalculator;
use AdnanMula\LexRanking\RankingCalculatorConfig;
use AdnanMula\LexRanking\Tests\DataProvider\Alpha36Gap8Provider;
use AdnanMula\LexRanking\Tests\DataProvider\DataProvider;
use AdnanMula\LexRanking\Token\Alpha36TokenSet;
use PHPUnit\Framework\TestCase;

final class Alpha36SetRankingCalculatorTest extends TestCase
{
    /**
     * @test
     * @dataProvider valid_alpha36_gap8_provider
     */
    public function valid_alpha36_gap8_test(?string $prev, ?string $next, string $result): void
    {
        $calculator = new RankingCalculator(
            new RankingCalculatorConfig(
                new Alpha36TokenSet(),
                new Gap(Gap::TYPE_FIXED_AMOUNT, Gap::DEFAULT_VALUE)
            )
        );

        $this->assertEquals($result, $calculator->between($prev, $next));
    }

    public function valid_alpha36_gap8_provider(): DataProvider
    {
        return Alpha36Gap8Provider::valid();
    }

    /**
     * @test
     * @dataProvider invalid_alpha36_gap8_provider
     */
    public function invalid_alpha36_input_test(?string $prev, ?string $next): void
    {
        $this->expectException(InvalidInputException::class);

        $calculator = new RankingCalculator(
            new RankingCalculatorConfig(
                new Alpha36TokenSet(),
                new Gap(Gap::TYPE_FIXED_AMOUNT, Gap::DEFAULT_VALUE)
            )
        );

        $calculator->between($prev, $next);
    }

    public function invalid_alpha36_gap8_provider(): DataProvider
    {
        return Alpha36Gap8Provider::invalid();
    }
}
