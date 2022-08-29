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
 * @ORM\Table(name="Headline")
 */
class Headline implements InputFilterAwareInterface
{
    private $columnsize;


    protected $inputFilter;
    protected $em;

    public function exchangeArray($data)
    {
        $this->id = (isset($data['id'])) ? $data['id'] : null;
        $this->username = (isset($data['username'])) ? $data['username'] : null;
        $this->original = (isset($data['original'])) ? $data['original'] : null;
        $this->headline= (isset($data['headline'])) ? $data['headline'] : null;
        $this->fontsize = (isset($data['fontsize'])) ? $data['fontsize'] : null;
        $this->fontstyle = (isset($data['fontstyle'])) ? $data['fontstyle'] : null;
        $this->fontfamily  = (isset($data['fontfamily'])) ? $data['fontfamily'] : null;
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
                'name' => 'headline',
                'required' => false,
            )));

            $inputFilter->add(
            	$factory->createInput(array(
                'name' => 'fontsize',
                'required' => false,
            )));

            $inputFilter->add(
            	$factory->createInput(array(
                'name' => 'fontstyle',
                'required' => false,
            )));

            $inputFilter->add(
            	$factory->createInput(array(
                'name' => 'fontfamily',
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
     * @var string
     *
     * @ORM\Column(name="headline", type="text", length=2255, nullable=false)
     */
    private $headline;

    /**
     * @var string
     *
     * @ORM\Column(name="fontsize", type="text", length=2255, nullable=false)
     */
    private $fontsize;

    /**
     * @var string
     *
     * @ORM\Column(name="fontfamily", type="text", length=2255, nullable=false)
     */
    private $fontfamily;

    /**
     * @var string
     *
     * @ORM\Column(name="fontstyle", type="text", length=2255, nullable=false)
     */
    private $fontstyle;




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
     * @return Wordage
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
     * @return Wordage
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
     * Set headline 
     *
     * @param string $headline
     * @return Wordage
     */
    public function setHeadline($headline)
    {
        $this->headline = $headline;

        return $this;
    }

    /**
     * Get headline
     *
     * @return string 
     */
    public function getHeadline()
    {
        return $this->headline;
    }

    /**
     * Set fontsize 
     *
     * @param string $fontsize
     * @return Fontsize
     */
    public function setFontsize($fontsize)
    {
        $this->fontsize = $fontsize;

        return $this;
    }

    /**
     * Get fontsize
     *
     * @return string 
     */
    public function getFontsize()
    {
        return $this->fontsize;
    }

    /**
     * Set fontstyle
     *
     * @param string $fontstyle
     * @return Fontstyle
     */
    public function setFontstyle($fontstyle)
    {
        $this->fontstyle = $fontstyle;

        return $this;
    }

    /**
     * Get fontstyle
     *
     * @return string 
     */
    public function getFontstyle()
    {
        return $this->fontstyle;
    }

    /**
     * Set fontfamily
     *
     * @param string $fontfamily
     * @return Fontfamily
     */
    public function setFontfamily($fontfamily)
    {
        $this->fontfamily = $fontfamily;

        return $this;
    }

    /**
     * Get fontfamily
     *
     * @return string 
     */
    public function getFontfamily()
    {
        return $this->fontfamily;
    }

}
