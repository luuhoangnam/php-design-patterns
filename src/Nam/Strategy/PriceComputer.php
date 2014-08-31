<?php


namespace Nam\Strategy;


class PriceComputer
{
    public function calculate( $price, PriceCalculator $calculator = null )
    {
        $calculator->applyDiscounts( $price );
        $calculator->addTaxes( $price );
        $calculator->convertCurrencies( $price );

        return $price;
    }

}