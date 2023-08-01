<?php

namespace _lib\events;

Class Event implements EventInterface 
{
    private string $name = "";

    private array $params = [];

    private mixed $target = [];

    private bool $propagationStooped = false;

    /**
     * Get event name
     *
     * @return string
     */
    public function getName(){
        return $this -> name;
    }

    /**
     * Get target/context from which event was triggered
     *
     * @return null|string|object
     */
    public function getTarget(){
        return $this -> target;
    }

    /**
     * Get parameters passed to the event
     *
     * @return array
     */
    public function getParams(){

        return $this -> params;

    }

    /**
     * Get a single parameter by name
     *
     * @param  string $name
     * @return mixed
     */
    public function getParam($name){
        return $this -> params[$name] ?? null;
    }

    /**
     * Set the event name
     *
     * @param  string $name
     * @return void
     */
    public function setName($name){
        $this -> name = $name;

    }

    /**
     * Set the event target
     *
     * @param  null|string|object $target
     * @return void
     */
    public function setTarget($target){
        $this -> target = $target;
    }

    /**
     * Set event parameters
     *
     * @param  array $params
     * @return void
     */
    public function setParams(array $params){
        $this -> params = $params;
    }

    /**
     * Indicate whether or not to stop propagating this event
     *
     * @param  bool $flag
     */
    public function stopPropagation($flag){
        $this -> propagationStooped = $flag;
    }
    /**
     * Has this event indicated event propagation should stop?
     *
     * @return bool
     */
    public function isPropagationStopped(){
        return $this -> propagationStooped;
    }
}