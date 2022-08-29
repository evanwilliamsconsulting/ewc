<?php
/*



mysql> show columns from OutlineEntry;
+-------------+--------------+------+-----+---------+----------------+
| Field       | Type         | Null | Key | Default | Extra          |
+-------------+--------------+------+-----+---------+----------------+
| id          | int(11)      | NO   | PRI | NULL    | auto_increment |
| outline_id  | int(11)      | YES  |     | NULL    |                |
| binder_id   | int(11)      | YES  |     | NULL    |                |
| order_no    | int(11)      | YES  |     | NULL    |                |
| label       | varchar(10)  | YES  |     | NULL    |                |
| title       | varchar(255) | YES  |     | NULL    |                |
| description | varchar(255) | YES  |     | NULL    |                |
| username    | varchar(255) | YES  |     | NULL    |                |
| original    | datetime     | YES  |     | NULL    |                |
+-------------+--------------+------+-----+---------+----------------+
9 rows in set (0.00 sec)



*/

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

use Zend\InputFilter\Factory as InputFactory;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;
use Zend\Validator\Date;

/**
 * @ORM\Entity
 * @ORM\Table(name="OutlineEntry")
 */
class OutlineEntry implements InputFilterAwareInterface
{
    private $columnsize;


    protected $inputFilter;
    protected $em;

    public function exchangeArray($data)
    {
        $this->id = (isset($data['id'])) ? $data['id'] : null;
        $this->outline_id = (isset($data['outline_id'])) ? $data['outline_id'] : null;
        $this->binder_id = (isset($data['binder_id'])) ? $data['binder_id'] : null;
        $this->order_no = (isset($data['order_no'])) ? $data['order_no'] : null;
        $this->label= (isset($data['label'])) ? $data['label'] : null;
        $this->title= (isset($data['title'])) ? $data['title'] : null;
        $this->description = (isset($data['description'])) ? $data['description'] : null;
        $this->username = (isset($data['username'])) ? $data['username'] : null;
        $this->original = (isset($data['original'])) ? $data['original'] : null;
    }
    public function setEntityManager($em)
    {
	$this->em = $em;
    }
    public function getInputFilter()
    {
        if (!$this->inputFilter) {
            $inputFilter = new InputFilter();
			$factory = new InputFactory();

            $inputFilter->add(
            	$factory->createInput(array(
                'name' => 'id',
                'required' => false,
            )));

            $inputFilter->add(
            	$factory->createInput(array(
                'name' => 'outline_id',
                'required' => false,
            )));

            $inputFilter->add(
            	$factory->createInput(array(
                'name' => 'binder_id',
                'required' => false,
            )));

            $inputFilter->add(
            	$factory->createInput(array(
                'name' => 'order_no',
                'required' => false,
            )));

            $inputFilter->add(
            	$factory->createInput(array(
                'name' => 'label',
                'required' => false,
            )));

            $inputFilter->add(
            	$factory->createInput(array(
                'name' => 'title',
                'required' => false,
            )));

            $inputFilter->add(
            	$factory->createInput(array(
                'name' => 'description',
                'required' => false,
            )));
			
			
            $inputFilter->add(
            	$factory->createInput(array(
                'name' => 'username',
                'required' => false,
            )));
			

            $inputFilter->add(
            	$factory->createInput(array(
                'name' => 'original',
                'required' => false,
                'options' => array(
                	'format' => 'Ymd'
				)
            ))
			);

            $this->inputFilter = $inputFilter;
        }
        return $this->inputFilter;
    }
    public function setInputFilter(InputFilterInterface $inputFilter)
    {
        throw new \Exception("Not Used");
    }
    public function getArrayCopy()
    {
        return get_object_vars($this);
    }
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     *
     * 
     * @ORM\Column(name="outline_id", type="integer", nullable=false)
     * @var integer
     */
    private $outline_id;

    /**
     *
     * 
     * @ORM\Column(name="binder_id", type="integer", nullable=false)
     * @var integer
     */
    private $binder_id;


    /**
     *
     * 
     * @ORM\Column(name="order_no", type="integer", nullable=false)
     * @var order_no 
     */
    private $order_no;


    /**
     * @var string
     *
     * @ORM\Column(name="label", type="string", length=10, nullable=false)
     */
    private $label;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255, nullable=false)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", nullable=false)
     */
    private $description;

    /**
     * @var string
	 * 
	 * @ORM\Column(name="username", type="string", length=255, nullable=false)
     *
	 **/
    private $username;

    /**
     * @var string
     *
     * @ORM\Column(name="original", type="string", length=255, nullable=false)
     */
    private $original;

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set username
     *
     * @param string $username
     * @return OutlineEntry
     */
    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }

    /**
     * Get username
     *
     * @return string 
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Set original_date
     *
     * @param \DateTime $original
     * @return OutlineEntry
     */
    public function setOriginal($originalDate)
    {
        $this->original = $originalDate;

        return $this;
    }

    /**
     * Get original_date
     *
     * @return \DateTime 
     */
    public function getOriginal()
    {
        return $this->original;
    }

    /**
     * Set title
     *
     * @param string $title
     * @return OutlineEntry
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string 
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set label
     *
     * @param string $label
     * @return OutlineEntry
     */
    public function setLabel($label)
    {
        $this->label = $label;

        return $this;
    }

    /**
     * Get label
     *
     * @return string 
     */
    public function getLabel()
    {
        return $this->label;
    }

    /**
     * Set Description 
     *
     * @param string $description
     * @return OutlineEntry 
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description 
     *
     * @return string 
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set order_no 
     *
     * @param integer $order_no
     * @return OutlineEntry
     */
    public function setOrderNo($order_no)
    {
        $this->order_no = $order_no;

        return $this;
    }

    /**
     * Get order_no
     *
     * @return integer 
     */
    public function getOrderNo()
    {
        return $this->order_no;
    }

    /**
     * Set binder_id 
     *
     * @param integer $binder_id
     * @return Wordage
     */
    public function setBinderId($binder_id)
    {
        $this->binder_id = $binder_id;

        return $this;
    }

    /**
     * Get binder_id
     *
     * @return integer 
     */
    public function getBinderId()
    {
        return $this->binder_id;
    }

    /**
     * Set outline_id 
     *
     * @param integer $outline_id
     * @return Wordage
     */
    public function setOutlineId($outline_id)
    {
        $this->outline_id = $outline_id;

        return $this;
    }

    /**
     * Get outline_id 
     *
     * @return integer 
     */
    public function getOutlineId()
    {
        return $this->outline_id;
    }
}
