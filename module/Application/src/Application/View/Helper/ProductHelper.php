<?php
namespace Application\View\Helper;

use Zend\View\Helper\AbstractHelper;
use Zend\Session\Container;
use Zend\ServiceManager\ServiceLocatorAwareInterface;  
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\View\Renderer\PhpRenderer;
use Zend\View\Model\ViewModel;
use Application\Service\ProductService as ProductService;  
 
class ProductHelper extends AbstractHelper implements ServiceLocatorAwareInterface
{
	protected $name;
	protected $description;
	protected $sku;
	protected $price;
	protected $serviceLocator;
    protected static $state;
	protected $productObject;
	protected $product;
	protected $username;
	protected $itemId;
	protected $original;
	protected $viewmodel;
	protected $title;
	protected $id;
	protected $renderer;
	protected $log;
	// Array of Containers that this Product participates in.
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
	public function setObject($productObject)
	{
		$this->productObject = $productObject;
		$this->title = $productObject->getTitle();
		$this->id = $productObject->getId();
		$this->name = $productObject->getName();
		$this->description = $productObject->getDescription();
		$this->sku = $productObject->getSku();
		$this->price = $productObject->getPrice();
		$timestamp = explode(' ',$productObject->getOriginal() ?? '11');
		$datets = explode('-',$timestamp[0]);
		$year = $datets[0];
		//$day = $datets[2];
		$monthArray = Array("Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec");
		//$month = $monthArray[intval($datets[1])];
		$month = "Jan";
		//$this->original = $month . " " . intval($day) . ", " . $year;
		$this->username = $productObject->getUsername();
		$em = $this->getEntityManager();
		$productObject->setEntityManager($em);
		//$this->containerItems = $productObject->getContainerItems();
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
	public function render()
	{
		$name = $this->name;
		$title = $this->title;
		$description = $this->description;
		$sku = $this->sku;
		$price = $this->price;

		$html = "<div>";
		$html .= "<div>" . $name . "</div>";
		$html .= "<div>" . $title . "</div>";
		$html .= "<div>" . $description . "</div>";
		$html .= "<div>" . $sku . "</div>";
		$html .= "<div>" . $price . "</div>";
		$html .= "</div>";

		return $html;
	}
    public function __invoke()
    {
        $viewRender = $this->getServiceLocator()->get('ViewRenderer');
    	//$sm = $this->getServiceLocator()->getServiceLocator();  
        //$config = $sm->get('application')->getConfig(); 
 
        //$retval = "<div>";
	//	$retval .= $this->productObject->getProduct();
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
	
		$view->title = $this->title;

		$view->original = $this->original;

		$view->id =  $this->id;

		$view->username = $this->username;

		$view->name = $this->name;
		$view->title = $this->title;
		$view->description = $this->description;
		$view->sku = $this->sku;
		$view->price = $this->price;

		$view->editOn = false;
		
		$view->setTemplate('items/product.phtml');
		
		//return $view;
		
		//return $retval;
		
//		return print_r($view,true);
		return $viewRender->render($view);
    }
}
