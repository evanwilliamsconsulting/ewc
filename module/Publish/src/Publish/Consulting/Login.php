<?php

class NHP_Consulting_Login extends Zend_Dojo_Form
{
    public function init()
    {
        $this->setAttribs(array(
                'name' => 'login_form',
	        'action'=>'login/index',
            ));
        
        $this->addElement(
                'TextBox',
                'username',
                array(
                    'label' => 'Username',
                    'trim' => true,
                    'propercase' => true,
                )
        );
        $this->addElement(
        	'PasswordTextBox',
        	'password',
        	array(
            		'label'          => 'Password',
            		'required'       => true,
            		'trim'           => true,
            		'lowercase'      => true,
            		'regExp'         => '^[a-z0-9]{6,}$',
            		'invalidMessage' => 'Invalid password; ' .
                                'must be at least 6 alphanumeric characters',
        	)
    	);
    	$this->addElement(
        	'SubmitButton',
        	'submit',
        	array(
            	'required'   => false,
            	'ignore'     => true,
            	'label'      => 'Login',
        	)
	);
    }
}
