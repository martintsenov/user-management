<?php

namespace UserManagement\Listener;

use Zend\EventManager\AbstractListenerAggregate;
use Zend\EventManager\EventManagerInterface;
use Zend\Mvc\MvcEvent;

class AccessListener extends AbstractListenerAggregate
{
    public function attach(EventManagerInterface $events)
    {
        $this->listeners[] = $events->attach(MvcEvent::EVENT_ROUTE, [$this, 'restrictAccess']);

        return $this;
    }

    public function restrictAccess(MvcEvent $event)
    {
        // check authorization logic
    }
}
