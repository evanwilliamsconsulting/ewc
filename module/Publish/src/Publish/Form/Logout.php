<?php

class Connectalist_Form_Logout extends Zend_Dojo_Form
{
    public function init()
    {
        $this->setAttribs(array(
                'name' => 'logout_form'
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
		
		$this->setAction('/index/index');
		$this->setMethod('post');
    }
}
