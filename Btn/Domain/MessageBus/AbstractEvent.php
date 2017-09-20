<?php

namespace Btn\Domain\MessageBus;

use Btn\Domain\Utils\GenericAttributesTrait;
use Btn\Domain\Utils\IdAwareTrait;
use Btn\Domain\User\UserAwareTrait;

abstract class AbstractEvent
{
    use UserAwareTrait;
    use IdAwareTrait;
    use GenericAttributesTrait;

    /**
     * @param mixed $id
     * @param mixed $user - user which execute action
     *
     * @throws \Exception
     */
    public function __construct($id, $user = null)
    {
        $this->setId($id);
        if ($user) {
            $this->setUserId($user);
        }
    }
}
