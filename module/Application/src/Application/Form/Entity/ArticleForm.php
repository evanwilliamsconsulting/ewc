<?php

namespace Application\Form\Entity;

use Zend\Form\Form;

class ArticleForm extends Form
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
	    'type'=>'hidden'
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
            'name' => 'title',
            'type' => 'Text',
            'options' => array(
                'label' => 'title',
            ),
        ));
        $this->add(array(
            'name' => 'verbage',
            'type' => 'Text',
            'options' => array(
                'label' => 'verbage',
            ),
        ));
        $this->add(array(
            'name' => 'columnSize',
            'type' => 'Text',
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
