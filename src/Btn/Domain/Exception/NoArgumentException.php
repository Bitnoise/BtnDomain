<?php

namespace Btn\Domain\Exception;

class NoArgumentException extends \Exception
{
    public static function create($message)
    {
        return new self($message);
    }
}
