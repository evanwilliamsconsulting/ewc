<?php

class Connectalist_Form_Login extends Zend_Form
{
    public function init()
    {
        $this->setAttribs(array(
            'name' => 'login_form',
	        'action'=>'index/index',
        ));
        
        $username = new Zend_Form_Element_Text('username');
		$username->setLabel('Username:')
		->setRequired(true);
	
		$password = new Zend_Form_Element_Password('password');
		$password->setLabel('Password:')
		->setRequired(true);
	
		$submit = new Zend_Form_Element_Submit('login');
		$submit->setLabel('Login');

			
		$this->setAction('/index/index/')
		->setMethod('post')
		->addElement($username)
		->addElement($password)
		->addElement($submit);
	}
}
