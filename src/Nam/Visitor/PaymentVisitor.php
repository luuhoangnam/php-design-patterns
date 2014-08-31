<?php


namespace Nam\Visitor;


interface PaymentVisitor
{
    public function visit( PaymentMethod $paymentMethod );

    public function getDescription();
} 