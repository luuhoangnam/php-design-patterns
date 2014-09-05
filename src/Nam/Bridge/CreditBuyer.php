<?php


namespace Nam\Bridge;


class CreditBuyer
{
    public function payNow(CreditPayment $payment)
    {
        if ($payment->approve()) {
            $payment->send();
        }
    }

} 