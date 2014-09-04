<?php


namespace Nam\Observer;


interface ProductObserver
{
    public function __construct(ProductSubject $subject);

    public function update();
}