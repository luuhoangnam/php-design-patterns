<?php


namespace Nam\Mediator;


class Mediator
{

    /**
     * @var Observable
     */
    private $observedClass;
    /**
     * @var UserAddress
     */
    private $affectedClass;

    public function __construct(Observable $observedClass, UserAddress $affectedClass)
    {
        $this->observedClass = $observedClass;
        $this->affectedClass = $affectedClass;
        $this->observedClass->register($this);
    }

    public function update($address)
    {
        $this->affectedClass->setAddress($address);
    }
}