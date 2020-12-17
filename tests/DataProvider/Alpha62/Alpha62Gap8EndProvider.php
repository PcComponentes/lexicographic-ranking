<?php
declare(strict_types=1);

namespace PcComponentes\LexRanking\Tests\DataProvider\Alpha62;

use PcComponentes\LexRanking\Tests\DataProvider\DataProvider;

final class Alpha62Gap8EndProvider
{
    public static function valid(): DataProvider
    {
        return new class extends DataProvider {
            public function __construct()
            {
                parent::__construct(
                    [
                        ['A', 'B', 'As'],
                        ['0', '1', '0s'],
                        ['a', 'b', 'as'],
                        ['a', 'c', 'at'],
                        ['Z', 'z', 'r'],
                        ['7', 'G', '8'],
                        [null, 'G', '8'],
                        ['00001', 'z', 'r'],
                        ['AsDF5T', 'AsDF5Z', 'AsDF5Tx'],
                        ['ASDF5T', 'AsDF5Z', 'Ak'],
                        ['A', 'Az', 'Ar'],
                        ['A', 'A7', 'A0y'],
                        ['x', null, 'xt'],
                        ['AaD3rtT', 'At', 'Al'],
                        ['ZNTbx8XnWx', 'imHgQJWlyw', 'a'],
                        ['ZNTbx8XnWx', 'ZNTbx8XnWz', 'ZNTbx8XnWxt'],
                        [null, 'z', 'r'],
                        [null, 'zz', 'r'],
                        [null, 'zzz', 'r'],
                        ['z', null, 'zr'],
                        ['zz', null, 'zzr'],
                        ['zzz', null, 'zzzr'],
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
