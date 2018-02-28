<?php
/**
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2016 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\JsonModel;
use Zend\View\Model\ViewModel;
use Application\Service\CurrencyConverter;
use Application\Form\ContactForm;


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
//        var_dump($convertedValue1);
//        var_dump("<br /><br />");
//        var_dump($convertedValue2);
//        var_dump("<br /><br />");

        // Access URL plugin
        $urlPlugin = $this->url();

        // Access Layout plugin
        $urlPlugin = $this->layout();

        // Access Redirect plugin
        $urlPlugin = $this->redirect();

        // Check if site user is allowed to visit the "index" page
        $isAllowed = $this->access()->checkAccess('index');

//        exit;

        $appName        = 'HelloWorld';
        $appDescription = 'A sample application for the Using Zend Framework 3 book';

        $viewModel = new ViewModel([
            'appName'           => $appName,
            'appDescription'   => $appDescription
        ]);
        $viewModel->setTemplate('application/index/test');
        return $viewModel;
//        return new ViewModel([
//            'appName'           => $appName,
//            'appDescription'   => $appDescription
//        ]);
    }

    public function getJsonAction()
    {
        return new JsonModel([
            'status'    => 'success',
            'message'   => 'Here is your data',
            'data'      => [
                'full_name' => 'John Doe',
                'address' => '51 Middle st.'
            ],
        ]);
    }

    public function docAction()
    {
        $pageTemplate = 'application/index/doc' . $this->params()->fromRoute('page', 'documentation.phtml');

        $filePath = __DIR__ . '/../../view/'. $pageTemplate . '.phtml';

        if (!file_exists($filePath) || !is_readable($filePath)) {
            $this->getResponse()->setStatusCode(404);
            return;
        }
        $viewModel = new ViewModel([
            'page' => $pageTemplate
        ]);
        $viewModel->setTemplate($pageTemplate);

        return $viewModel;
    }

    public function staticAction()
    {
        $pageTemplate = $this->params()->fromRoute('page', null);
        if ($pageTemplate==null) {
            $this->getResponse()->setStatusCode(404);
            return;
        }

        $viewModel = new ViewModel([
            'page' => $pageTemplate
        ]);
        $viewModel->setTemplate($pageTemplate);
        return $viewModel;
    }

    public function contactUsAction()
    {
        // create contact us form
        $form = new ContactForm();

        $data = [];

//        var_dump($this->getRequest()->isPost());


        // check if user has submitted the form
        if ($this->getRequest()->isPost()) {
            // fill in the form with POST data
            $data = $this->params()->fromPost();
            $form->setData($data);

            // validate form
            if ($form->isValid()) {

                // get filtered and validated data
                $data = $form->getData();

                // do sth ...

                // redirect to thank you page
                return $this->redirect()->toRoute('application', ['action' => 'thankYou']);
            }
        }

        // pass form variable to view
        return new viewModel([
            'form' => $form
        ]);

        return new ViewModel([
            'form' => $data
        ]);
    }
}
