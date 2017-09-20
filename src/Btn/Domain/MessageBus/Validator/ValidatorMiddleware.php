<?php

namespace Btn\Domain\MessageBus\Validator;

use Btn\Domain\DataTransferObject\ValidatableDataTransferObjectInterface;
use SimpleBus\Message\Bus\Middleware\MessageBusMiddleware;

class ValidatorMiddleware implements MessageBusMiddleware
{
    /** @var ValidatorResolver */
    private $validatorResolver;

    /**
     * @param ValidatorResolver $validatorResolver
     */
    public function __construct(ValidatorResolver $validatorResolver)
    {
        $this->validatorResolver = $validatorResolver;
    }

    /**
     * {@inheritdoc}
     */
    public function handle($message, callable $next)
    {
        if ($message instanceof ValidatableCommandInterface) {
            $message->validate();
        }

        if ($message instanceof ValidatableDataTransferObjectInterface) {
            $message->validate();
        }

        $className = get_class($message);
        if ($this->validatorResolver->has($className)) {
            $this->validatorResolver->get($className)->validate($message);
        }

        $next($message);
    }
}
