<?php

class Connectalist_Form_Welcome extends Zend_Form
{
    public function init()
    {
        $this->setAttribs(array(
            'name' => 'welcome_form',
        ));
        
        $username = new Zend_Form_Element_Text('username');
		$username->setLabel('Username:')
		->setRequired(true);
		
		$prefix = new Zend_Form_Element_Text('prefix');
		$prefix->setLabel('Mr. Mrs. Ms.:')
		->setRequired(true);	
		
		$first = new Zend_Form_Element_Text('first');
		$first->setLabel('First:')
		->setRequired(true);
	
		$middle = new Zend_Form_Element_Text('middle');
		$middle->setLabel('Middle:')
		->setRequired(false);
	
		$last = new Zend_Form_Element_Text('last');
		$last->setLabel('Last:')
		->setRequired(true);
		
		$suffix = new Zend_Form_Element_Text('suffix');
		$suffix->setLabel('Jr., Sr.:')
		->setRequired(true);
			
		$email = new Zend_Form_Element_Text('email');
		$email->setLabel('Email:')
		->setRequired(true);		

		$submit = new Zend_Form_Element_Submit('welcome');
		$submit->setLabel('Welcome');

			
		$this->setAction('/login/welcoming/')
		->setMethod('post')
		->addElement($username)
		->addElement($prefix)
		->addElement($first)
		->addElement($middle)
		->addElement($last)
		->addElement($suffix)
		->addElement($email)
		->addElement($submit);
	}
}
