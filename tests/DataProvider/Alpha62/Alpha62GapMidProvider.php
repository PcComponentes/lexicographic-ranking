<?php
declare(strict_types=1);

namespace PcComponentes\LexRanking\Tests\DataProvider\Alpha62;

use PcComponentes\LexRanking\Tests\DataProvider\DataProvider;

final class Alpha62GapMidProvider
{
    public static function valid(): DataProvider
    {
        return new class extends DataProvider {
            public function __construct()
            {
                parent::__construct(
                    [
                        ['A', 'B', 'AU'],
                        ['0', '1', '0U'],
                        ['a', 'b', 'aU'],
                        ['Z', 'z', 'm'],
                        ['7', 'G', 'B'],
                        [null, 'G', '8'],
                        ['00001', 'z', 'U'],
                        ['AsDF5T', 'AsDF5Z', 'AsDF5W'],
                        ['ASDF5T', 'AsDF5Z', 'Af'],
                        ['A', 'Az', 'AU'],
                        ['A', 'A7', 'A3'],
                        ['x', null, 'y'],
                        ['AaD3rtT', 'At', 'Aj'],
                        ['ZNTbx8XnWx', 'imHgQJWlyw', 'd'],
                        ['ZNTbx8XnWx', 'ZNTbx8XnWz', 'ZNTbx8XnWy'],
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
