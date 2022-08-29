<?php
namespace Application\Form;

use Zend\Form\Form;
use Zend\InputFilter\InputFilter;

/**
 * This form is used to collect user registration data. 
 */
class RegistrationForm extends Form
{
    /**
     * Constructor.     
     */
    public function __construct()
    {
        // Define form name
        parent::__construct('registration-form');
     
        // Set POST method for this form
        $this->setAttribute('method', 'post');


        // Set Action for this form
	// https://stackoverflow.com/questions/29470342/zend-framework-2-nothing-happens-after-an-interaction-with-the-button-in-the-fro
	$this->setAttribute('action','signup');
                
        $this->addElements();
        $this->addInputFilter(); 
    }
    
    /**
     * This method adds elements to form (input fields and submit button).
     */
    protected function addElements() 
    {
            // Add "username" field
            $this->add([           
                'type'  => 'text',
                'name' => 'username',
                'attributes' => [
                    'id' => 'username'
                ],
                'options' => [
                    'label' => 'User Name',
                ],
            ]);

            // Add "email" field
            $this->add([           
                'type'  => 'text',
                'name' => 'email',
                'attributes' => [
                    'id' => 'email'
                ],
                'options' => [
                    'label' => 'Your E-mail',
                ],
            ]);
            
            // Add "first_name" field
            $this->add([           
                'type'  => 'text',
                'name' => 'first_name',
                'attributes' => [
                    'id' => 'first_name'
                ],
                'options' => [
                    'label' => 'First Name',
                ],
            ]);
            
            // Add "middle_initial" field
            $this->add([           
                'type'  => 'text',
                'name' => 'middle_i',
                'attributes' => [
                    'id' => 'middle_i'
                ],
                'options' => [
                    'label' => 'Middle Initial',
                ],
            ]);
            
            // Add "last_name" field
            $this->add([           
                'type'  => 'text',
                'name' => 'last_name',
                'attributes' => [
                    'id' => 'last_name'
                ],
                'options' => [
                    'label' => 'Last Name',
                ],
            ]);

            // Add "passphrase" field
            $this->add([           
                'type'  => 'text',
                'name' => 'passphrase',
                'attributes' => [
                    'id' => 'passphrase'
                ],
                'options' => [
                    'label' => 'Passphrase',
                ],
            ]);
            
            // Add "password" field
            $this->add([           
                'type'  => 'password',
                'name' => 'password',
                'attributes' => [
                    'id' => 'password'
                ],
                'options' => [
                    'label' => 'Choose Password',
                ],
            ]);
            
            // Add "confirm_password" field
            $this->add([           
                'type'  => 'password',
                'name' => 'confirm_password',
                'attributes' => [
                    'id' => 'confirm_password'
                ],
                'options' => [
                    'label' => 'Type Password Again',
                ],
            ]);           
            
        // Add the submit button
        $this->add([
            'type'  => 'submit',
            'name' => 'submit',
            'attributes' => [                
                'value' => 'Register!',
                'id' => 'submitbutton',
            ],
        ]);        
    }
    
    /**
     * This method creates input filter (used for form filtering/validation).
     */
    private function addInputFilter() 
    {
        $inputFilter = $this->getInputFilter();        
            
            $inputFilter->add([
                'name'     => 'username',
                'required' => true,
                'filters'  => [
                    ['name' => 'StringTrim'],
                    ['name' => 'StripTags'],
                    ['name' => 'StripNewlines'],
                ],                
                'validators' => [
                    [
                        'name'    => 'StringLength',
                        'options' => [
                            'min' => 1,
                            'max' => 48
                        ],
                    ],
                ],
            ]);
        
            $inputFilter->add([
                    'name'     => 'email',
                    'required' => true,
                    'filters'  => [
                        ['name' => 'StringTrim'],                    
                    ],                
                    'validators' => [
                        [
                            'name' => 'EmailAddress',
                            'options' => [
                                'allow' => \Zend\Validator\Hostname::ALLOW_DNS,
                                'useMxCheck'    => false,                            
                            ],
                        ],
                    ],
                ]);
            
            $inputFilter->add([
                'name'     => 'first_name',
                'required' => true,
                'filters'  => [
                    ['name' => 'StringTrim'],
                    ['name' => 'StripTags'],
                    ['name' => 'StripNewlines'],
                ],                
                'validators' => [
                    [
                        'name'    => 'StringLength',
                        'options' => [
                            'min' => 1,
                            'max' => 48
                        ],
                    ],
                ],
            ]);

            $inputFilter->add([
                'name'     => 'middle_i',
                'required' => true,
                'filters'  => [
                    ['name' => 'StringTrim'],
                    ['name' => 'StripTags'],
                    ['name' => 'StripNewlines'],
                ],                
                'validators' => [
                    [
                        'name'    => 'StringLength',
                        'options' => [
                            'min' => 0,
                            'max' => 1 
                        ],
                    ],
                ],
            ]);
 
            $inputFilter->add([
                'name'     => 'last_name',
                'required' => true,
                'filters'  => [
                    ['name' => 'StringTrim'],
                    ['name' => 'StripTags'],
                    ['name' => 'StripNewlines'],
                ],                
                'validators' => [
                    [
                        'name'    => 'StringLength',
                        'options' => [
                            'min' => 1,
                            'max' => 48
                        ],
                    ],
                ],
            ]);
 
            $inputFilter->add([
                'name'     => 'passphrase',
                'required' => true,
                'filters'  => [
                    ['name' => 'StringTrim'],
                    ['name' => 'StripTags'],
                    ['name' => 'StripNewlines'],
                ],                
                'validators' => [
                    [
                        'name'    => 'StringLength',
                        'options' => [
                            'min' => 0,
                            'max' => 48
                        ],
                    ],
                ],
            ]);

            // Add input for "password" field
            $inputFilter->add([
                    'name'     => 'password',
                    'required' => true,
                    'filters'  => [                    
                    ],                
                    'validators' => [
                        [
                            'name'    => 'StringLength',
                            'options' => [
                                'min' => 6,
                                'max' => 64
                            ],
                        ],
                    ],
                ]);  

            // Add input for "confirm_password" field
            $inputFilter->add([
                    'name'     => 'confirm_password',
                    'required' => true,
                    'filters'  => [
                    ],       
                    'validators' => [
                        [
                            'name'    => 'Identical',
                            'options' => [
                                'token' => 'password',                            
                            ],
                        ],
                    ],
                ]);
            
    }
}


