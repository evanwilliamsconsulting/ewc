<?php
namespace Application\View\Helper;
use Zend\View\Helper\AbstractHelper;
use Application\Renderer\ActiveRendererInterface as Renderer;
use Zend\Session\Container;
use Application\Active;
 
class Toolbar extends AbstractHelper
{
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

    /**
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
      if ($this->context=="objects")
      {
    	$retval = "<div id='toolbar'>";
	$retval .= "<ul class='toolbar-list'>";
	$retval .= "<li class='toolbar-tab'><a href='/correspondant/index?new=wordage'>Wordage</a></li>";
	$retval .= "<li class='toolbar-tab'><a href='/correspondant/index?new=picture'>Pix</a></li>";
	$retval .= "<li class='toolbar-tab'><a href='/correspondant/index?new=file'>File</a></li>";
	$retval .= "<li class='toolbar-tab'><a href='/correspondant/index?new=code'>Code Sample</a></li>";
	$retval .= "<li class='toolbar-tab'><a href='/correspondant/index?new=experience'>Experience</a></li>";
	$retval .= "</ul>";
	$retval .= "</div>";
      }
      else
      {
    	$retval = "<div id='toolbar'>";
	$retval .= "<ul class='toolbar_list'>";
	$retval .= "<li class='toolbar_tab'><a href='/correspondant/container?new=container'>Container</a></li>";
	$retval .= "<li class='toolbar_tab'><a href='/correspondant/container?new=schematic'>Schematic</a></li>";
	$retval .= "<li class='toolbar_tab'><a href='/correspondant/container?new=lesson'>Lesson</a></li>";
	$retval .= "<li class='toolbar_tab'><a href='/correspondant/container?new=graphic'>Graphic</a></li>";
	$retval .= "</ul>";
	$retval .= "</div>";
      }
        return $retval;
    }
}
?>
