<?php declare(strict_types=1);

namespace AdnanMula\LexRanking\Tests\DataProvider;

final class Alpha62Gap8Provider extends DataProvider
{
    public function __construct()
    {
        parent::__construct(
            [
                ['A', 'B', 'A8'],
                ['0', '1', '08'],
                ['a', 'b', 'a8'],
                ['Z', 'z', 'h'],
            ]
        );
    }
}
