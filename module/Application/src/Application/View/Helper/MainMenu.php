<?php
namespace Application\View\Helper;

use Zend\View\Helper\AbstractHelper;
use Application\Renderer\ActiveRendererInterface as Renderer;
use Zend\Session\Container;
use Application\Active;
 
class MainMenu extends AbstractHelper
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
     * Class Name
     *
     * @var name
     */
    protected $name;

    /**
     * Source Controller
     *
     * @var source
     *
     */

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
    public function setUsername($username)
    {
        $this->username = $username;
    }
    public function setName($name)
    {
	$this->name = $name;
    }
    public function getName()
    {
	return $this->name;
    }
    public function setSource($source)
    {
	$this->source = $source;
    }
    public function getSource()
    {
        return $this->source;
    }
    public function showOutput($attempt)
    {
	$name = $this->getName();
        $renderer = $this->getRenderer();

        $retval = "<ul id='menubar'>";
	$retval .= "<li><span class='home_link'><a class='toplink' href='http;//dev.newhollandpress.com/index/index'>Home!</a></span></li>";
	$retval .= "<li>&nbsp;&nbsp;</li>";
	$retval .= "<li><span class='advertise_link'><a class='toplink' href='http;//dev.newhollandpress.com/advertise/index'>Advertise!</a></span></li>";
	$retval .= "<li>&nbsp;&nbsp;</li>";
	$retval .= "<li><span class='subscribe_link'><a class='toplink' href='http;//dev.newhollandpress.com/subscribe/index'>Subscribe!</a></span></li>";
        $retval .= "<li>&nbsp;&nbsp;</li>";
	$retval .= "<li><span class='contact_link'><a class='toplink' href='http;//dev.newhollandpress.com/contact/index'>Contact!</a></span></li>";
        $retval .= "</ul>";

        return $retval;
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
}
?>
