<?php declare(strict_types=1);

namespace PcComponentes\LexRanking\Tests\DataProvider\Numeric;

use PcComponentes\LexRanking\Tests\DataProvider\DataProvider;

final class NumericGap8EndProvider
{
    public static function valid(): DataProvider
    {
        return new class extends DataProvider {
            public function __construct()
            {
                parent::__construct(
                    [
                        ['0', '9', '1'],
                        ['0', '1', '01'],
                        ['0', '6', '01'],
                        ['0', '99999999', '1'],
                        ['1', '99999999', '11'],
                        ['0', '22222222', '000000001'],
                        ['0', '1', '01'],
                        ['0', '8', '01'],
                        ['0000000', '1', '01'],
                        ['08', '9', '1'],
                        ['4', '99', '41'],
                        ['8', '9', '81'],
                        ['988', null, '9881'],
                        ['7', null, '71'],
                        ['0', null, '1'],
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
                        ['5', '22222222'],
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
