<?php


namespace Nam\Decorator;


abstract class PaymentDecorator
{
    /**
     * @var PaymentMethod
     */
    protected $paymentMethod;

    public function __construct(PaymentMethod $paymentMethod)
    {
        $this->paymentMethod = $paymentMethod;
    }

    public function getDescription()
    {
        $this->paymentMethod->getDescription();
    }
}