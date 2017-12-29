<?php
/**
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2016 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class IndexController extends AbstractActionController
{
    public function indexAction()
    {
        var_dump(
            nl2br(__DIR__         . " | returns the current working directory\r\n\t" . PHP_EOL),
            nl2br(__FILE__        . " | returns the current working directory and file name" . PHP_EOL),
            nl2br(__CLASS__       . " | returns the current working class name and namespace if definded" . PHP_EOL),
            nl2br( __FUNCTION__    . " | returns the current function name" . PHP_EOL),
            nl2br(__LINE__        . " | returns the current line number at the time of use point" . PHP_EOL),
            nl2br( __NAMESPACE__   . " | returns the current namespace" . PHP_EOL),
            nl2br(__METHOD__      . " | returns the current method name" . PHP_EOL),
            nl2br(__TRAIT__       . " | returns the current trait name and namsepace if defined" . PHP_EOL)
        );


        exit;

        return new ViewModel();
    }

}
