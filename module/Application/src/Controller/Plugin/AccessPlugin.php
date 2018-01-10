<?php
namespace Application\Controller\Plugin;

use Zend\Mvc\Controller\Plugin\AbstractPlugin;

class AccessPlugin extends AbstractPlugin
{
    public function checkAccess($actionName)
    {
//        var_dump($actionName);exit;
        return true;
    }
}