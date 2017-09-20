<?php

namespace Btn\Domain\Exception;

use Btn\Domain\ValueObject\Id;

class EntityNotFoundException extends \Exception
{
    public static function byId(Id $id)
    {
        return new self(sprintf('Could not find by id %s', $id->value()));
    }
}
