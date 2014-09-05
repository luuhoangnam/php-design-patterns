<?php


namespace Nam\Decorator;


class PaypalPayment implements PaymentMethod
{
    public function getDescription()
    {
        return 'PaypalPayment';
    }
} 