<?php declare(strict_types=1);

namespace PcComponentes\LexRanking\Tests\DataProvider\Alpha36;

use PcComponentes\LexRanking\Tests\DataProvider\DataProvider;

final class Alpha36Gap8EndProvider
{
    public static function valid(): DataProvider
    {
        return new class extends DataProvider {
            public function __construct()
            {
                parent::__construct(
                    [
                        [null, '1', '0R'],
                        ['A', 'B', 'AR'],
                        ['0', '1', '0R'],
                        ['0', 'Z', 'R'],
                        [null, 'Z1', 'R'],
                        [null, 'Y1G', 'Q'],
                        [null, 'W13', 'O'],
                        [null, '7', '0R'],
                        ['07', 'H', '9'],
                        ['Z6', 'ZZ', 'ZR'],
                        ['FB', 'FW', 'FO'],
                        ['F6', 'Z', 'R'],
                        ['G', 'Z', 'R'],
                        ['O', 'Z', 'R'],
                        ['W', 'W8', 'W0'],
                        ['Z6', null, 'ZR'],
                        ['F6', null, 'R'],
                        ['W8', 'Z', 'WR'],
                        ['W', 'Z', 'WR'],
                        ['7', 'G', '8'],
                        [null, 'G', '8'],
                        ['00001', 'Z', 'R'],
                        ['ASDF5T', 'ASDF5Z', 'ASDF5TR'],
                        ['ASDF', 'ASDF5Z', 'ASDF0R'],
                        ['7', null, 'R'],
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
                        [null, '0'],
                        ['A0', '9'],
                        ['9', '9'],
                        ['98', '8'],
                        ['1', '-1'],
                        ['9', '8'],
                        ['1', '0'],
                        ['BBB', 'A'],
                        ['ZZZ', '0'],
                        ['ABCDA', 'ABCD'],
                        ['a', null],
                        ['\'',null],
                        ['´', null],
                        ['η', null],
                        ['φ', null],
                        ['ك', null],
                        ['ب', null],
                        ['Б', null],
                        ['Б1', 'Б'],
                        ['Х', null],
                        ['Ѭ', null],
                        ['Ѭ', 'Ѭ'],
                        [null, 'a'],
                        [null, '\''],
                        [null, '´'],
                        [null, 'η'],
                        [null, 'φ'],
                        [null, 'ك'],
                        [null, 'ب'],
                        [null, 'Б'],
                        [null, 'Х'],
                        [null, 'Ѭ'],
                        ['Z6', 'Z'],
                        ['F6', 'F'],
                    ],
                );
            }
        };
    }
}
