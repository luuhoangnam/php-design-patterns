<?php


namespace Nam\Gateway;


use Nam\Factory\ShoppingCart;

interface CartGateway
{
    public function persist( ShoppingCart $cart );

    public function retrieve( $id );

    public function getIdOfRecordedCart();
} 