<?php


namespace Nam\Mediator;


class OrderDelivery implements UserAddress
{

    private $deliveryAddress;

    public function setAddress($address)
    {
        $this->deliveryAddress = $address;
    }
}