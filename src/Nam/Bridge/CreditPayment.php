<?php


namespace Nam\Bridge;


interface CreditPayment
{
    public function send();

    public function approve();
}