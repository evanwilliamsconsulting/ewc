<?php
/*

+------------+--------------+------+-----+---------+----------------+
| Field      | Type         | Null | Key | Default | Extra          |
+------------+--------------+------+-----+---------+----------------+
| id         | int(11)      | NO   | PRI | NULL    | auto_increment |
binder_id
| fileid     | int(11)      | YES  |     | NULL    |                |
| title      | varchar(255) | YES  |     | NULL    |                |
| language   | varchar(255) | YES  |     | NULL    |                |
| code       | text         | YES  |     | NULL    |                |
| first_line | int(11)      | YES  |     | NULL    |                |
| last_line  | int(11)      | YES  |     | NULL    |                |
| username   | varchar(255) | YES  |     | NULL    |                |
| original   | datetime     | YES  |     | NULL    |                |
+------------+--------------+------+-----+---------+----------------+


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
 * @ORM\Table(name="CodeSample")
 */
class CodeSample implements InputFilterAwareInterface
{
    private $columnsize;


    protected $inputFilter;
    protected $em;

    public function exchangeArray($data)
    {
        $this->id = (isset($data['id'])) ? $data['id'] : null;
        $this->binder_id = (isset($data['binder_id'])) ? $data['binder_id'] : null;
        $this->fileid = (isset($data['fileid'])) ? $data['fileid'] : null;
        $this->title= (isset($data['title'])) ? $data['title'] : null;
        $this->language= (isset($data['language'])) ? $data['language'] : null;
        $this->code= (isset($data['code'])) ? $data['code'] : null;
        $this->firstline = (isset($data['first_line'])) ? $data['first_line'] : null;
        $this->lastline = (isset($data['last_line'])) ? $data['last_line'] : null;
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
                'name' => 'binder_id',
                'required' => false,
            )));

            $inputFilter->add(
            	$factory->createInput(array(
                'name' => 'fileid',
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
                'name' => 'language',
                'required' => false,
            )));

            $inputFilter->add(
            	$factory->createInput(array(
                'name' => 'code',
                'required' => false,
            )));

            $inputFilter->add(
            	$factory->createInput(array(
                'name' => 'first_line',
                'required' => false,
            )));

            $inputFilter->add(
            	$factory->createInput(array(
                'name' => 'last_line',
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
     * @var integer
     *
     * @ORM\Column(name="fileid", type="integer", nullable=false)
     */
    private $fileid;


    /**
     * @var string
     *
     * @ORM\Column(name="code", type="string", length=255, nullable=false)
     */
    private $code;

    /**
     *
     * 
     * @ORM\Column(name="first_line", type="integer", length=255, nullable=false)
     * @var integer
     */
    private $firstline;

    /**
     *
     * 
     * @ORM\Column(name="last_line", type="integer", length=255, nullable=false)
     * @var integer
     */
    private $lastline;
	
	
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
     * @ORM\Column(name="title", type="text", length=255, nullable=false)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="language", type="text", length=255, nullable=false)
     */
    private $language;


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
     * Set id
     *
     * @return CodeSample 
     *
     */
    public function setId($id)
    {
       $this->id = $id;

       return $this;
    }

    /**
     * Get fileid
     *
     * @return integer 
     */
    public function getFileId()
    {
        return $this->fileid;
    }

    /**
     * Set fileid
     *
     * @return CodeSample 
     *
     */
    public function setFileId($fileid)
    {
       $this->fileid = $fileid;

       return $this;
    }

    /**
     * Set username
     *
     * @param string $username
     * @return CodeSample 
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
     * @return CodeSample 
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
     * @return CodeSample 
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
     * Set code 
     *
     * @param string $code
     * @return CodeSample 
     */
    public function setCode($code)
    {
        $this->code = $code;

        return $this;
    }

    /**
     * Get code
     *
     * @return string 
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * Set language 
     *
     * @param string $language
     * @return CodeSample 
     */
    public function setLanguage($language)
    {
        $this->language = $language;

        return $this;
    }

    /**
     * Get language 
     *
     * @return string 
     */
    public function getLanguage()
    {
        return $this->language;
    }

    /**

    /**
     * Set firstline 
     *
     * @param integer $firstline
     * @return CodeSample 
     */
    public function setFirstLine($firstline)
    {
        $this->firstline = $firstline;

        return $this;
    }

    /**
     * Get firstline 
     *
     * @return integer 
     */
    public function getFirstLine()
    {
        return $this->firstline;
    }
    /**
     * Set lastline 
     *
     * @param integer $lastline
     * @return CodeSample 
     */
    public function setLastLine($lastline)
    {
        $this->lastline = $lastline;

        return $this;
    }

    /**
     * Get lastline 
     *
     * @return integer 
     */
    public function getLastLine()
    {
        return $this->lastline;
    }

    /**
     * Set binder_id 
     *
     * @param integer $binder_id
     * @return CodeSample
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
