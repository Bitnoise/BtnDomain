<?php

namespace Btn\Domain\MessageBus;

use Btn\Domain\DataTransferObject\AbstractDataTransferObject;
use Btn\Domain\MessageBus\Validator\ValidatableCommandInterface;

abstract class AbstractCommand extends AbstractDataTransferObject implements ValidatableCommandInterface
{
}
