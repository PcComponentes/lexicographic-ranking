<?php
declare(strict_types=1);

namespace PcComponentes\LexRanking\Tests\DataProvider\Alpha62;

use PcComponentes\LexRanking\Tests\DataProvider\DataProvider;

final class Alpha62Gap8StartProvider
{
    public static function valid(): DataProvider
    {
        return new class extends DataProvider {
            public function __construct()
            {
                parent::__construct(
                    [
                        ['A', 'B', 'A7'],
                        ['0', '1', '07'],
                        ['0', 'a', '8'],
                        ['a', 'b', 'a7'],
                        ['Z', 'z', 'h'],
                        ['7', 'G', 'F'],
                        [null, 'G', '8'],
                        ['00001', 'z', '8'],
                        ['AsDF5T', 'AsDF5Z', 'AsDF5T2'],
                        ['ASDF5T', 'AsDF5Z', 'Aa'],
                        ['A', 'Az', 'A8'],
                        ['A', 'A7', 'A01'],
                        ['x', null, 'x6'],
                        ['AaD3rtT', 'At', 'Ai'],
                        ['ZNTbx8XnWx', 'imHgQJWlyw', 'h'],

                        ['ZNTbx8XnWx', 'ZNTbx8XnWz', 'ZNTbx8XnWx6'],
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
                        ['BBB', 'A'],
                        ['bbb', 'A'],
                        ['ZZZ', '0'],
                        ['zZZ', '0'],
                        ['ABCDA', 'ABCD'],
                        ['aBCD', 'ABCD'],
                        ['\'',null],
                        ['´', null],
                        ['η', null],
                        ['φ', null],
                        ['ك', null],
                        ['ب', null],
                        ['Б', null],
                        ['Х', null],
                        ['Ѭ', null],
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
