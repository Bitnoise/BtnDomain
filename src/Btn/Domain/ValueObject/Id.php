<?php

namespace Btn\Domain\ValueObject;

use Assert\Assert;

class Id
{
    /** @var string */
    private $id;

    /**
     * @param string $id
     */
    public function __construct($id)
    {
        Assert::that($id)->uuid();

        $this->id = $id;
    }

    public function value()
    {
        return $this->id;
    }

    public function __toString()
    {
        return (string) $this->id;
    }

    /**
     * @param mixed $input
     *
     * @throws \Exception
     *
     * @return Id
     */
    public static function create($input)
    {
        if ($input instanceof self) {
            return new self((string) $input);
        }

        if (is_string($input)) {
            return new self($input);
        }

        if (is_object($input) && method_exists($input, 'getId')) {
            return new self($input->getId());
        }

        throw new \Exception('Could not create Id value object');
    }

    /**
     * @param mixed $id
     *
     * @return bool
     */
    public function equals($id)
    {
        return $this->id === (string) self::create($id);
    }
}
