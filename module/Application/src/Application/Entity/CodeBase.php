<?php
/*

+-------------+--------------+------+-----+---------+----------------+
| Field       | Type         | Null | Key | Default | Extra          |
+-------------+--------------+------+-----+---------+----------------+
| id          | int(11)      | NO   | PRI | NULL    | auto_increment |
binder_id
| title       | varchar(255) | YES  |     | NULL    |                |
| fileid      | int(11)      | YES  |     | NULL    |                |
| description | text         | YES  |     | NULL    |                |
| code        | text         | YES  |     | NULL    |                |
| author      | varchar(255) | YES  |     | NULL    |                |
| username    | varchar(255) | YES  |     | NULL    |                |
| original    | datetime     | YES  |     | NULL    |                |
+-------------+--------------+------+-----+---------+----------------+

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
 * @ORM\Table(name="CodeBase")
 */
class CodeBase implements InputFilterAwareInterface
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
        $this->description= (isset($data['description'])) ? $data['description'] : null;
        $this->code= (isset($data['code'])) ? $data['code'] : null;
        $this->author= (isset($data['author'])) ? $data['author'] : null;
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
                'name' => 'description',
                'required' => false,
            )));

            $inputFilter->add(
            	$factory->createInput(array(
                'name' => 'code',
                'required' => false,
            )));

            $inputFilter->add(
            	$factory->createInput(array(
                'name' => 'author',
                'required' => false,
            )));

            $inputFilter->add(
            	$factory->createInput(array(
                'name' => 'fileid',
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
     *
     * @ORM\Column(name="fileid", type="integer", nullable=false)
     * @var integer
     */
    private $fileid;


    /**
     *
     * @ORM\Column(name="code", type="text", nullable=false)
     * @var text 
     */
    private $code;

    /**
     *
     * @ORM\Column(name="author", type="text", nullable=false)
     * @var text 
     */
    private $author;

    /**
     *
     * 
     * @ORM\Column(name="description", type="text", nullable=false)
     * @var text 
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
     * @var string
     *
     * @ORM\Column(name="title", type="text", length=255, nullable=false)
     */
    private $title;

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
    public function getFileid()
    {
        return $this->fileid;
    }

    /**
     * Set fileid
     *
     * @return CodeSample 
     *
     */
    public function setFileid($fileid)
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
     * Get code
     *
     * @return string 
     */
    public function getCode()
    {
        return $this->code;
    }


    /**
     * Set code 
     *
     * @param text $code
     * @return CodeSample 
     */
    public function setCode($code)
    {
        $this->code = $code;

        return $this;
    }

    /**
     * Get description 
     *
     * @return text 
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set description
     *
     * @param text $description
     * @return CodeSample 
     */
    public function setDescription($description)
    {
        $this->code = $description;

        return $this;
    }

    /**
     * Set author 
     *
     * @param string $author
     * @return CodeSample 
     */
    public function setAuthor($auhtor)
    {
        $this->author = $author;

        return $this;
    }

    /**
     * Get author 
     *
     * @return string 
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * Set binder_id 
     *
     * @param integer $binder_id
     * @return CodeBase 
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
