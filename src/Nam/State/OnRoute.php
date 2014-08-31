<?php


namespace Nam\State;


class OnRoute implements DeliveryState
{

    public function goNext( Delivery $delivery )
    {
        $delivery->setState( new AtDestination );
    }

    public function getLocation()
    {
        return 'On the train';
    }
}