<?php


use Nam\AbstractServer\RedRose;
use Nam\AbstractServer\ShopOwner;
use Nam\AbstractServer\YellowRose;

class ShopOwnerTest extends PHPUnit_Framework_TestCase
{

    public function testShopOwnerCanSellRedRose()
    {
        $redRose = new RedRose;
        $shopOwner = new ShopOwner($redRose);
        $shopOwner->sell();

        $this->assertTrue($redRose->isSold());
    }

    public function testShopOwnerCanSellYellowRose()
    {
        $yellowRose = new YellowRose;
        $shopOwner = new ShopOwner($yellowRose);
        $shopOwner->sell();

        $this->assertTrue($yellowRose->isSold());
    }

}
 