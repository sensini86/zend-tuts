<?php
/**
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2016 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application;

use Zend\Router\Http\Literal;
use Zend\Router\Http\Segment;
use Zend\ServiceManager\Factory\InvokableFactory;
use Zend\Mvc\Controller\LazyControllerAbstractFactory;
use Application\Service\CurrencyConverter;

return [
    'router' => [
        'routes' => [
            'home' => [
                'type' => Literal::class,
                'options' => [
                    'route'    => '/',
                    'defaults' => [
                        'controller' => Controller\IndexController::class,
                        'action'     => 'index',
                    ],
                ],
            ],
            'application' => [
                'type'    => Segment::class,
                'options' => [
                    'route'    => '/application[/:action]',
                    'defaults' => [
                        'controller' => Controller\IndexController::class,
                        'action'     => 'index',
                    ],
                ],
            ],
            // Add this route for Download Controller
            'download' => [
                'type' => Segment::class,
                'options' => [
                    'route' => '/download[/:action]',
                    'defaults' => [
                        'controller' => Controller\DownloadController::class,
                        'action'     => 'index'
                    ],
                ],
            ],
            'getJson' => [
                'type' => Literal::class,
                'options' => [
                    'route' => '/getJson',
                    'defaults' => [
                        'controller' => Controller\IndexController::class,
                        'action' => 'getJson'
                    ],
                ],
            ],
        ],
    ],
    'controllers' => [
        'factories' => [
//            Controller\IndexController::class => InvokableFactory::class,
            Controller\IndexController::class => Controller\Factory\IndexControllerFactory::class,
//            Controller\IndexController::class => LazyControllerAbstractFactory::class,
        Controller\DownloadController::class => InvokableFactory::class,
        ],
    ],
    'service_manager' => [
        'services' => [
            // Register service class instances here
        ],
        'invokables' => [
            // Register invokables class here
        ],
        'factories' => [
            // register CurrencyConverter service
//            CurrencyConverter::class => InvokableFactory::class
            Service\CurrencyConverter::class => InvokableFactory::class,
//            Service\CurrencyConverter::class => Service\Factory\PostManagerFactory::class,
        ],
        'abstract_factories' => [
            // Register abstract factories here
        ],
        'aliases' => [
            // Register service aliases here
        ],
        'shared' => [
            // Specify here wich services must be non-shared
        ],
    ],
    'controller_plugins' => [
        'factories' => [
            Controller\Plugin\AccessPlugin::class => InvokableFactory::class,
        ],
        'aliases' => [
            'access' => Controller\Plugin\AccessPlugin::class,
        ],
    ],
    'view_manager' => [
        'display_not_found_reason' => true,
        'display_exceptions'       => true,
        'doctype'                  => 'HTML5',
        'not_found_template'       => 'error/404',
        'exception_template'       => 'error/index',
        'template_map' => [
            'layout/layout'           => __DIR__ . '/../view/layout/layout.phtml',
            'application/index/index' => __DIR__ . '/../view/application/index/index.phtml',
            'error/404'               => __DIR__ . '/../view/error/404.phtml',
            'error/index'             => __DIR__ . '/../view/error/index.phtml',
        ],
        'template_path_stack' => [
            __DIR__ . '/../view',
        ],
        'strategies' => [
            'ViewJsonStrategy',
        ],
    ],
];
