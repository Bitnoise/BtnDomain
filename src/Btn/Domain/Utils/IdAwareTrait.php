<?php

namespace Btn\Domain\Utils;

use Btn\Domain\ValueObject\Id;

trait IdAwareTrait
{
    /** @var string */
    private $id;

    public function setId($id)
    {
        if ($this->id) {
            throw new \Exception('Id already set');
        }

        $this->id = (string) Id::create($id);
    }

    /**
     * @throws \Exception
     *
     * @return Id
     */
    public function getId()
    {
        return $this->id ? Id::create($this->id) : null;
    }

    /**
     * @return Id
     */
    public function id()
    {
        return $this->getId();
    }
}
