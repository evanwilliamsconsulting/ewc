<?php
namespace Application\View\Helper;
use Zend\View\Helper\AbstractHelper;
use Application\Renderer\ActiveRendererInterface as Renderer;
use Zend\Session\Container;
use Application\Active;
 
class Binder extends AbstractHelper
{
    /*
     * Binder Id
     *
     *
     */
    protected $binderId;
    /*
     * Binder Name
     *
     *
     */
    protected $binderName;
    /**
     */
    protected $active;

    /**
     * The name of the template used to render the calendar.
     *
     * @var null|string
     */
    protected $partial;

    protected $username;

    /**
     * Class to generate HTML version of the calendar.
     *
     * @var Renderer
     */
    protected $renderer;
   
    /*
     *
     *;
    protected $binderCount;


    /**
     *
     */
    public function setBinderId($binderId)
    {
        $this->binderId = $binderId;
    }
    /**
     *
     */
    public function setBinderName($binderName)
    {
        $this->binderName = $binderName;
    }
    /**
     */
    public function setBinderCount($binderCount)
    {
        $this->binderCount = $binderCount;
    }
    /**
     */
    public function getBinderCount()
    {
        return $this->binderCount;
    }
    /*
     *
     */
    public function getActive()
    {
        return $this->active;
    }

    /**
     * Sets the value of partial
     *
     * @param  string $partial
     * @return self
     */
    public function setPartial($partial)
    {
        $this->partial = (string) $partial;
        return $this;
    }

    /**
     * Gets the value of partial
     *
     * @return string
     */
    public function getPartial()
    {
        return $this->partial;
    }
    protected $context;

    public function setUsername($username)
    {
        $this->username = $username;
    }
    public function setContext($context)
    {
	$this->context = $context;
    }

    /**
     * Set the renderer to be used.
     *
     * @param Renderer $renderer
     *
     * @return self
     * @todo Accept closure to generate renderer.
     */
    public function setRenderer(Renderer $renderer)
    {
        $this->renderer = $renderer;
        return $this;
    }

    /**
     * Gets the value of renderer
     *
     * @return Renderer
     */
    public function getRenderer()
    {
        return $this->renderer;
    }

    public function __invoke()
    {
	$openstr = "<div id='binder'>";
	$binderstr = "<span>Binder ";
	$binderstr .= $this->binderId;
	$binderstr .= ": ";
	$binderstr  .= $this->binderName;
   	$binderstr  .= "</span>";
	$totalstr = "<span>";
	$totalstr .= $this->binderId;
	$totalstr .= " of ";
	$totalstr .= $this->binderCount;
	$totalstr .= "</span>";
	$uplink = "<a href='#' onclick='upBinder(";
	$uplink .= $this->binderId;
	$uplink .= ",";
	$uplink .= $this->binderCount;
	$uplink .= ")'>&gt;</a>";
	$downlink = "<a href='#' onclick='downBinder(";
	$downlink .= $this->binderId; 
	$downlink .= ",";
	$downlink .= $this->binderCount;
	$downlink .= ")'>&lt;</a>";
	$addbinder = "<a href='#' onclick='addBinder()'>Add</a>";
	$closestr = "</div>";
        return $openstr . $downlink . $binderstr . $totalstr . $uplink . $addbinder . $closestr;
    }
}
?>
