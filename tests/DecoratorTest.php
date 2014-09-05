<?php


use Nam\Decorator\HtmlPaymentDetails;
use Nam\Decorator\VisaPayment;

class DecoratorTest extends PHPUnit_Framework_TestCase
{

    public function testItCanProvideDescription()
    {
        $visaPayment = new VisaPayment;
        $htmlDetails = new HtmlPaymentDetails($visaPayment);

        $this->assertEquals("<html><body><div>VisaPayment</div></body></html>", $htmlDetails->getHtmlDescription());
    }
}
 