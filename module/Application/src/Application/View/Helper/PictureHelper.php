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
    protected $width;
    protected $height;
    protected $caption;

	protected $original;
	protected $viewmodel;
	protected $title;
	protected $id;
	protected $renderer;
	protected $log;
	// Array of Containers that this Wordage participates in.
	protected $containerItems;
	protected $em;
	protected $loggedIn = false;

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
	$id = $pictureObject->getId();
        $picture = $pictureObject->getPicture();
	$caption = $pictureObject->getCaption();
	$this->caption = $caption;
	$subfolder = $pictureObject->getSubfolder();
	$this->id = $id;
        $this->picture =  "/images/" . $subfolder . "/" .  $picture;
	$this->width = $pictureObject->getWidth();
	$this->height = $pictureObject->getHeight();
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
	public function setContainerItems($containerItems)
	{
		$this->containerItems = $containerItems;
	}
	public function getContainerItems()
	{
		return $this->containerItems;
	}
	public function setUsername($username)
	{
		$this->username = $username;
	}
    public function __invoke()
    {
        $viewRender = $this->getServiceLocator()->get('ViewRenderer');
    	//$sm = $this->getServiceLocator()->getServiceLocator();  
        //$config = $sm->get('application')->getConfig(); 
 
        //$retval = "<div>";
	//	$retval .= $this->wordageObject->getWordage();
	//	$retval .= "</div>";
    	
    	$view = $this->getViewModel();

    	$containerItems = $this->getContainerItems();

	if ($this->loggedIn == false)
	{
		$view->loggedIn = false;
	}
	else
	{
		$view->loggedIn = true;
	}

    	$view->containerItems = $containerItems;
	
		$view->picture = $this->picture;

		$view->title = $this->title;

		$view->original = $this->original;

		$view->id =  $this->id;

		$view->username = $this->username;

		$view->editOn = false;
		
		$view->setTemplate('items/picture.phtml');
		
		return $viewRender->render($view);
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
	$html .= "<div class='picture-output'>";
	$html .= $img;
	$html .= $caption_div;
	$html .= "</div>";
	
	return $html;
    }
}
