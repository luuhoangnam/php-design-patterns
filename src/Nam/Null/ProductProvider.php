<?php


namespace Nam\Null;


use Nam\Factory\Keyboard;

class ProductProvider
{
    public function findProduct( $id )
    {
        if ($id === 0) {
            return new Keyboard;
        }

        return new NullProduct;
    }
} 