<?php declare(strict_types=1);

namespace PcComponentes\LexRanking\Exception;

final class InvalidTokenSetException extends \InvalidArgumentException
{
    public function __construct()
    {
        parent::__construct('Invalid token set.', 0, null);
    }
}
