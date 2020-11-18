<?php
declare(strict_types=1);

namespace PcComponentes\LexRanking\Token;

final class NumericTokenSet extends TokenSet
{
    public function __construct()
    {
        parent::__construct(\array_map('strval', \range('0', '9')));
    }
}
