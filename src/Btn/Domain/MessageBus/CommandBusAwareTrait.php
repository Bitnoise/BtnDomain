<?php

namespace Btn\Domain\MessageBus;

use SimpleBus\Message\Bus\MessageBus;

trait CommandBusAwareTrait
{
    /** @var MessageBus */
    private $commandBus;

    /**
     * @param MessageBus $commandBus
     */
    public function setCommandBus(MessageBus $commandBus)
    {
        $this->commandBus = $commandBus;
    }

    /**
     * @param $command
     */
    public function handleCommand($command)
    {
        $this->commandBus()->handle($command);
    }

    /**
     * @throws \Exception
     *
     * @return MessageBus
     */
    private function commandBus()
    {
        if (!$this->commandBus) {
            throw new \Exception('Command bus was not injected to trait');
        }

        return $this->commandBus;
    }
}
