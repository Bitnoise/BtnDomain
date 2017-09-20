<?php

namespace Btn\Domain\User;

use Btn\Domain\ValueObject\Id;

trait UserAwareTrait
{
    private $userId;

    /**
     * @param $userId
     *
     * @throws \Exception
     */
    public function setUserId($userId)
    {
        $this->userId = (string) Id::create($userId);
    }

    /**
     * @throws \Exception
     *
     * @return Id|null
     */
    public function getUserId()
    {
        return $this->userId ? Id::create($this->userId) : null;
    }

    /**
     * @throws \Exception
     *
     * @return Id|null
     */
    public function userId()
    {
        return $this->getUserId();
    }
}
