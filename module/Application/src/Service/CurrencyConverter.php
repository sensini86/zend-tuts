<?php
namespace Application\Service;

//use Zend\ServiceManager\ServiceManager;
//use Zend\ServiceManager\ServiceManagerAwareInterface;

// Define a currency converter service class
class CurrencyConverter
{
    public function convertEURtoUSD($amount)
    {
        return $amount*1.25;
    }
}