<?php

class NHP_Consulting_Logout extends Zend_Dojo_Form
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
