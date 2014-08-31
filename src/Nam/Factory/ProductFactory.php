<?php


namespace Nam\Factory;


class ProductFactory
{
    private function isKeyboard( $productId )
    {
        return substr( $productId, 0, 1 ) === 'k';
    }

    /**
     * @param string $productId
     *
     * @return \Nam\Factory\Keyboard|\Nam\Factory\Mouse
     */
    public function make( $productId )
    {
        if ($this->isKeyboard( $productId )) {
            return new Keyboard;
        }
        return new Mouse;
    }
} 