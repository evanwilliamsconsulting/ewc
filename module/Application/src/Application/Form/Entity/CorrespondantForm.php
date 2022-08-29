<?php

namespace Application\Form\Entity;

use Zend\Form\Form;

class CorrespondantForm extends Form
{
    public function __construct($name = null)
    {
        parent:: __construct('wordage');

        $this->add(array(
            'name' => 'id',
            'type' => 'hidden'
        ));
        $this->add(array(
            'name'=>'username',
            'type' => 'Text',
            'option' => array(
                'label' => 'username',
            ),
        ));
        $this->add(array(
            'name'=>'password',
            'type' => 'Password',
            'option' => array(
                'label' => 'Password',
            ),
        ));
        $this->add(array(
            'name'=>'email',
            'type' => 'Text',
            'option' => array(
                'label' => 'name',
            ),
        ));
        $this->add(array(
            'name'=>'handle',
            'type' => 'Text',
            'option' => array(
                'label' => 'handle',
            ),
        ));
        $this->add(array(
	    'name'=>'wordage',
            'type' => 'Textarea',
            'options' => array(
                'label' => 'Wordage',
            ),
        ));
        $this->add(array(
            'name' => 'picture',
            'type' => 'File',
            'options' => array(
                'label' => 'picture',
            ),
        ));
        $this->add(array(
            'name' => 'width',
            'type' => 'Number',
            'options' => array(
                'label' => 'width',
            ),
        ));
        $this->add(array(
            'name' => 'height',
            'type' => 'Number',
            'options' => array(
                'label' => 'height',
            ),
        ));
        $this->add(array(
            'name' => 'submit',
            'type' => 'Submit',
            'attributes' => array(
                'value' => 'Add',
                'id' => 'submitbutton',
            ),
        ));
    }
}
