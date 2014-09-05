<?php


namespace Nam\Decorator;


class HtmlPaymentDetails extends PaymentDecorator
{
    public function getHtmlDescription()
    {
        return "<html><body><div>{$this->paymentMethod->getDescription()}</div></body></html>";
    }
} 