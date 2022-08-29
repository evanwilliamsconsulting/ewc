<?php

class NHP_Consulting_Login extends Zend_Dojo_Form
{
    public function init()
    {
        $this->setAttribs(array(
                'name' => 'login_form'
            ));
        
    	$this->addElement(
        	'SubmitButton',
        	'submit',
        	array(
            	'required'   => false,
            	'ignore'     => true,
            	'label'      => 'Log Out!',
        	)
	);
    }
}
