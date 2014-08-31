<?php


use Nam\Factory\ShoppingCart;

class FactoryTest extends PHPUnit_Framework_TestCase
{
    public function testItCanAddProducts()
    {
        $cart = new ShoppingCart;
        $cart->add( 'keyboard' );
        $cart->add( 'mouse' );
        $productsInTheCart = $cart->getProductsInTheCart();

        $this->assertCount( 2, $productsInTheCart );
        $this->assertInstanceOf( 'Nam\Factory\Keyboard', $productsInTheCart[0] );
        $this->assertInstanceOf( 'Nam\Factory\Mouse', $productsInTheCart[1] );
    }
}