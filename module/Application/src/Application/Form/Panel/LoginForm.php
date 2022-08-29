<?php

namespace Application\Form\Panel;

use Zend\Form\Form;

class LoginForm extends Form
{
    public function __construct($name = null)
    {
        parent:: __construct('login');

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
            'name'=>'rememberme',
            'type' => 'Checkbox',
            'option' => array(
                'label' => 'Remember Me!',
            ),
        ));
        $this->add(array(
            'name' => 'submit',
            'type' => 'Submit',
            'attributes' => array(
                'value' => 'Login!',
                'id' => 'submitbutton',
            ),
        ));
    }
}
