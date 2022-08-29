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
 * @ORM\Table(name="Correspondant")
 */
//class Correspondent implements InputFilterAwareInterface
class Correspondent
{
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
     * @ORM\Column(name="username",type="string",length=48,nullable=false)
     */
    private $username;

    /**
     * @var string
     * @ORM\Column(name="handle",type="string",length=255,nullable=false)
     */
    private $handle;

    /**
     * @var string
     * @ORM\Column(name="wordage",type="string",length=255,nullable=false)
     */
    private $wordage;

    /**
     * @var string
     * @ORM\Column(name="picture",type="string",length=255,nullable=false)
     */
    private $picture;

    /**
     * @var integer
     * @ORM\Column(name="width",type="integer",nullable=false)
     */
    private $width;

    /**
     * @var integer
     * @ORM\Column(name="height",type="integer",nullable=false)
     */
    private $height;

    /**
     * @var string
     * @ORM\Column(name="password",type="string",length=255,nullable=false)
     */
    private $password;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set username
     *
     * @param string $username
     *
     * @return Correspondent
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
     * Set handle
     *
     * @param string $handle
     *
     * @return Correspondent
     */
    public function setHandle($handle)
    {
        $this->handle = $handle;

        return $this;
    }

    /**
     * Get handle
     *
     * @return string
     */
    public function getHandle()
    {
        return $this->handle;
    }

    /**
     * Set wordage
     *
     * @param string $wordage
     *
     * @return Correspondent
     */
    public function setWordage($wordage)
    {
        $this->wordage = $wordage;

        return $this;
    }

    /**
     * Get wordage
     *
     * @return string
     */
    public function getWordage()
    {
        return $this->wordage;
    }

    /**
     * Set picture
     *
     * @param string $picture
     *
     * @return Correspondent
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
     * Set width
     *
     * @param int $width
     *
     * @return Correspondent
     */
    public function setWidth($width)
    {
        $this->width = $width;

        return $this;
    }

    /**
     * Get width
     *
     * @return int
     */
    public function getWidth()
    {
        return $this->width;
    }

    /**
     * Set height
     *
     * @param int $height
     *
     * @return Correspondent
     */
    public function setHeight($height)
    {
        $this->height = $height;

        return $this;
    }

    /**
     * Get height
     *
     * @return int
     */
    public function getHeight()
    {
        return $this->height;
    }

    /**
     * Set password
     *
     * @param string $password
     *
     * @return Correspondent
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get password
     *
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }
}

