<?php

namespace _lib\events;

class EventManager implements EventManagerInterface
{

    private array $listeners = [];





    /**
     * Attaches a listener to an event
     *
     * @param string $event the event to attach too
     * @param callable $callback a callable function
     * @param int $priority the priority at which the $callback executed
     * @return bool true on success false on failure
     */
    public function attach($event, $callback, $priority = 0) {

        $this -> listeners[$event][] = [
            'callback' => $callback,
            'priority' => $priority
        ];

        return true;
    }

    /**
     * Detaches a listener from an event
     *
     * @param string $event the event to attach too
     * @param callable $callback a callable function
     * @return bool true on success false on failure
     */
    public function detach($event, $callback) {
        $this->listeners[$event] = array_filter($this->listeners[$event], function($listener) use ($callback) {
            return $listener['callback'] !== $callback;
        });
        return true;
    }

    /**
     * Clear all listeners for a given event
     *
     * @param  string $event
     * @return void
     */
    public function clearListeners($event) {
        $this->listeners[$event] = [];
    }

    /**
     * Trigger an event
     *
     * Can accept an EventInterface or will create one if not passed
     *
     * @param  string|EventInterface $event
     * @param  object|string $target
     * @param  array|object $argv
     * @return mixed
     */
    public function trigger($event, $target = null, $argv = array()) {

        if (is_string($event)) {
            $this->makeEvent($event, $target, $argv);
        }

        if (isset($this->listeners[$event->getName()])) {
            $listeners = $this->listeners[$event->getName()];

            usort($listeners, function($listenerA,$listenerB){
                return $listenerB['priority'] - $listenerA['priority'];
            });
            foreach ($listeners as ['callback' => $callback])
            call_user_func($callback, $event);
        }
        return;
    }

    private function makeEvent(string $name, $target = null, array $argv = []):EventInterface {
        $event = new Event();
        $event ->setName($name);
        $event ->setTarget($target);
        $event ->setParams($argv);

        return $event;
    }
}