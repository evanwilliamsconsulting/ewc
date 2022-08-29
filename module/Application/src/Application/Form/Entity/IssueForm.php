<?php

namespace Application\Form\Entity;

use Zend\Form\Form;

class IssueForm extends Form
{
    public function __construct($name = null)
    {
        parent:: __construct('headline');

        $this->add(array(
            'name' => 'id',
            'type' => 'hidden'
        ));
        $this->add(array(
            'name' => 'dateofpublication',
            'type' => 'Date',
            'options' => array(
                'label' => 'Date of Publication',
            ),
        ));
        $this->add(array(
            'name' => 'toggledivtagson',
            'type' => 'Checkbox',
            'options' => array(
                'label' => 'toggledivtagson',
            ),
        ));
        $this->add(array(
            'name' => 'priceofcopy',
            'type' => 'Number',
            'options' => array(
                'label' => 'priceofcopy',
            ),
        ));
        $this->add(array(
            'name' => 'tagline',
            'type' => 'Text',
            'options' => array(
                'label' => 'tagline',
            ),
        ));
        $this->add(array(
            'name' => 'qrimage',
            'type' => 'File',
            'options' => array(
                'label' => 'qrimage',
            ),
        ));
        $this->add(array(
            'name' => 'headingtheme',
            'type' => 'Text',
            'options' => array(
                'label' => 'Heading Theme',
            ),
        ));
        $this->add(array(
            'name' => 'secondtheme',
            'type' => 'Text',
            'options' => array(
                'label' => 'Second Theme',
            ),
        ));
        $this->add(array(
            'name' => 'brace',
            'type' => 'Text',
            'options' => array(
                'label' => 'brace',
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
