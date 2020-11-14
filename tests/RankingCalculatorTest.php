<?php declare(strict_types=1);

namespace AdnanMula\LexRanking\Tests;

use AdnanMula\LexRanking\RankingCalculator;
use AdnanMula\LexRanking\RankingCalculatorConfig;
use AdnanMula\LexRanking\Tests\DataProvider\Alpha32Gap8Provider;
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
    public function valid_alpha36_gap8_test($prev, $next, $result)
    {
        $rankingService = new RankingCalculator(new RankingCalculatorConfig(new Alpha36TokenSet(), 8));

        $this->assertEquals($result, $rankingService->between($prev, $next));
    }

    public function valid_alpha36_gap8_provider()
    {
        return new Alpha32Gap8Provider();
    }

    /**
     * @test
     * @dataProvider valid_numeric_gap8_provider
     */
    public function valid_numeric_gap8_test($prev, $next, $result)
    {
        $rankingService = new RankingCalculator(new RankingCalculatorConfig(new NumericTokenSet(), 8));

        $this->assertEquals($result, $rankingService->between($prev, $next));
    }

    public function valid_numeric_gap8_provider()
    {
        return new NumericGap8DataProvider();
    }
}
