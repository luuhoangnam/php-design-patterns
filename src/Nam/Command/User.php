<?php


namespace Nam\Command;


class User
{
    private $paymentMethod;

    /**
     * @return VisaPayment|PaypalPayment
     */
    public function getPaymentMethod()
    {
        return $this->paymentMethod;
    }
}