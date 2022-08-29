<?php



use Doctrine\ORM\Mapping as ORM;

/**
 * Pixlink
 */
class Pixlink
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var integer
     */
    private $width;

    /**
     * @var integer
     */
    private $height;

    /**
     * @var boolean
     */
    private $gluex;

    /**
     * @var boolean
     */
    private $gluey;

    /**
     * @var boolean
     */
    private $prevx;

    /**
     * @var boolean
     */
    private $prevy;

    /**
     * @var boolean
     */
    private $resetx;

    /**
     * @var boolean
     */
    private $resety;

    /**
     * @var boolean
     */
    private $drift;

    /**
     * @var boolean
     */
    private $gravity;

    /**
     * @var integer
     */
    private $offsetx;

    /**
     * @var integer
     */
    private $offsety;

    /**
     * @var string
     */
    private $pixclass;

    /**
     * @var \stdClass
     */
    private $pixreference;


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
     * Set width
     *
     * @param integer $width
     * @return Pixlink
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
     * @return Pixlink
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
     * Set gluex
     *
     * @param boolean $gluex
     * @return Pixlink
     */
    public function setGluex($gluex)
    {
        $this->gluex = $gluex;

        return $this;
    }

    /**
     * Get gluex
     *
     * @return boolean 
     */
    public function getGluex()
    {
        return $this->gluex;
    }

    /**
     * Set gluey
     *
     * @param boolean $gluey
     * @return Pixlink
     */
    public function setGluey($gluey)
    {
        $this->gluey = $gluey;

        return $this;
    }

    /**
     * Get gluey
     *
     * @return boolean 
     */
    public function getGluey()
    {
        return $this->gluey;
    }

    /**
     * Set prevx
     *
     * @param boolean $prevx
     * @return Pixlink
     */
    public function setPrevx($prevx)
    {
        $this->prevx = $prevx;

        return $this;
    }

    /**
     * Get prevx
     *
     * @return boolean 
     */
    public function getPrevx()
    {
        return $this->prevx;
    }

    /**
     * Set prevy
     *
     * @param boolean $prevy
     * @return Pixlink
     */
    public function setPrevy($prevy)
    {
        $this->prevy = $prevy;

        return $this;
    }

    /**
     * Get prevy
     *
     * @return boolean 
     */
    public function getPrevy()
    {
        return $this->prevy;
    }

    /**
     * Set resetx
     *
     * @param boolean $resetx
     * @return Pixlink
     */
    public function setResetx($resetx)
    {
        $this->resetx = $resetx;

        return $this;
    }

    /**
     * Get resetx
     *
     * @return boolean 
     */
    public function getResetx()
    {
        return $this->resetx;
    }

    /**
     * Set resety
     *
     * @param boolean $resety
     * @return Pixlink
     */
    public function setResety($resety)
    {
        $this->resety = $resety;

        return $this;
    }

    /**
     * Get resety
     *
     * @return boolean 
     */
    public function getResety()
    {
        return $this->resety;
    }

    /**
     * Set drift
     *
     * @param boolean $drift
     * @return Pixlink
     */
    public function setDrift($drift)
    {
        $this->drift = $drift;

        return $this;
    }

    /**
     * Get drift
     *
     * @return boolean 
     */
    public function getDrift()
    {
        return $this->drift;
    }

    /**
     * Set gravity
     *
     * @param boolean $gravity
     * @return Pixlink
     */
    public function setGravity($gravity)
    {
        $this->gravity = $gravity;

        return $this;
    }

    /**
     * Get gravity
     *
     * @return boolean 
     */
    public function getGravity()
    {
        return $this->gravity;
    }

    /**
     * Set offsetx
     *
     * @param integer $offsetx
     * @return Pixlink
     */
    public function setOffsetx($offsetx)
    {
        $this->offsetx = $offsetx;

        return $this;
    }

    /**
     * Get offsetx
     *
     * @return integer 
     */
    public function getOffsetx()
    {
        return $this->offsetx;
    }

    /**
     * Set offsety
     *
     * @param integer $offsety
     * @return Pixlink
     */
    public function setOffsety($offsety)
    {
        $this->offsety = $offsety;

        return $this;
    }

    /**
     * Get offsety
     *
     * @return integer 
     */
    public function getOffsety()
    {
        return $this->offsety;
    }

    /**
     * Set pixclass
     *
     * @param string $pixclass
     * @return Pixlink
     */
    public function setPixclass($pixclass)
    {
        $this->pixclass = $pixclass;

        return $this;
    }

    /**
     * Get pixclass
     *
     * @return string 
     */
    public function getPixclass()
    {
        return $this->pixclass;
    }

    /**
     * Set pixreference
     *
     * @param \stdClass $pixreference
     * @return Pixlink
     */
    public function setPixreference($pixreference)
    {
        $this->pixreference = $pixreference;

        return $this;
    }

    /**
     * Get pixreference
     *
     * @return \stdClass 
     */
    public function getPixreference()
    {
        return $this->pixreference;
    }
}
