<?php


namespace Nam\Template;


class SellProducts extends Sell
{
    private $provider;

    public function orderNewItem()
    {
        $this->provider->orderNewItem($this);
    }
}