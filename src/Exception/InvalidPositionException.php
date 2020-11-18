<?php
declare(strict_types=1);

namespace PcComponentes\LexRanking\Exception;

final class InvalidPositionException extends \InvalidArgumentException
{
    public function __construct()
    {
        parent::__construct('Invalid gap.', 0, null);
    }
}
