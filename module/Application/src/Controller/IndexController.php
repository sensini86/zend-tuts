<?php
/**
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2016 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Application\Service\CurrencyConverter;

class IndexController extends AbstractActionController
{
    /**
     * Currency Converter
     * @var Application\Service\CurrencyConverter
     */
    private $currencyConverter;

    public function __construct($currencyConverter)
    {
        $this->currencyConverter = $currencyConverter;
    }

    public function indexAction()
    {
        $request    = $this->getRequest();
        $response   = $this->getResponse();



        $convertedValue1 = $this->currencyConverter->convertEURtoUSD(10);
        $convertedValue2 = $this->currencyConverter->convertEURtoUSD(20);
        var_dump($convertedValue1);
        var_dump("<br /><br />");
        var_dump($convertedValue2);
        var_dump("<br /><br />");
        exit;

        $appName        = 'HelloWorld';
        $appDescription = 'A sample application for the Using Zend Framework 3 book';

        return new ViewModel([
            'appName'           => $appName,
            'appDescription'   => $appDescription
        ]);
    }

}
