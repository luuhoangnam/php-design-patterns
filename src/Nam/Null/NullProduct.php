<?php


namespace Nam\Null;


use Nam\Factory\Product;

class NullProduct implements Product
{

    function getPrice()
    {
        return 0;
    }

    function getPicture()
    {
        return 'images/default.png';
    }

    function getDescription()
    {
        return '';
    }
}