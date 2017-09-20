<?php

namespace Btn\Domain\Utils;

trait ArrayTrait
{
    /** @var \Reflection */
    private $reflection;

    /**
     * @param array $input
     *
     * @return static
     */
    public static function createFromArray(array $input)
    {
        $obj = new static();
        $obj->fillFromArray($input);

        return $obj;
    }

    /**
     * @param array $array
     */
    public function fillFromArray(array $array)
    {
        foreach ($array as $property => $value) {
            $this->trySetProperty($property, $value);
        }
    }

    /**
     * @return array
     */
    public function toArray()
    {
        $result = [];

        foreach (get_object_vars($this) as $property => $value) {
            if ($this->hasPublicProperty($property)) {
                $result[$property] = $value;
                continue;
            }

            $getter = 'get' . ucfirst($property);
            if (method_exists($this, $getter)) {
                $result[$property] = $this->$getter();
                continue;
            }

            if (method_exists($this, $property)) {
                $result[$property] = $this->$property();
                continue;
            }
        }

        return $result;
    }

    /**
     * @param $property
     * @param $value
     */
    private function trySetProperty($property, $value)
    {
        // ignore null values
        if (null === $value) {
            return;
        }

        // if object don't have properties then skip it.
        if (!property_exists($this, $property)) {
            return;
        }

        if ($this->hasPublicProperty($property)) {
            $this->trySetPublicProperty($property, $value);
        } else {
            $this->trySetNonPublicProperty($property, $value);
        }
    }

    /**
     * @param $property
     * @param $value
     */
    private function trySetPublicProperty($property, $value)
    {
        // if value already set then don't override it
        if (null !== $this->$property) {
            return;
        }

        $this->$property = $value;
    }

    /**
     * @param $property
     * @param $value
     */
    private function trySetNonPublicProperty($property, $value)
    {
        $getter = 'get' . ucfirst($property);
        if (!method_exists($this, $getter)) {
            return;
        }

        $setter = 'set' . ucfirst($property);
        if (!method_exists($this, $setter)) {
            return;
        }

        // if value already set, then ignore
        if (null !== $this->$getter()) {
            return;
        }

        $this->$setter($value);
    }

    /**
     * @param string $property
     *
     * @return bool
     */
    private function hasPublicProperty($property)
    {
        if (!$this->reflection) {
            $this->reflection = new \ReflectionClass($this);
        }

        if (!$this->reflection->hasProperty($property)) {
            return false;
        }

        return $this->reflection->getProperty($property)->isPublic();
    }
}
