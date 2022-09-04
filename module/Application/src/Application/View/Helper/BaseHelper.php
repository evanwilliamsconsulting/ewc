<?php
namespace Application\View\Helper;

use Zend\View\Helper\AbstractHelper;
use Zend\Session\Container;
use Zend\ServiceManager\ServiceLocatorAwareInterface;  
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\View\Renderer\PhpRenderer;
use Zend\View\Model\ViewModel;
use Application\Service\PictureService as PictureService;  
 
class BaseHelper extends AbstractHelper implements ServiceLocatorAwareInterface
{
    protected static $state;
    protected $fileid;
    protected $codeObject;
    protected $code;
    protected $language;
    protected $title;
    protected $username;
    protected $id;
    protected $first_line;
    protected $last_line;
    protected $fileContents;
    protected $fileArray;
    protected $origArray;
    protected $styleArray;
    protected $styleOrig;
    protected $noCommentsArray;
    

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
    public function setObject($baseObject)
    {
        $this->baseObject = $baseObject;
	$this->id = $baseObject->getId();
	$this->fileid = $baseObject->getFileId();
	$this->author = $baseObject->getAuthor();
        $this->title = $baseObject->getTitle();
        $this->code = $baseObject->getCode();
        $username = $this->getUsername();

	$webRoot = "https://www.evtechnote.us/";
	$fileDirectory = "filestore/Arduino/Blink/";
	$fileRelative = "/usr/local/apache2/ewc/public/" . $fileDirectory . $this->title;

	$this->fileContents = file_get_contents($fileRelative);
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
        $viewRender = $this->getServiceLocator()->get('ViewRenderer');
    	
    	$view = $this->getViewModel();
		
	$view->bcolor = "#336633";
	$view->title = $this->title;
	$view->fileid = $this->fileid;
	$view->description = $this->description;
	$view->author = $this->author;
	$view->fileContents = $this->fileContents;

	$view->setTemplate('items/codebase.phtml');
		
	return $viewRender->render($view);
    }
}
