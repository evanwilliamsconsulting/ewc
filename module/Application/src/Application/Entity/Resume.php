<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

use Zend\InputFilter\Factory as InputFactory;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;
use Zend\Validator\Date;

/**
 *
 * @ORM\Entity
 * @ORM\InheritanceType("SINGLE_TABLE")
 * @ORM\DiscriminatorColumn(name="container_type",type="string")
 * @ORM\DiscriminatorMap({"container" = "Container","schematic" = "Schematic","lesson" = "Lesson","graphic" = "Graphic","resume" = "Resume"})
 * @ORM\Table(name="Container")
 *
 *
 */



class Resume implements InputFilterAwareInterface
{
    private $columnsize;


    protected $inputFilter;
    protected $em;

    public function exchangeArray($data)
    {
        $this->id = (isset($data['id'])) ? $data['id'] : null;
        $this->username = (isset($data['username'])) ? $data['username'] : null;
        $this->original = (isset($data['original'])) ? $data['original'] : null;
        $this->title= (isset($data['title'])) ? $data['title'] : null;
        $this->background= (isset($data['background'])) ? $data['background'] : null;
        $this->frame = (isset($data['frame'])) ? $data['frame'] : null;
        $this->backgroundwidth  = (isset($data['backgroundwidth'])) ? $data['backgroundwidth'] : null;
        $this->backgroundheight = (isset($data['backgroundheight'])) ? $data['backgroundheight'] : null;
	$this->bgColor = (isset($data['bgColor'])) ? $data['bgColor'] : null;
        $this->items = (isset($data['items'])) ? $data['items'] : null;
	$this->container_type = (isset($data['container_type'])) ? $data['container_type'] : null;
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

            $inputFilter->add(
            	$factory->createInput(array(
                'name' => 'title',
                'required' => false,
            )));

            $inputFilter->add(
            	$factory->createInput(array(
                'name' => 'container_type',
                'required' => false,
            )));

            $inputFilter->add(
            	$factory->createInput(array(
                'name' => 'background',
                'required' => false,
            )));

            $inputFilter->add(
            	$factory->createInput(array(
                'name' => 'bgColor',
                'required' => false,
            )));

            $inputFilter->add(
            	$factory->createInput(array(
                'name' => 'frame',
                'required' => false,
            )));

            $inputFilter->add(
            	$factory->createInput(array(
                'name' => 'backgroundheight',
                'required' => false,
            )));

            $inputFilter->add(
            	$factory->createInput(array(
                'name' => 'backgroundwidth',
                'required' => false,
            )));


 
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
     * @var string
     *
     * @ORM\Column(name="wordage", type="string", length=255, nullable=false)
     */
    /**
     * @var string
     */
    private $username;

    /**
     * @var string
     *
     * @ORM\Column(name="original", type="string", length=255, nullable=false)
     */
    private $original;

    /**
     * @var string
     *
     * @ORM\Column(name="bgColor", type="string", length=50, nullable=false)
     */
    private $bgColor;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="text", length=255, nullable=false)
     */
    private $title;

    private $container_type;

    /**
     * @var boolean
     *
     * @ORM\Column(name="background", type="boolean", nullable=false)
     */
    private $background;

    /**
     * @var boolean
     *
     * @ORM\Column(name="frame", type="boolean", nullable=false)
     */
    private $frame;

    /**
     * @var integer
     *
     * @ORM\Column(name="backgroundwidth", type="integer", nullable=false)
     *
     */
    private $backgroundwidth;

    /**
     * @var integer
     *
     * @ORM\Column(name="backgroundheight", type="integer", nullable=false)
     *
     */
    private $backgroundheight;


    private $items;

    public function getItems()
    {
	return $this->items;
    }
    public function setItems($itemsArray)
    {
	$this->items = $itemsArray;
    }
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
     * @return Container
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
     * @param \DateTime $originalDate
     * @return Container
     */
    public function setOriginalDate($originalDate)
    {
        $this->original = $originalDate;

        return $this;
    }

    /**
     * Get original_date
     *
     * @return \DateTime 
     */
    public function getOriginalDate()
    {
        return $this->original;
    }

    /**
     * Set bgColor
     *
     * @param string $bgColor
     * @return Container
     */
    public function setBgColor($bgColor)
    {
	$this->bgColor = $bgColor;
    }
    /**
     * Get bgColor 
     *
     * @return string 
     */
    public function getBgColor()
    {
        return $this->bgColor;
    }

    /**
     * Set title
     *
     * @param string $title
     * @return Container
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
     * Set container_type 
     *
     * @param string $container_type
     * @return Container
     */
    public function setContainerType($container_type)
    {
        $this->container_type = $container_type;

        return $this;
    }

    /**
     * Get container type
     *
     * @return string 
     */
    public function getContainerType()
    {
        return $this->container_type;
    }

    /**
     * Set background
     *
     * @param string $background
     * @return Container
     */
    public function setBackground($background)
    {
        $this->background = $background;

        return $this;
    }

    /**
     * Get background
     *
     * @return string 
     */
    public function getBackground()
    {
        return $this->background;
    }

    /**
     * Set frame
     *
     * @param boolean $frame
     * @return Container
     */
    public function setFrame($frame)
    {
        $this->frame = $frame;

        return $this;
    }

    /**
     * Get frame
     *
     * @return boolean 
     */
    public function getFrame()
    {
        return $this->frame;
    }

    /**
     * Set backgroundwidth
     *
     * @param integer $backgroundwidth
     * @return Container
     */
    public function setBackgroundwidth($backgroundwidth)
    {
        $this->backgroundwidth = $backgroundwidth;

        return $this;
    }

    /**
     * Get backgroundwidth
     *
     * @return integer 
     */
    public function getBackgroundwidth()
    {
        return $this->backgroundwidth;
    }

    /**
     * Set backgroundheight
     *
     * @param integer $backgroundheight
     * @return Container
     */
    public function setBackgroundheight($backgroundheight)
    {
        $this->backgroundheight = $backgroundheight;

        return $this;
    }

    /**
     * Get backgroundheight
     *
     * @return integer 
     */
    public function getBackgroundheight()
    {
        return $this->backgroundheight;
    }
}
