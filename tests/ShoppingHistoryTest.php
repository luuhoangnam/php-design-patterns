<?php


use Nam\Factory\ShoppingCart;
use Nam\Gateway\InMemoryCart;
use Nam\Gateway\ShoppingHistory;

class ShoppingHistoryTest extends PHPUnit_Framework_TestCase
{

    public function testItCanStorePersistenceCartInMemory()
    {
        // Prepare
        $gateway = new InMemoryCart;
        $history = new ShoppingHistory( $gateway );

        // Act
        $history->persistCart( new ShoppingCart );
        $carts = $history->listAllCarts();

        // Assert
        $this->assertCount( 1, $carts );
        $this->assertInstanceOf( 'Nam\Factory\ShoppingCart', $carts[0] );
    }
}
 