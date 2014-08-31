<?php


use Nam\State\AtDestination;
use Nam\State\Delivery;
use Nam\State\OnRoute;
use Nam\State\Processing;

class DeliveryStateTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var Delivery
     */
    private $delivery;

    protected function setUp()
    {
        $this->delivery = new Delivery( new Processing );
    }

    protected function tearDown()
    {
        $this->delivery = null;
    }

    public function testItCanCreateADeliveryWithInitialState()
    {
        $this->assertEquals( 'Warehouse', $this->delivery->getCurrentLocation() );
    }

    public function testItCanGoFromProcessingToOnRoute()
    {
        $this->delivery->goNext();

        $this->assertEquals( 'On the train', $this->delivery->getCurrentLocation() );
    }

    public function testItCanGoFromOnRouteToDestination()
    {
        $this->delivery = new Delivery( new OnRoute );
        $this->delivery->goNext();

        $this->assertEquals( 'Final Destination', $this->delivery->getCurrentLocation() );
    }

    public function testItRemainsAtFinalDestination()
    {
        $this->delivery = new Delivery( new AtDestination );
        $this->delivery->goNext();

        $this->assertEquals( 'Final Destination', $this->delivery->getCurrentLocation() );
    }


}
 