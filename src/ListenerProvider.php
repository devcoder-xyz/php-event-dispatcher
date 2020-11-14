<?php


namespace DevCoder\Listener;


use Psr\EventDispatcher\ListenerProviderInterface;

/**
 * Class ListenerProvider
 * @package DevCoder\Listener
 */
class ListenerProvider implements ListenerProviderInterface
{

    /**
     * @var array
     */
    private $listeners = [];

    /**
     * @param object $event
     *   An event for which to return the relevant listeners.
     * @return iterable[callable]
     *   An iterable (array, iterator, or generator) of callables.  Each
     *   callable MUST be type-compatible with $event.
     */
    public function getListenersForEvent(object $event): iterable
    {
        $eventType = get_class($event);
        if (array_key_exists($eventType, $this->listeners)) {
            return $this->listeners[$eventType];
        }

        return [];
    }


    /**
     * @param string $eventType
     * @param callable $callable
     * @return $this
     */
    public function addListener(string $eventType, callable $callable): self
    {
        $this->listeners[$eventType][] = $callable;
        return $this;
    }

    /**
     * @param string $eventType
     */
    public function clearListeners(string $eventType): void
    {
        if (array_key_exists($eventType, $this->listeners)) {
            unset($this->listeners[$eventType]);
        }
    }
}