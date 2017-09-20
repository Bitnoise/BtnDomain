<?php

namespace Btn\Domain\MessageBus;

use SimpleBus\Message\Bus\MessageBus;

trait EventBusAwareTrait
{
    /** @var MessageBus */
    private $eventBus;

    /**
     * @param MessageBus $eventBus
     */
    public function setEventBus(MessageBus $eventBus)
    {
        $this->eventBus = $eventBus;
    }

    /**
     * @param $event
     */
    public function handleEvent($event)
    {
        $this->eventBus()->handle($event);
    }

    /**
     * @throws \Exception
     *
     * @return MessageBus
     */
    private function eventBus()
    {
        if (!$this->eventBus) {
            throw new \Exception('Event bus was not injected to trait');
        }

        return $this->eventBus;
    }
}
