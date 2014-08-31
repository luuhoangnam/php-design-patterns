<?php


use Nam\Visitor\HtmlPaymentDetails;
use Nam\Visitor\SimplePaymentDetails;
use Nam\Visitor\VisaPayment;

class VisitorTest extends PHPUnit_Framework_TestCase
{

    public function testItCanProvideSimpleDescription()
    {
        $simpleDetails = new SimplePaymentDetails;
        $visaPayment   = new VisaPayment;

        $visaPayment->accept( $simpleDetails );

        $this->assertEquals( 'Visa Description', $simpleDetails->getDescription() );
    }

    public function testItCanProvideHtmlDescription()
    {
        $htmlDetails = new HtmlPaymentDetails;
        $visaPayment = new VisaPayment;

        $visaPayment->accept( $htmlDetails );

        $this->assertEquals( '<html><body><div>Visa Description</div></body></html>', $htmlDetails->getDescription() );
    }
} 