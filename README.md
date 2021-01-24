# PSR-14 event dispatcher 


Create an Event

```php
<?php


namespace App\Event;

use App\Entity\User;
use DevCoder\Listener\Event;

/**
 * Class PreCreateEvent
 * @package App\Event
 */
class PreCreateEvent extends Event
{

    /**
     * @var object
     */
    private $object;

    /**
     * PreCreateEvent constructor.
     * @param object $object
     */
    public function __construct(object $object)
    {
        $this->object = $object;
    }

    /**
     * @return object
     */
    public function getObject(): object
    {
        return $this->object;
    }
}
```

Create listener
```php
<?php

namespace App\Listener;

use App\Entity\User;
use App\Event\PreCreateEvent;

/**
 * Class SecurityListener
 * @package App\Listener
 */
class UserListener
{
    /**
     * @param PreCreateEvent $event
     */
    public function __invoke(PreCreateEvent $event): void
    {
        $object = $event->getObject();

        if ($object instanceof User) {
            // do something
        }
    }
}

```

**How to use ?**
```php
$listenerProvider = (new ListenerProvider())
        ->addListener(PreCreateEvent::class, new UserListener());

$dispatcher = new EventDispatcher($listenerProvider);

// After flush user in database send event

$dispatcher = new EventDispatcher($listenerProvider);
$dispatcher->dispatch(new PreCreateEvent($user));
```
*UserListener::class will be automatically call*
