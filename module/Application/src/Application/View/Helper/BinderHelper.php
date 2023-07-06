<?php
namespace Application\View\Helper;

use Zend\View\Helper\AbstractHelper;
use Zend\Session\Container;
use Zend\ServiceManager\ServiceLocatorAwareInterface;  
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\View\Renderer\PhpRenderer;
use Zend\View\Model\ViewModel;
use Application\Service\BinderService as BinderService;  

use Application\Model\Items as Items;
use Application\Entity\Wordage as Wordage;
use Application\Entity\Picture as Picture;
use Application\Entity\File as File;
use Application\Entity\CodeSample as CodeSample;
use Application\Entity\Experience as Experience;

use Application\Entity\Container as Bag;
use Application\Entity\Schematic as Schematic;
use Application\Entity\Lesson as Lesson;
use Application\Entity\Graphic as Graphic;

use Application\View\Helper\WordageHelper as WordageHelper;
use Application\Service\WordageService as WordageService;

use Application\View\Helper\PictureHelper as PictureHelper;
use Application\View\Helper\FileHelper as FileHelper;
use Application\View\Helper\CodeHelper as CodeHelper;
use Application\View\Helper\BaseHelper as BaseHelper;
use Application\View\Helper\ExperienceHelper as ExperienceHelper;

use Application\View\Helper\HeadlineHelper as HeadlineHelper;

use Application\View\Helper\Toolbar as Toolbar;
 
class BinderHelper extends AbstractHelper implements ServiceLocatorAwareInterface
{
        protected static $state;
	protected $binderObject;
	protected $username;
	protected $itemId;
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
	public function setObject($binderObject)
	{
		$this->binderObject = $binderObject;
		$this->title = $binderObject->getTitle();
		$this->id = $binderObject->getId();
		$timestamp = explode(' ',$binderObject->getOriginal());
		$datets = explode('-',$timestamp[0]);
		$year = $datets[0];
		$monthArray = Array("Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec");
		$month = "Jan";
		$this->username = $binderObject->getUsername();
		$em = $this->getEntityManager();
		$binderObject->setEntityManager($em);
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
	$em = $this->em;

        $viewRender = $this->getServiceLocator()->get('ViewRenderer');
    	
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


	// Taken from BinderController.php

	/* Here is an example for you!

	The id for the binder object and database table is the primary id,
	So it is called just 'id'.  Everywhere else, that is, in every
	Other table where the binder_id is used it is called 'binder_id',
	Because it is not the native key to the table (so far that is!)

	So as a result we have the confusing code below!!!
	2DO: Maybe we should use composite keys rather than autonumbers!!!

	*/
	$params = array();
	$params['binder_id'] = $this->id;

	$itemArray = array();
	$view = new ViewModel();
	$ENTITY_ROOT = "Application\\Entity\\";

	$types = array("Wordage","Picture","Experience","File","CodeBase","CodeSample","Outline");

	foreach ($types as $key => $type)
	{	
		$entity = $ENTITY_ROOT . $type;
		$items = $em->getRepository($entity)->findBy($params);
		foreach	($items as $item)
		{
			// Here is where an factory might be used?
			if (0 == strcmp($type,"Wordage"))
			{
				$helperItem = new WordageHelper();
				$helperItem->setLoggedIn(true);
			}
			else if (0 == strcmp($type,"Picture"))
			{
				$helperItem = new PictureHelper();
				$helperItem->setLoggedIn(true);
			}
			else if (0 == strcmp($type,"Experience"))
			{
				$helperItem = new ExperienceHelper();
			}
			else if (0 == strcmp($type,"CodeBase"))
			{
				$helperItem = new BaseHelper();
			}
			else if (0 == strcmp($type,"CodeSample"))
			{
				$helperItem = new CodeHelper();
			}
			else if (0 == strcmp($type,"File"))
			{
				$helperItem = new FileHelper();
			}
			else if (0 == strcmp($type,"Outline"))
			{
				$helperItem = new OutlineHelper();
			}
			$helperItem->setServiceLocator($this->getServiceLocator());
			$helperItem->setEntityManager($em);
			$helperItem->setViewModel($view);
			$helperItem->setObject($item);
			$itemArray[] = $helperItem;
		}
	}

	$view->items = $itemArray;

    	$view->containerItems = $containerItems;
	
	$view->title = $this->title;

	$view->original = $this->original;

	$view->id =  $this->id;

	$view->username = $this->username;

	$view->editOn = false;
		
	$view->setTemplate('items/binder.phtml');
		
	return $viewRender->render($view);
    }
}
