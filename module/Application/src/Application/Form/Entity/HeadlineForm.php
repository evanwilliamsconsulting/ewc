<?php
/*

+------------+--------------+------+-----+---------+----------------+
| Field      | Type         | Null | Key | Default | Extra          |
+------------+--------------+------+-----+---------+----------------+
| id         | int          | NO   | PRI | NULL    | auto_increment |
| headline   | varchar(255) | NO   |     | NULL    |                |
| username   | varchar(255) | YES  |     | NULL    |                |
| original   | datetime     | YES  |     | NULL    |                |
| fontsize   | varchar(255) | YES  |     | NULL    |                |
| fontstyle  | varchar(255) | YES  |     | NULL    |                |
| fontfamily | varchar(255) | YES  |     | NULL    |                |
+------------+--------------+------+-----+---------+----------------+

*/

namespace Application\Form\Entity;

use Zend\Form\Form;

class HeadlineForm extends Form
{
    public function __construct($name = null)
    {
        parent:: __construct('headline');

        $this->add(array(
            'name' => 'id',
            'type' => 'hidden'
        ));
        $this->add(array(
            'name' => 'username',
            'type' => 'text'
        ));
        $this->add(array(
	    'name'=>'original',
            'type' => 'DateTime',
            'options' => array(
                'label' => 'Original Date',
                'format'=> 'Ymd',
            ),
         ));
        $this->add(array(
	    'name'=>'title',
            'type' => 'Text',
            'options' => array(
                'label' => 'Title',
            ),
        ));

        $this->add(array(
	    'name'=>'headline',
            'type' => 'Textarea',
            'options' => array(
                'label' => 'Headline',
            ),
        ));
        $this->add(array(
	    'name'=>'fontsize',
            'type' => 'Text',
            'options' => array(
                'label' => 'Fontsize',
            ),
        ));
        $this->add(array(
	    'name'=>'fontstyle',
            'type' => 'Text',
            'options' => array(
                'label' => 'Fontstyle',
            ),
        ));
        $this->add(array(
	    'name'=>'fontfamily',
            'type' => 'Text',
            'options' => array(
                'label' => 'Fontfamily',
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
