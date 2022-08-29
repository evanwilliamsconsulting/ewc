<?php



use Doctrine\ORM\Mapping as ORM;

/**
 * Broadsheet
 */
class Broadsheet
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var integer
     */
    private $pageno;

    /**
     * @var integer
     */
    private $pagewidth;

    /**
     * @var integer
     */
    private $pageheight;


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
     * Set pageno
     *
     * @param integer $pageno
     * @return Broadsheet
     */
    public function setPageno($pageno)
    {
        $this->pageno = $pageno;

        return $this;
    }

    /**
     * Get pageno
     *
     * @return integer 
     */
    public function getPageno()
    {
        return $this->pageno;
    }

    /**
     * Set pagewidth
     *
     * @param integer $pagewidth
     * @return Broadsheet
     */
    public function setPagewidth($pagewidth)
    {
        $this->pagewidth = $pagewidth;

        return $this;
    }

    /**
     * Get pagewidth
     *
     * @return integer 
     */
    public function getPagewidth()
    {
        return $this->pagewidth;
    }

    /**
     * Set pageheight
     *
     * @param integer $pageheight
     * @return Broadsheet
     */
    public function setPageheight($pageheight)
    {
        $this->pageheight = $pageheight;

        return $this;
    }

    /**
     * Get pageheight
     *
     * @return integer 
     */
    public function getPageheight()
    {
        return $this->pageheight;
    }
}
