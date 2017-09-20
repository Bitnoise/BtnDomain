<?php

namespace Btn\Domain\DataTransferObject;

use Btn\Domain\Utils\ArrayTrait;
use Btn\Domain\Utils\IdAwareTrait;
use Btn\Domain\ValueObject\Id;

abstract class AbstractDataTransferObject implements ValidatableDataTransferObjectInterface
{
    use ArrayTrait;
    use IdAwareTrait;

    /**
     * @param string|Id|null $id
     *
     * @throws \Exception
     */
    public function __construct($id = null)
    {
        if ($id) {
            $this->setId($id);
        }
    }

    /**
     * @param $name
     * @param $value
     */
    public function __set($name, $value)
    {
        $this->$name = $value;
    }

    /**
     * @param $name
     *
     * @return mixed
     */
    public function __get($name)
    {
        return $this->$name;
    }

    /**
     * {@inheritdoc}
     */
    public function validate()
    {
        foreach (get_class_methods($this) as $method) {
            if ($method === 'validate') {
                continue;
            }

            if (strpos($method, 'validate') !== 0) {
                continue;
            }

            $this->$method();
        }
    }

    /**
     * @param mixed $input
     *
     * @return static
     */
    public static function createFrom($input)
    {
        if (method_exists($input, 'toArray')) {
            return self::createFromArray($input->toArray());
        }

        throw new \InvalidArgumentException('Invalid input');
    }

    /**
     * @param $input
     */
    public function fillFrom($input)
    {
        if (is_array($input)) {
            $this->fillFromArray($input);

            return;
        }

        if (method_exists($input, 'toArray')) {
            $this->fillFromArray($input->toArray());

            return;
        }

        throw new \InvalidArgumentException('Invalid input');
    }
}
