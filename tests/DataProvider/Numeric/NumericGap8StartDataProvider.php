<?php declare(strict_types=1);

namespace PcComponentes\LexRanking\Tests\DataProvider\Numeric;

use PcComponentes\LexRanking\Tests\DataProvider\DataProvider;

final class NumericGap8StartDataProvider
{
    public static function valid(): DataProvider
    {
        return new class extends DataProvider {
            public function __construct()
            {
                parent::__construct(
                    [
                        ['0', '9', '8'],
                        ['0', '1', '08'],
                        ['0', '9', '8'],
                        ['0', '9', '8'],
                        ['0', '6', '08'],
                        ['0', '99999999', '8'],
                        ['1', '99999999', '18'],
                        ['5', '22222222', '500000008'],
                        ['0', '22222222', '000000008'],
                        ['0', '1', '08'],
                        ['0000000', '1', '08'],
                        ['0', '8', '08'],
                        ['08', '9', '8'],
                        ['4', '99', '48'],
                        ['8', '9', '88'],
                        ['988', null, '9888'],
                        ['7', null, '78'],
                        ['0', null, '8'],
                    ],
                );
            }
        };
    }

    public static function invalid(): DataProvider
    {
        return new class extends DataProvider {
            public function __construct()
            {
                parent::__construct(
                    [
                        ['A0', '9'],
                        ['9', '9'],
                        ['98', '8'],
                        ['1', '-1'],
                        ['9', '8'],
                        ['1', '0'],
                        ['a', null],
                        ['A', null],
                        ['\'',null],
                        ['´', null],
                        ['η', null],
                        ['φ', null],
                        ['ك', null],
                        ['ب', null],
                        ['Б', null],
                        ['Х', null],
                        ['Ѭ', null],
                        [null, 'a'],
                        [null, 'A'],
                        [null, '\''],
                        [null, '´'],
                        [null, 'η'],
                        [null, 'φ'],
                        [null, 'ك'],
                        [null, 'ب'],
                        [null, 'Б'],
                        [null, 'Х'],
                        [null, 'Ѭ'],
                    ],
                );
            }
        };
    }
}
