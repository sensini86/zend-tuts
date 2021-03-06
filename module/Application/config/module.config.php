<?php
/**
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2016 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application;

use Application\Route\StaticRoute;
use Zend\Router\Http\Literal;
use Zend\Router\Http\Regex;
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
            'doc' => [
                'type' => Regex::class,
                'options' => [
                    'regex' => '/doc(?<page>\/[a-zA-Z0-9_\-]+)\.html',
                    'defaults' => [
                        'controller' => Controller\IndexController::class,
                        'action' => 'doc',
                    ],
                    'spec' => '/doc/%page%.html'
                ],
            ],
            'static' => [
                'type' => StaticRoute::class,
                'options' => [
                    'dir_name' => __DIR__ . '/../view',
                    'template_prefix' => 'application/index/static',
                    'filename_pattern' => '/[a-z0-9_\-]+/',
                    'defaults' => [
                        'controller' => Controller\IndexController::class,
                        'action' => 'static',
                    ]
                ],
            ],
            'contactus' => [
                'type' => Literal::class,
                'options' => [
                    'route' => '/contactus',
                    'defaults' => [
                        'controller' => Controller\IndexController::class,
                        'action' => 'contactUs'
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
            Controller\IndexController::class => Controller\Factory\IndexControllerFactory::class,
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
            Service\MailSender::class => InvokableFactory::class
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
    'view_helpers' => [
        'factories' => [
            View\Helper\Menu::class => InvokableFactory::class,
            View\Helper\Breadcrumbs::class => InvokableFactory::class,
        ],
        'aliases' => [
            'mainMenu' => View\Helper\Menu::class,
            'pageBreadcrumbs' => View\Helper\Breadcrumbs::class,
        ],
    ],

];
