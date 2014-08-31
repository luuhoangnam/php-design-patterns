<?php


use Nam\Factory\Keyboard;
use Nam\Null\Receipt;

class NullObjectPatternTest extends PHPUnit_Framework_TestCase
{

    public function testNullBehaviour()
    {
        $this->assertEquals( 2, null + 2 );
        $this->assertEquals( 'nothing', null . 'nothing' );

        $this->assertTrue( null == 0 );
        $this->assertTrue( null < - 1 );

        $this->assertFalse( null && false );
        $this->assertNull( null );
    }

    public function testReceiptCanAddProductsToItsTotal()
    {
        $receipt = new Receipt;
        $receipt->addProduct(new Keyboard);

        $this->assertEquals(50, $receipt->getTotal());

        $receipt->addProductById(1);

        $this->assertEquals(50, $receipt->getTotal());
    }

}
 