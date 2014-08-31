<?php


namespace Nam\Proxy;


class ShoppingCart implements Cart
{

    private $products;

    public function getProducts()
    {
        return $this->products;
    }
}