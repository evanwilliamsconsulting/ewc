<?php
namespace Application\View\Helper;

use Zend\View\Helper\AbstractHelper;
use Zend\Session\Container;
use Zend\ServiceManager\ServiceLocatorAwareInterface;  
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\View\Renderer\PhpRenderer;
use Zend\View\Model\ViewModel;
use Application\Service\OutlineService as OutlineService;  
 
class OutlineHelper extends AbstractHelper implements ServiceLocatorAwareInterface
{
    protected static $state;
	protected $outlineObject;
	protected $outline;
	protected $username;
	protected $itemId;
	protected $original;
	protected $viewmodel;
	protected $title;
	protected $entities;
	protected $description;
	protected $id;
	protected $renderer;
	protected $log;
	// Array of Containers that this Outline participates in.
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
	public function setObject($outlineObject)
	{
		$this->outlineObject = $outlineObject;
		$this->outline = $outlineObject->getDescription();
		$this->title = $outlineObject->getTitle();
		$this->id = $outlineObject->getId();
		/* outline entries */
		$params = array();
		$params['outline_id'] = $this->id;
		$em = $this->getEntityManager();
		$outlineEntry = $em->getRepository('Application\Entity\OutlineEntry')->findBy($params);

		$entities = array();
		foreach ($outlineEntry as $key => $item)
		{
			$entryTitle = $item->getTitle();
			$entryDescription = $item->getDescription();
			$entryItem = array("title"=>$entryTitle,"description"=>$entryDescription);
			$entities[] = $entryItem;	
		}
		$this->entities = $entities;
		$timestamp = explode(' ',$outlineObject->getOriginal());
		$datets = explode('-',$timestamp[0]);
		$year = $datets[0];
		//$day = $datets[2];
		$monthArray = Array("Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec");
		//$month = $monthArray[intval($datets[1])];
		$month = "Jan";
		//$this->original = $month . " " . intval($day) . ", " . $year;
		$this->username = $outlineObject->getUsername();
		$em = $this->getEntityManager();
		$outlineObject->setEntityManager($em);
		//$this->containerItems = $outlineObject->getContainerItems();
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
	//	$retval .= $this->outlineObject->getOutline();
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
	
		$view->outline = $this->outline;

		$view->title = $this->title;

		$view->original = $this->original;

		$view->entities = $this->entities;

		$view->id =  $this->id;

		$view->username = $this->username;

		$view->editOn = false;
		
		$view->setTemplate('items/outline.phtml');
		
		//return $view;
		
		//return $retval;
		
//		return print_r($view,true);
		return $viewRender->render($view);
    }
}
