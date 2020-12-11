<?php
declare(strict_types=1);

namespace PcComponentes\LexRanking\Tests\DataProvider\Numeric;

use PcComponentes\LexRanking\Tests\DataProvider\DataProvider;

final class NumericGap8StartProvider
{
    public static function valid(): DataProvider
    {
        return new class extends DataProvider {
            public function __construct()
            {
                parent::__construct(
                    [
                        ['0', '6', '02'],
                        ['0', '2', '06'],
                        ['0', '1', '07'],
                        ['0', '99999999', '8'],
                        ['1', '99999999', '10'],
                        ['0', '22222222222222222222', '00000'],
                        ['0', '2222222222222', '00000'],
                        ['0', '2222222', '00000'],
                        ['0', '222222', '00000'],
                        ['0', '22222', '00000'],
                        ['0', '2222', '00000'],
                        ['0', '222', '0002'],
                        ['2', '3', '27'],
                        ['0000000', '1', '07'],
                        ['0', '8', '00'],
                        ['08', '9', '8'],
                        ['08', '7', '080'],
                        ['4', '99', '43'],
                        ['8', '9', '87'],
                        ['0', null, '8'],
                        ['988', null, '9886'],
                        ['7', null, '76'],
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
