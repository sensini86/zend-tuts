<?php
namespace Application\Controller\Factory;

use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;
use Application\Service\CurrencyConverter;
use Application\Controller\IndexController;


/**
 * This is the factory for IndexController. Its purpose is to instantiate the controller
 * Class IndexControllerFactory
 * @package Application\Controller\Factory
 */
class IndexControllerFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
//        var_dump(CurrencyConverter::class);
//        exit;

        // Get the instance of CurrencyConverter service from the service manager.
        $currencyConverter = $container->get(CurrencyConverter::class);

        // Create an instance of the controller and pass the dependency to controller's constructor
        return new IndexController($currencyConverter);
    }
}