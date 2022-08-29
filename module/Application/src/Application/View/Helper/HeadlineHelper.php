<?php
namespace Application\View\Helper;

use Zend\View\Helper\AbstractHelper;
use Zend\Session\Container;
use Zend\ServiceManager\ServiceLocatorAwareInterface;  
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\View\Renderer\PhpRenderer;
use Zend\View\Model\ViewModel;
use Application\Service\HeadlineService as HeadlineService;  
 
class HeadlineHelper extends AbstractHelper implements ServiceLocatorAwareInterface
{
    protected static $state;
	protected $wordageObject;
	protected $wordage;
	protected $username;
	protected $itemId;
	protected $viewmodel;
	protected $renderer;
	protected $log;
	// Array of Containers that this Wordage participates in.
	protected $containerItems;
	protected $em;

    /** 
     * Set the service locator. 
     * 
     * @ param ServiceLocatorInterface $serviceLocator 
     * @ return CustomHelper 
     */ 
    public function __construct()
	{
	}
	public function setLog($log)
	{
		$this->log = $log;
	}
	public function getLog()
	{
		return $this->log;
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
	public function setHeadlineObject($headline)
	{
		$this->headlineObject = $headline
		$this->headline= $headlineObject->getHeadline();
		$em = $this->getEntityManager();
		$wordageObject->setEntityManager($em);
		//$this->containerItems = $wordageObject->getContainerItems();
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
        $viewRender = $this->getServiceLocator()->get('ViewRenderer');
    	//$sm = $this->getServiceLocator()->getServiceLocator();  
        //$config = $sm->get('application')->getConfig(); 
 
        //$retval = "<div>";
	//	$retval .= $this->wordageObject->getWordage();
	//	$retval .= "</div>";
    	
    	$view = $this->getViewModel();

    	$containerItems = $this->getContainerItems();

    	$view->containerItems = $containerItems;
		
		$view->setTemplate('items/headline.phtml');
		
		//return $view;
		
		//return $retval;
		
//		return print_r($view,true);
		return $viewRender->render($view);
    }
}
