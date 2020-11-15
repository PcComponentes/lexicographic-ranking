<?php declare(strict_types=1);

namespace AdnanMula\LexRanking\Tests\DataProvider;

final class Alpha62Gap8Provider
{
    public static function valid(): DataProvider
    {
        return new class extends DataProvider {
            public function __construct()
            {
                parent::__construct(
                    [
                        ['A', 'B', 'A8'],
                        ['0', '1', '08'],
                        ['a', 'b', 'a8'],
                        ['Z', 'z', 'h'],
                        ['7', 'G', 'F'],
                        [null, 'G', '8'],
                        ['00001', 'z', '8'],
                        ['AsDF5T', 'AsDF5Z', 'AsDF5T8'],
                        ['ASDF5T', 'AsDF5Z', 'Aa'],
                        ['A', 'Az', 'A8'],
                        ['A', 'A7', 'A08'],
                        ['x', null, 'x8'],
                        ['AaD3rtT', 'At', 'Ai'],
                        ['ZNTbx8XnWx', 'imHgQJWlyw', 'h'],
                        ['ZNTbx8XnWx', 'ZNTbx8XnWz', 'ZNTbx8XnWx8'],
                    ]
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
                    ]
                );
            }
        };
    }
}
