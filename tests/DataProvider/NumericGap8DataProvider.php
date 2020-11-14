<?php declare(strict_types=1);

namespace AdnanMula\LexRanking\Tests\DataProvider;

final class NumericGap8DataProvider extends DataProvider
{
    public function __construct()
    {
        parent::__construct(
            [
                ['0', '9', '8'],
                ['0', '1', '08'],
                ['9', '99', '98'],
            ]
        );
    }
}
