<?php declare(strict_types=1);

namespace AdnanMula\LexRanking\Exception;

final class InvalidMaxLengthException extends \InvalidArgumentException
{
    public function __construct()
    {
        parent::__construct('Invalid max length.', 0, null);
    }
}
