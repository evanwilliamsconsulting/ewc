<?php

class NHP_Form_Blurb extends Zend_Form
{
    public function init()
    {

        $this->setAttribs(array(
            'name' => 'register_form',
	        'action'=>'/login/join',
        ));

		$firstName = new Zend_Form_Element_Text('firstname');
		$firstName->setLabel('First Name');
		
		$middleName = new Zend_Form_Element_Text('middlename');
		$middleName->setLabel('Middle Name');
		
		$lastName = new Zend_Form_Element_Text('lastname');
		$lastName->setLabel('Last Name');
		
		$email = new Zend_Form_Element_Text('email');
		$email->setLabel('Email');
        
        $username = new Zend_Form_Element_Text('username',array('validators' => array(
			'NotEmpty',array('StringLength', false, array(6)))));
		$username->setLabel('Preferred Username:')
		->addValidator(new My_Valid_Username())
		->setRequired(true);
			
		$passwordConfirmation = new My_Valid_PasswordConfirmation();
		
		$password = new Zend_Form_Element_Password('password');
		$password->setLabel('Password:')
		->addValidator($passwordConfirmation)
		->setRequired(true);
		
		$confirmPassword = new Zend_Form_Element_Password('password_confirm');
		$confirmPassword->setLabel('Confirm Password:')
		->addValidator($passwordConfirmation)
		->setRequired(true);
	
		$submit = new Zend_Form_Element_Submit('login');
		$submit->setLabel('Login');

			
		$this->setAction('/login/join/')
		->setMethod('post')
		->addElement('formRTE',
			     'message',
			     array( 'label' => 'formRTE label:',
			            'required' => true,
				    'value' => 'Pax',
				    'attribs' => array('myattribute')
				 )
	        )
		->addElement($submit);
	}
}
