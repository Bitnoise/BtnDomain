<?php

namespace Btn\Domain\Exception;

use Assert\InvalidArgumentException as BaseInvalidArgumentException;

class InvalidArgumentException extends BaseInvalidArgumentException
{
    const UNIQUE_ERROR = 1;

    /**
     * @param      $propertyPath
     * @param      $value
     *
     * @param null $propertyNameValue
     * @return InvalidArgumentException
     */
    public static function createUnique($propertyPath, $value, $propertyNameValue=null)
    {
        $message = sprintf('There already is %s with value %s', $propertyNameValue ? $propertyNameValue : $propertyPath, $value);

        return new self($message, self::UNIQUE_ERROR, $propertyPath, $value);
    }
}
