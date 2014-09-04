<?php


namespace Nam\Mediator;


abstract class Observable
{
    protected $observers = [ ];

    public function register(Mediator $observer)
    {
        $this->observers[] = $observer;
    }

    public function unregister(Mediator $observer)
    {
        foreach ($this->observers as $index => $o) {
            if ($observer === $o) {
                unset( $this->observers[$index] );
            }
        }
    }

    /**
     * @param $hint
     */
    public function notify($hint)
    {
        foreach ($this->observers as $observer) {
            /** @var UserUpdater $observer */
            $observer->update($hint);
        }
    }
} 