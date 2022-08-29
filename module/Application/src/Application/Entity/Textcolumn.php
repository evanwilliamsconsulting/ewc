<?php



use Doctrine\ORM\Mapping as ORM;

/**
 * Textcolumn
 */
class Textcolumn
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
     * @var integer
     */
    private $startline;

    /**
     * @var integer
     */
    private $endline;

    /**
     * @var integer
     */
    private $fontsize;

    /**
     * @var boolean
     */
    private $useremainder;

    /**
     * @var boolean
     */
    private $usecontinuedon;

    /**
     * @var boolean
     */
    private $usecontinuedfrom;

    /**
     * @var string
     */
    private $continuedon;

    /**
     * @var string
     */
    private $continuedfrom;

    /**
     * @var integer
     */
    private $charsperline;

    /**
     * @var string
     */
    private $textclass;

    /**
     * @var \stdClass
     */
    private $wordage;


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
     * @return Textcolumn
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
     * @return Textcolumn
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
     * @return Textcolumn
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
     * @return Textcolumn
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
     * @return Textcolumn
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
     * @return Textcolumn
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
     * @return Textcolumn
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
     * @return Textcolumn
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
     * @return Textcolumn
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
     * @return Textcolumn
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
     * @return Textcolumn
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
     * @return Textcolumn
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
     * Set startline
     *
     * @param integer $startline
     * @return Textcolumn
     */
    public function setStartline($startline)
    {
        $this->startline = $startline;

        return $this;
    }

    /**
     * Get startline
     *
     * @return integer 
     */
    public function getStartline()
    {
        return $this->startline;
    }

    /**
     * Set endline
     *
     * @param integer $endline
     * @return Textcolumn
     */
    public function setEndline($endline)
    {
        $this->endline = $endline;

        return $this;
    }

    /**
     * Get endline
     *
     * @return integer 
     */
    public function getEndline()
    {
        return $this->endline;
    }

    /**
     * Set fontsize
     *
     * @param integer $fontsize
     * @return Textcolumn
     */
    public function setFontsize($fontsize)
    {
        $this->fontsize = $fontsize;

        return $this;
    }

    /**
     * Get fontsize
     *
     * @return integer 
     */
    public function getFontsize()
    {
        return $this->fontsize;
    }

    /**
     * Set useremainder
     *
     * @param boolean $useremainder
     * @return Textcolumn
     */
    public function setUseremainder($useremainder)
    {
        $this->useremainder = $useremainder;

        return $this;
    }

    /**
     * Get useremainder
     *
     * @return boolean 
     */
    public function getUseremainder()
    {
        return $this->useremainder;
    }

    /**
     * Set usecontinuedon
     *
     * @param boolean $usecontinuedon
     * @return Textcolumn
     */
    public function setUsecontinuedon($usecontinuedon)
    {
        $this->usecontinuedon = $usecontinuedon;

        return $this;
    }

    /**
     * Get usecontinuedon
     *
     * @return boolean 
     */
    public function getUsecontinuedon()
    {
        return $this->usecontinuedon;
    }

    /**
     * Set usecontinuedfrom
     *
     * @param boolean $usecontinuedfrom
     * @return Textcolumn
     */
    public function setUsecontinuedfrom($usecontinuedfrom)
    {
        $this->usecontinuedfrom = $usecontinuedfrom;

        return $this;
    }

    /**
     * Get usecontinuedfrom
     *
     * @return boolean 
     */
    public function getUsecontinuedfrom()
    {
        return $this->usecontinuedfrom;
    }

    /**
     * Set continuedon
     *
     * @param string $continuedon
     * @return Textcolumn
     */
    public function setContinuedon($continuedon)
    {
        $this->continuedon = $continuedon;

        return $this;
    }

    /**
     * Get continuedon
     *
     * @return string 
     */
    public function getContinuedon()
    {
        return $this->continuedon;
    }

    /**
     * Set continuedfrom
     *
     * @param string $continuedfrom
     * @return Textcolumn
     */
    public function setContinuedfrom($continuedfrom)
    {
        $this->continuedfrom = $continuedfrom;

        return $this;
    }

    /**
     * Get continuedfrom
     *
     * @return string 
     */
    public function getContinuedfrom()
    {
        return $this->continuedfrom;
    }

    /**
     * Set charsperline
     *
     * @param integer $charsperline
     * @return Textcolumn
     */
    public function setCharsperline($charsperline)
    {
        $this->charsperline = $charsperline;

        return $this;
    }

    /**
     * Get charsperline
     *
     * @return integer 
     */
    public function getCharsperline()
    {
        return $this->charsperline;
    }

    /**
     * Set textclass
     *
     * @param string $textclass
     * @return Textcolumn
     */
    public function setTextclass($textclass)
    {
        $this->textclass = $textclass;

        return $this;
    }

    /**
     * Get textclass
     *
     * @return string 
     */
    public function getTextclass()
    {
        return $this->textclass;
    }

    /**
     * Set wordage
     *
     * @param \stdClass $wordage
     * @return Textcolumn
     */
    public function setWordage($wordage)
    {
        $this->wordage = $wordage;

        return $this;
    }

    /**
     * Get wordage
     *
     * @return \stdClass 
     */
    public function getWordage()
    {
        return $this->wordage;
    }
}
