<?php

namespace Btn\Domain\MessageBus\Validator;

class ValidatorResolver
{
    /** @var array */
    private $validators = [];

    /**
     * @param $validator
     * @param $for
     */
    public function addValidator($validator, $for)
    {
        $this->validators[$for] = $validator;
    }

    /**
     * @param $for
     *
     * @return bool
     */
    public function has($for)
    {
        return array_key_exists($for, $this->validators);
    }

    /**
     * @param $for
     *
     * @throws \Exception
     *
     * @return mixed
     */
    public function get($for)
    {
        if (!$this->has($for)) {
            throw new \Exception(sprintf('Validator for "%s" is missing', $for));
        }

        return $this->validators[$for];
    }
}
