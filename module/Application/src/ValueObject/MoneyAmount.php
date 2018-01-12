<?php
namespace Application\ValueObject;


class MoneyAmount
{
    // Properties
    private $currency;
    private $amount;

    public function __construct($amount, $currency = 'USD')
    {
        $this->amount = $amount;
        $this->currency = $currency;
    }

    /**
     * @return mixed
     */
    public function getCurrency()
    {
        return $this->currency;
    }

    /**
     * @return mixed
     */
    public function getAmount()
    {
        return $this->amount;
    }


}