<?php


namespace Nam\Singleton;


use Nam\Factory\Product;

class PriceCalculator
{
    public function compute(Product $product)
    {
        $discountProvider = DiscountProvider::getInstance();

        $price = $product->getPrice();
        $discountAsValue = $price * $discountProvider->getDiscountFor($product->getId());
        return $price - $discountAsValue;
    }
} 