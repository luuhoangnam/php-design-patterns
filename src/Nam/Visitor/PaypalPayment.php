<?php


namespace Nam\Visitor;


class PaypalPayment implements PaymentMethod
{

    public function getDescription()
    {
        return 'Paypal description';
    }

    public function accept( PaymentVisitor $visitor )
    {
        $visitor->visit( $this );
    }
}