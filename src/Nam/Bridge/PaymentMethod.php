<?php


namespace Nam\Bridge;


abstract class PaymentMethod implements DirectPayment, CreditPayment
{
    /**
     * @var PaymentSource
     */
    private $paymentSource;

    public abstract function approve();

    public abstract function send();

    public function setPaymentSource(PaymentSource $paymentSource)
    {
        $this->paymentSource = $paymentSource;
    }

    protected function sendImpl()
    {
        $this->paymentSource->send();
    }

    protected function approveImpl()
    {
        $this->paymentSource->approve();
    }
}