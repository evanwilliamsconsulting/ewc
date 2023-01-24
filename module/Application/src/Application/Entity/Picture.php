<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

use Zend\InputFilter\Factory as InputFactory;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;
use Zend\Validator\Date;

/**
 * @ORM\Entity
 * @ORM\Table(name="Picture")
 */
class Picture implements InputFilterAwareInterface
{
    private $columnsize;


    protected $inputFilter;

    public function exchangeArray($data)
    {
        $this->id = (isset($data['id'])) ? $data['id'] : null;
        $this->binder_id = (isset($data['binder_id'])) ? $data['binder_id'] : null;
        $this->credit = (isset($data['credit'])) ? $data['credit'] : null;
        $this->subfolder = (isset($data['subfolder'])) ? $data['subfolder'] : null;
        $this->picture = (isset($data['picture'])) ? $data['picture'] : null;
        $this->caption = (isset($data['caption'])) ? $data['caption'] : null;
        $this->width = (isset($data['width'])) ? $data['width'] : null;
        $this->height = (isset($data['height'])) ? $data['height'] : null;
        $this->username = (isset($data['username'])) ? $data['username'] : null;
        $this->original = (isset($data['original'])) ? $data['original'] : null;
        $this->title= (isset($data['title'])) ? $data['title'] : null;
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
                'name' => 'binder_id',
                'required' => false,
            )));

            $inputFilter->add(
            	$factory->createInput(array(
                'name' => 'credit',
                'required' => false,
            )));

            $inputFilter->add(
            	$factory->createInput(array(
                'name' => 'subfolder',
                'required' => false,
            )));

            $inputFilter->add(
            	$factory->createInput(array(
                'name' => 'picture',
                'required' => false,
            )));

            $inputFilter->add(
            	$factory->createInput(array(
                'name' => 'caption',
                'required' => false,
            )));

            $inputFilter->add(
            	$factory->createInput(array(
                'name' => 'width',
                'required' => false,
            )));

            $inputFilter->add(
            	$factory->createInput(array(
                'name' => 'height',
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
     * @ORM\Column(name="binder_id", type="integer", length=255, nullable=false)
     * @var integer
     */
    private $binder_id;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255, nullable=false)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="credit", type="string", length=255, nullable=false)
     */
    private $credit;

    /**
     * @var string
     *
     * @ORM\Column(name="subfolder", type="string", length=255, nullable=false)
     */
    private $subfolder;

    /**
     * @var string
     *
     * @ORM\Column(name="picture", type="string", length=255, nullable=false)
     */
    private $picture;

    /**
     * @var string
     *
     * @ORM\Column(name="caption", type="string", length=255, nullable=true)
     */
    private $caption;

    /**
     * @var integer
     *
     * @ORM\Column(name="width", type="integer", nullable=false)
     */
    private $width;

    /**
     * @var integer
     *
     * @ORM\Column(name="height", type="integer", nullable=false)
     */
    private $height;

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
     * @return Picture 
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
     * @return Picture 
     */
    public function setOriginal($originalDate)
    {
        $this->original = $originalDate;

        return $this;
    }

    /**
     * Get original_date
     *
     * @return DateTime 
     */
    public function getOriginal()
    {
        return $this->original;
    }

    /**
     * Set title 
     *
     * @param string $title
     * @return Picture 
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
     * Set caption 
     *
     * @param string $caption
     * @return Picture 
     */
    public function setCaption($caption)
    {
        $this->caption = $caption;

        return $this;
    }

    /**
     * Get caption 
     *
     * @return string 
     */
    public function getCaption()
    {
        return $this->caption;
    }

    /**
     * Get subfolder
     *
     * @return string
     */
    public function getSubfolder()
    {
        return $this->subfolder;
    }

    /**
     * Set subfolder
     *
     * @param string $subfolder
     * @return Picture
     */
    public function setSubfolder($subfolder)
    {
	$this->subfolder = $subfolder;

	return $this;
    }

    /**
     * Set picture 
     *
     * @param string $picture
     * @return Picture 
     */
    public function setPicture($picture)
    {
        $this->picture = $picture;

        return $this;
    }

    /**
     * Get picture 
     *
     * @return string 
     */
    public function getPicture()
    {
        return $this->picture;
    }

    /**
     * Set credit 
     *
     * @param string $credit
     * @return Picture 
     */
    public function setCredit($credit)
    {
        $this->credit = $credit;

        return $this;
    }

    /**
     * Get credit 
     *
     * @return string 
     */
    public function getCredit()
    {
        return $this->credit;
    }

    /**
     * Set width 
     *
     * @param integer $width
     * @return Picture 
     */
    public function setWidth($width)
    {
        $this->width = $width;

        return $this;
    }

    /**
     * Get width 
     *
     * @return integer 
     */
    public function getWidth()
    {
        return $this->width;
    }
    /**
     * Set height 
     *
     * @param integer $height
     * @return Picture 
     */
    public function setHeight($height)
    {
        $this->height = $height;

        return $this;
    }

    /**
     * Get height 
     *
     * @return integer 
     */
    public function getHeight()
    {
        return $this->height;
    }

    /**
     * Set binder_id 
     *
     * @param integer $binder_id
     * @return Picture 
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
}
