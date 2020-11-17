<?php declare(strict_types=1);

namespace PcComponentes\LexRanking\Tests\DataProvider;

final class Alpha36Gap8Provider
{
    public static function valid(): DataProvider
    {
        return new class extends DataProvider {
            public function __construct()
            {
                parent::__construct(
                    [
                        [null, '1', '08'],
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
                        ['W8', 'Z', 'WG'],
                        ['W', 'Z', 'W8'],
                        ['7', 'G', 'F'],
                        [null, 'G', '8'],
                        ['00001', 'Z', '8'],
                        ['ASDF5T', 'ASDF5Z', 'ASDF5T8'],
                        ['ASDF', 'ASDF5Z', 'ASDF08'],
                        ['7', null, 'F'],
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
