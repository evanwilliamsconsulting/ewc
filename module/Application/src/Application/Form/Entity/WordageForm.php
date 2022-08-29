<?php

namespace Application\Form\Entity;

use Zend\Form\Form;

class WordageForm extends Form
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
	    'name'=>'wordage',
            'type' => 'Textarea',
            'options' => array(
                'label' => 'Wordage',
            ),
        ));
        $this->add(array(
            'name' => 'columnSize',
            'type' => 'Number',
            'options' => array(
                'label' => 'columnSize',
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
