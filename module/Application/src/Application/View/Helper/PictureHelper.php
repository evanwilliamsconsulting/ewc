<?php
namespace Application\View\Helper;

use Zend\View\Helper\AbstractHelper;
use Zend\Session\Container;
use Zend\ServiceManager\ServiceLocatorAwareInterface;  
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\View\Renderer\PhpRenderer;
use Zend\View\Model\ViewModel;
use Application\Service\PictureService as PictureService;  
use Zend\View\Resolver as Resolver;

/*

https://docs.zendframework.com/zend-view/php-renderer

*/
 
class PictureHelper extends AbstractHelper implements ServiceLocatorAwareInterface
{
    protected static $state;
    protected $pictureObject;
    protected $picture;
    protected $username;
    protected $itemId;
    protected $viewmodel;
    protected $renderer;
    protected $width;
    protected $height;
    protected $caption;

    /** 
     * Set the service locator. 
     * 
     * @ param ServiceLocatorInterface $serviceLocator 
     * @ return CustomHelper 
     */ 
    public function __construct()
    {
    }
    public function setServiceLocator(ServiceLocatorInterface $serviceLocator)  
    {  
        $this->serviceLocator = $serviceLocator;  
        return $this;  
    } 
    /** 
     * Get the service locator. 
     * 
     * @ return \Zend\ServiceManager\ServiceLocatorInterface 
     */  
    public function getServiceLocator()  
    {  
        return $this->serviceLocator;  
    }  

	public function setLoggedIn($loggedIn)
	{
		$this->loggedIn = $loggedIn;
	}
	public function setLog($log)
	{
		$this->log = $log;
	}
	public function getLog()
	{
		return $this->log;
	}
    public function setEntityManager($em)
    {
    	$this->em = $em;
    }
    public function getEntityManager()
    {
    	return $this->em;
    }
    public function setViewModel(ViewModel $viewmodel)
    {
        $this->viewmodel = $viewmodel;
    }
    public function getViewModel()
    {
        return $this->viewmodel;
    }
    public function setObject($pictureObject)
    {
        $this->pictureObject = $pictureObject;
        $picture = $pictureObject->getPicture();
	$caption = $pictureObject->getCaption();
	$this->caption = $caption;
	$subfolder = $pictureObject->getSubfolder();
        $this->picture =  "/images/" . $subfolder . "/" .  $picture;
	$this->width = $pictureObject->getWidth();
	$this->height = $pictureObject->getHeight();
    }
    public function setUsername($username)
    {
        $this->username = $username;
    }
    public function getUsername()
    {
        return $this->username;
    }
    public function setItemId($itemId)
    {
        $this->itemId = $itemId;
    }
    public function setRenderer($renderer)
    {
        $this->renderer = $renderer;
    }
    public function getRenderer()
    {
        return $this->renderer;
    }
    public function __invoke()
    {
	return $this->render();
    }
    public function render()
    {
	$picture = $this->picture;
	$caption = $this->caption;

	$img = "<img src='";
	$img .= $picture;
	$img .= "' width='";
	$img .= $this->width;
	$img .= "px' height='";
	$img .= $this->height;
	$img .= "px'>";

	$caption_div = "<div width='";
	$caption_div .= $this->width;
	$caption_div .= "px'>";
	$caption_div .= $caption;
	$caption_div .= "</div>";
	

	$html = "";
	$html .= "<div>";
	$html .= $img;
	$html .= $caption_div;
	$html .= "</div>";
	
	return $html;
    }
}
