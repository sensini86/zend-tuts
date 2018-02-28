<?php
/**
 * Created by PhpStorm.
 * User: arivasoft2
 * Date: 2/27/2018
 * Time: 2:48 PM
 */

namespace Application\Form;

use Zend\Form\Form;
use Zend\InputFilter\InputFilter;

class ContactForm extends Form
{
    public function __construct()
    {
        // define form name
        parent::__construct('contact-form');

        // set post method for this form
        $this->setAttribute('method', 'post');

//        // (optionally) set action for this method
//        $this->setAttribute('action', '/contactus');

        // add form elements
        $this->addElements();

        // add filtering/validation rules
        $this->addInputFilter();
    }

    private function addInputFilter()
    {
        $inputFilter = new InputFilter();
        $this->setInputFilter($inputFilter);

        $inputFilter->add([
            'name'      => 'email',
            'required'  => true,
            'filters'   => [
                ['name' => 'StringTrim'],
            ],
            'validators' => [
                [
                    'name' => 'EmailAddress',
                    'options' => [
                        'allow' => \Zend\Validator\Hostname::ALLOW_DNS,
                        'useMxCheck' => false
                    ]
                ]
            ]
        ]);

        $inputFilter->add([
            'name'      => 'subject',
            'required'  => true,
            'filters'   => [
                ['name' => 'StringTrim'],
                ['name' => 'StripTags'],
                ['name' => 'StripNewlines'],
            ],
            'validators' => [
                [
                    'name' => 'StringLength',
                    'options' => [
                        'min' => 1,
                        'max' => 128,
                    ]
                ]
            ]
        ]);

        $inputFilter->add([
            'name'      => 'body',
            'required'  => true,
            'filters'   => [
                ['name' => 'StripTags'],
            ],
            'validators' => [
                [
                    'name' => 'StringLength',
                    'options' => [
                        'min' => 1,
                        'max' => 4096,
                    ]
                ]
            ]
        ]);
    }

    private function addElements()
    {
        $this->add([
            'type'  => 'text',
            'name'  => 'email',
            'attributes' => [
                'id' => 'email'
            ],
            'options' => [
                'label' => 'Your E-mail'
            ],
        ]);

        $this->add([
            'type'  => 'text',
            'name'  => 'subject',
            'attributes' => [
                'id' => 'subject'
            ],
            'options' => [
                'label' => 'Subject'
            ],
        ]);

        $this->add([
            'type'  => 'text',
            'name'  => 'body',
            'attributes' => [
                'id' => 'body'
            ],
            'options' => [
                'label' => 'Message Body'
            ],
        ]);

        $this->add([
            'type'  => 'submit',
            'name'  => 'Submit',
            'attributes' => [
                'value' => 'Submit'
            ],
        ]);
    }
}