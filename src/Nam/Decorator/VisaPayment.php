<?php


namespace Nam\Decorator;


class VisaPayment implements PaymentMethod
{
    public function getDescription()
    {
        return 'VisaPayment';
    }
} 