<?php


namespace Nam\Singleton;


class DiscountProvider
{
    private static $instance;

    private function __construct()
    {

    }

    /**
     * @return DiscountProvider
     */
    public static function getInstance()
    {
        if ( ! ( static::$instance instanceof DiscountProvider )) {
            static::$instance = new DiscountProvider;
        }

        return static::$instance;
    }

    /**
     * @param integer $productId
     *
     * @return integer
     */
    public function getDiscountFor($productId)
    {
        // return discount
    }
} 