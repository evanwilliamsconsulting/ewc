<?php

namespace Application\Form\Entity;

use Zend\Form\Form;

class ContainerForm extends Form
{
    public function __construct($name = null)
    {
        parent:: __construct('wordage');

        $this->add(array(
            'name' => 'id',
            'type' => 'hidden'
        ));
        $this->add(array(
            'name' => 'username',
            'type' => 'text'
        ));
        $this->add(array(
	    'name'=>'original',
            'type' => 'DateTime',
            'options' => array(
                'label' => 'Original Date',
                'format'=> 'Ymd',
            ),
         ));
        $this->add(array(
	    'name'=>'title',
            'type' => 'Text',
            'options' => array(
                'label' => 'Title',
            ),
        ));
        $this->add(array(
	    'name'=>'background',
            'type' => 'File',
            'options' => array(
                'label' => 'background',
            ),
        ));
        $this->add(array(
            'name' => 'backgroundwidth',
            'type' => 'Number',
            'options' => array(
                'label' => 'background width',
            ),
        ));
        $this->add(array(
            'name' => 'backgroundheight',
            'type' => 'Number',
            'options' => array(
                'label' => 'background height',
            ),
        ));
	    $this->add(array(
            'name' => 'frame',
            'options' => array(
                'label' => 'frame',
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
