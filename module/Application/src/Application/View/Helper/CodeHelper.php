<?php
namespace Application\View\Helper;

use Zend\View\Helper\AbstractHelper;
use Zend\Session\Container;
use Zend\ServiceManager\ServiceLocatorAwareInterface;  
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\View\Renderer\PhpRenderer;
use Zend\View\Model\ViewModel;
use Application\Service\PictureService as PictureService;  
 
class CodeHelper extends AbstractHelper implements ServiceLocatorAwareInterface
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
    public function setObject($codeObject)
    {
        $this->codeObject = $codeObject;
        $this->first_line = $codeObject->getFirstLine();
        $this->last_line = $codeObject->getLastLine();
        $this->title = $codeObject->getTitle();
        $this->code = $codeObject->getCode();
        $this->language = $codeObject->getLanguage();
        $username = $this->getUsername();


	$webRoot = "https://www.evtechnote.us/";
	$fileDirectory = "filestore/Arduino/Blink/";
	$fileRelative = "/usr/local/apache2/ewc/public/" . $fileDirectory . "Blink.ino";

	$this->fileContents = file_get_contents($fileRelative);

	$fileContents = $this->fileContents;

	$charptr = 0;
	$someString = "";
	$someChar = "";
	$fileArray = explode("\n",$fileContents);
	$this->origArray = $fileArray;


	// Highlight Comments in Orange

	$arrayLength =count($fileArray);

	$styleArray = array_fill(0,$arrayLength,'color:black;');
	$this->styleOrig = $styleArray;

	$i = 0;

	$previousPart = "";

	while ($i<$arrayLength)
	{
		$fileLine = $fileArray[$i];
		$styleArray[$i] = 'color:black;';
		// Test to see if $fileLine contains //
		if (false !== ($pos = strpos($fileLine,"//")))
		{
			// Insert a line into the array
			
			if ($pos == 0)
			{
				/* Comment is length of line */
				//$fileLine .= "<br/>";
				$fileArray[$i] = $fileLine;
				$styleArray[$i] = 'color:red;';
				$i++;
			} 
			else
			{
				$lineLength = strlen($fileLine);
				$firstPartOfLine = substr($fileLine,0,$pos);
				$secondPartOfLine = substr($fileLine,$pos,$lineLength - $pos);
				$originalNextLine = $i + 1;
				$lastPartOfLine = $fileArray[$originalNextLine];
				$insertLine1 = $firstPartOfLine;
				$insertLine2 = $secondPartOfLine;

				$insertLine = $fileLine;
				$insertLine .= "<br/>";
				$insertArray = Array();
				$insertStyle = Array();
				$insertArray[] = $insertLine1;
				$insertArray[] = $insertLine2;
				$insertArray[] = "<br/>";
				$arrayLength += 2;
				$previousPart = $lastPartOfLine;
				$firstArray = array_slice($fileArray,0,$i-1,true);
				$secondArray = array_slice($fileArray,$i+1,$arrayLength - $i - 1,true);
				$fileArray = array_merge($firstArray,$insertArray,$secondArray);
				$firstArray = array_slice($styleArray,0,$i-1,true);
				$secondArray = array_slice($styleArray,$i+1,$arrayLength - $i, true);
				$insertStyle[] = 'color:black;';	
				$styleArray = array_merge($firstArray,$insertStyle,$secondArray);
				$styleArray[$i] = "color:orange;";
				$i++;
				$i++;
				$i++;
			}

		}
		else
		{
			$fileLine .= "<br/>";
			$fileArray[$i] = $fileLine;
			$styleArray[$i] = 'color:black;';
			$i++;
		}
	}

/*
	$length = count($fileArray);
	$this->fileArray = array();
	for ($i=0;$i<$length;$i++)
	{
		$someChar = $fileArray[$i];
		if ($someChar == '\n')
		{
			$this->fileArray[] = $someString;
			$someString = "";
		}
		else
		{
			$someString .= $someChar;
		}
	}
*/
/* good enough, anyway! */
	$this->fileArray = $fileArray;
	$this->styleArray = $styleArray;
/* Now loop through the fileArray and remove the comments! */
	$j = 0;
	$noComment = array();
	for ($i = 0;$i < $arrayLength; $i++)
        {
		$style = $styleArray[$i];
		if (0==(strcmp($style,'color:black;')))
		{
			$noComment[] = $fileArray[$i];	
		}
        }
	$this->noCommentsArray = $noComment;
	/* good enough! I guess you could call this approximate coding */
	/* now let's move on to syntax highlighting!! */
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
		
	$view->bcolor = "#f9e79f";
	$view->language = $this->language;
	$view->title = $this->title;
	$view->fileArray = $this->fileArray;
	$view->styleArray = $this->styleArray;
	$view->noCommentsArray = $this->noCommentsArray;

	$view->setTemplate('items/codesample.phtml');
		
	return $viewRender->render($view);
    }
}
