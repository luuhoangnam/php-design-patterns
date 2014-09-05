<?php


namespace Nam\Bridge;


class DirectBuyer
{
    public function payNow(DirectPayment $payment)
    {
        $payment->send();
    }
} 