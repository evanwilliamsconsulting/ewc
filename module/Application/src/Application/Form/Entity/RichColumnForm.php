<?php

namespace Application\Form\Entity;

use Zend\Form\Form;

class RichColumnForm extends Form
{
    public function __construct($name = null)
    {
        parent:: __construct('headline');

        $this->add(array(
            'name' => 'id',
            'type' => 'hidden'
        ));
        $this->add(array(
            'name' => 'width',
            'type' => 'Text',
            'options' => array(
                'label' => 'Width',
            ),
        ));
        $this->add(array(
            'name' => 'height',
            'type' => 'Text',
            'options' => array(
                'label' => 'height',
            ),
        ));
        $this->add(array(
            'name' => 'gluex',
            'type' => 'Checkbox',
            'options' => array(
                'label' => 'gluex',
            ),
        ));
        $this->add(array(
            'name' => 'gluey',
            'type' => 'Checkbox',
            'options' => array(
                'label' => 'gluey',
            ),
        ));
        $this->add(array(
            'name' => 'prevx',
            'type' => 'Checkbox',
            'options' => array(
                'label' => 'prevx',
            ),
        ));
        $this->add(array(
            'name' => 'prevy',
            'type' => 'Checkbox',
            'options' => array(
                'label' => 'prevy',
            ),
        ));
        $this->add(array(
            'name' => 'resetx',
            'type' => 'Checkbox',
            'options' => array(
                'label' => 'resetx',
            ),
        ));
        $this->add(array(
            'name' => 'resety',
            'type' => 'Checkbox',
            'options' => array(
                'label' => 'resety',
            ),
        ));
        $this->add(array(
            'name' => 'drift',
            'type' => 'Checkbox',
            'options' => array(
                'label' => 'drift',
            ),
        ));
        $this->add(array(
            'name' => 'gravity',
            'type' => 'Checkbox',
            'options' => array(
                'label' => 'gravity',
            ),
        ));
        $this->add(array(
            'name' => 'offsetx',
            'type' => 'Checkbox',
            'options' => array(
                'label' => 'offsetx',
            ),
        ));
        $this->add(array(
            'name' => 'offsety',
            'type' => 'Text',
            'options' => array(
                'label' => 'offsety',
            ),
        ));
	$this->add(array(
            'name' => 'article',
            'type' => 'Text',
            'options' => array(
                'label' => 'article',
            ),
        ));
	$this->add(array(
            'name' => 'startline',
            'type' => 'Text',
            'options' => array(
                'label' => 'startline',
            ),
        ));
	$this->add(array(
            'name' => 'endline',
            'type' => 'Text',
            'options' => array(
                'label' => 'endline',
            ),
        ));
	$this->add(array(
            'name' => 'useremainder',
            'type' => 'Checkbox',
            'options' => array(
                 'label' => 'Use Remainder',
            ),
        ));
	$this->add(array(
            'name' => 'usecontinuedon',
            'type' => 'Checkbox',
            'options' => array(
                 'label' => 'Use Continued On',
            ),
        ));
        $this->add(array(
            'name' => 'continuedon',
            'type' => 'Text',
            'option' => array(
                 'label' => "Continued On",
             ),
        ));
	$this->add(array(
            'name' => 'usecontinuedfrom',
            'type' => 'Checkbox',
            'options' => array(
                 'label' => 'Use Continued From',
            ),
        ));
        $this->add(array(
            'name' => 'continuedfrom',
            'type' => 'Text',
            'option' => array(
                 'label' => "Continued From",
             ),
        ));
        $this->add(array(
            'name' => 'charsperline',
            'type' => 'Text',
            'option' => array(
                 'label' => "Chars Per Line",
             ),
        ));
        $this->add(array(
            'name' => 'textclass',
            'type' => 'Text',
            'option' => array(
                 'label' => "Text Class",
             ),
        ));
        $this->add(array(
            'name' => 'addlineheight',
            'type' => 'Checkbox',
            'option' => array(
                 'label' => "Add Line Height",
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
