<?php


namespace Nam\Bridge;


class DirectPaymentMethod extends PaymentMethod
{

    public function approve()
    {
        return true;
    }

    public function send()
    {
        parent::sendImpl();
    }
}