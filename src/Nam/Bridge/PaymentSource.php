<?php


namespace Nam\Bridge;


interface PaymentSource
{
    public function approve();

    public function send();
} 