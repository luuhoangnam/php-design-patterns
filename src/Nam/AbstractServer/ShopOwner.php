<?php


namespace Nam\AbstractServer;


class ShopOwner
{
    /**
     * @var Rose
     */
    private $rose;

    public function __construct(Rose $rose)
    {
        $this->rose = $rose;
    }

    public function sell()
    {
        $this->rose->sell();
    }
} 