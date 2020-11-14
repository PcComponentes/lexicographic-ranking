<?php declare(strict_types=1);

namespace AdnanMula\LexRanking\Tests\DataProvider;

final class Alpha32Gap8Provider extends DataProvider
{
    public function __construct()
    {
        parent::__construct(
            [
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
            ]
        );
    }
}
