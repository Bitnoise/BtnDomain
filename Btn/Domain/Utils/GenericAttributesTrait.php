<?php

namespace Btn\Domain\Utils;

trait GenericAttributesTrait
{
    private $genericAttributes;


    public function setAttribute($name, $argument)
    {
        $this->genericAttributes[$name] = $argument;
    }

    public function getAttribute($name)
    {
        return isset($this->genericAttributes[$name]) ? $this->genericAttributes[$name] : null;
    }
}
