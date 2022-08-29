<?php
namespace Application\View\Helper;

use Zend\View\Helper\AbstractHelper;
use Zend\Session\Container;
use Zend\ServiceManager\ServiceLocatorAwareInterface;  
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\View\Renderer\PhpRenderer;
use Zend\View\Model\ViewModel;
use Application\Service\ItemService as ItemService;  
 
class ItemHelper extends AbstractHelper implements ServiceLocatorAwareInterface
{
    protected static $state;
	protected $itemObject;
	protected $username;
	protected $itemId;
	protected $viewmodel;
	protected $renderer;
	protected $itemService;

    /** 
     * Set the service locator. 
     * 
     * @ param ServiceLocatorInterface $serviceLocator 
     * @ return CustomHelper 
     */ 
    public function __construct(ItemService $itemService)
	{
		$this->itemService = $itemService;
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
    public function setViewModel(ViewModel $viewmodel)
	{
		$this->viewmodel = $viewmodel;
	}
	public function getViewModel()
	{
		return $this->viewmodel;
	}
	public function setItemObject($itemObject)
	{
		$this->itemObject = $itemObject;
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
    	//$sm = $this->getServiceLocator()->getServiceLocator();  
        //$config = $sm->get('application')->getConfig(); 
 
        $retval = "<div>";
		$retval .= "Item Helper";
		$retval .= print_r($this->itemService->findAllItems(),true);
		$retval .= "</div>";
    	
    	//$view = $this->getViewModel();
		
		//$view->setTemplate('items/wordage.phtml');
		
		//return $view;
		
		return $retval;
		
		//return print_r($view,true);
    }
}
?>