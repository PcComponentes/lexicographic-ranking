<?php declare(strict_types=1);

namespace AdnanMula\CosaDelCopon\Tests;

use AdnanMula\LexRanking\Ranking;
use AdnanMula\LexRanking\RankingConfig;
use PHPUnit\Framework\TestCase;

final class RankingTest extends TestCase
{
    /**
     * @test
     * @dataProvider alpha36_gap8_provider
     */
    public function given_($prev, $next, $result)
    {
        $rankingService = new Ranking(
            new RankingConfig(
                RankingConfig::TOKEN_SET_ALPHANUMERIC_36,
                RankingConfig::DEFAULT_GAP
            )
        );

        $this->assertEquals($result, $rankingService->between($prev, $next));
    }

    public function alpha36_gap8_provider()
    {
        return [
            ['A', 'B', 'A8'],
            ['0', '1', '08'],
            ['0', 'Z', '8'],
            [null, 'Z1', '8'],
            [null, '7', '08'],
            ['07', 'H', '8'],
            ['Z6', 'ZZ', 'ZE'],
            ['FB', 'FW', 'FJ'],
            ['F6', 'Z', 'N'],
            ['G', 'Z', 'O'],
            ['O', 'Z', 'W'],
            ['W', 'W8', 'W08'],
            ['Z6', null, 'ZE'],
            ['F6', null, 'N'],
            ['F6', 'F', 'FE'],
            ['Z6', 'Z', 'ZE'],
            ['W8', 'Z', 'WG'],
            ['W', 'Z', 'W8'],
        ];
    }
}
