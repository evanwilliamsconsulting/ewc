<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */
namespace Application\Controller;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\View\Model\JsonModel;
use Application\Entity\Wordage;
use Application\Entity\CodeSample;
use Application\View\Helper\CodeHelper;
use Hex\View\Helper\CustomHelper;
use Doctrine\ORM\EntityManager;
use Application\Form\Entity\WordageForm;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterInterface;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\Session\Container;
use Zend\View\Renderer\PhpRenderer;
use Zend\View\Resolver;

class CodeController extends AbstractActionController
{
    protected $em;
	protected $authservice;
	protected $username;
	protected $log;
 
    public function __construct()
	{
	}
    public function getEntityManager()
    {
        if (null == $this->em)
        {
            $this->em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');
	}
	return $this->em;
    }
	public function getAuthService()
    {
        if (! $this->authservice) {
            $this->authservice = $this->getServiceLocator()
                                      ->get('AuthService');
        }
        return $this->authservice;
    }
    public function indexAction()
    {
    	$view = new ViewModel();
	    $view->content = $this->content();
		
		$layout = $this->layout();
		// This second layout look really should happen if logged in.
		$layout->setTemplate('layout/correspondant');
		
        return $view;
    }
    public function contentAction()
    {
	// Retrieve Custom Config
	$config = $this->getServiceLocator()->get('config');
	$settings = $config['settings'];
	$SITEROOT = $settings['SITE_ROOT'];
	$rooturl = 'https://' . $SITEROOT . '/';

    	$this->log = $this->getServiceLocator()->get('log');
    	$log = $this->log;

	// Initialize the View
    	$view = new ViewModel();
	//$view->setTerminal(true);
	// Retreive the parameters
	$id = $this->params()->fromRoute('item');

	// 2Do: Check to see that user is logged in

 	$persistent = $this->getAuthService()->getStorage();
	$namespace = $persistent->getNamespace();

    	// 2Do: Populate username with user's username
    	$userSession = new Container('user');
	$this->username = $userSession->username;
	$loggedIn = $userSession->loggedin;
	$loggedIn = true;
	if ($loggedIn)
	{
		// Set the Helpers
		$layout = $this->layout();
		foreach($layout->getVariables() as $child)
		{
			$child->setLoggedIn(true);
			$child->setUserName($username);
		}
	}
	else
	{
	       	return $this->redirect()->toUrl($rooturl);
	}
		
	$em = $this->getEntityManager()	;
		
	$codeSample = $em->getRepository('Application\Entity\CodeSample')->find($id);

	$codeItem = new CodeHelper();
	$codeItem->setServiceLocator($this->getServiceLocator());
	// What do you suppose that the Service Locator does?
	$codeItem->setViewModel($view);
	$codeItem->setCodeObject($codeSample);
		
	$theId = $codeSample->getId();
	$title = $codeSample->getTitle();
	$code = $codeSample->getCode();
	$language = $codeSample->getLanguage();
	$firstLine = $codeSample->getFirstLine();
	$lastLine = $codeSample->getLastLine();

	$webRoot = $rooturl;
	$fileDirectory = "filestore/Arduino/Blink/";
	$fileRelative = "/usr/local/apache2/htdocs/evtechnote/public/" . $fileDirectory . "Blink.ino";

	$fileContents = file_get_contents($fileRelative);

		
	$variables = array("status" => "200",'id'=>$theId,'title'=>$title,"code"=>$code,"language"=>$language,"firstLine"=>$firstLine,"lastLine"=>$lastLine,"fileContents"=>print_r($fileContents,true),"fileRelative"=>$fileRelative);
	$view->variables = $variables;
	$view->fileContents = $fileContents;
	$view->codehelp = $codeItem;
	/*
        $response = $this->getResponse();
        $response->setStatusCode(200);
        $response->setContent(json_encode($variables));
	return $response;
        */
	return $view;
    }
    public function deleteAction()
    {
	// Retrieve Custom Config
	$config = $this->getServiceLocator()->get('config');
	$settings = $config['settings'];
	$SITEROOT = $settings['SITE_ROOT'];
	$rooturl = 'https://' . $SITEROOT . '/';
    	$this->log = $this->getServiceLocator()->get('log');
    	$log = $this->log;

	// Initialize the View
    	$view = new ViewModel();
	//$view->setTerminal(true);
	// Retreive the parameters
	$id = $this->params()->fromRoute('item');

	// 2Do: Check to see that user is logged in

 	$persistent = $this->getAuthService()->getStorage();
	$namespace = $persistent->getNamespace();

    	// 2Do: Populate username with user's username
    	$userSession = new Container('user');
	$this->username = $userSession->username;
	$loggedIn = $userSession->loggedin;
	if ($loggedIn)
	{
		// Set the Helpers
		$layout = $this->layout();
		foreach($layout->getVariables() as $child)
		{
			$child->setLoggedIn(true);
			$child->setUserName($username);
		}
	}
	else
	{
	       	return $this->redirect()->toUrl($rooturl);
	}
		
	$em = $this->getEntityManager()	;
	$wordage = $em->getRepository('Application\Entity\Wordage')->find($id);
	$em->remove($wordage);
	$em->flush();
		
	$variables = array("status" => "200",'id'=>$theId);

        $response = $this->getResponse();
        $response->setStatusCode(200);
        $response->setContent(json_encode($variables));
	return $response;
    }
    public function viewAction()
    {
	// Retrieve Custom Config
	$config = $this->getServiceLocator()->get('config');
	$settings = $config['settings'];
	$SITEROOT = $settings['SITE_ROOT'];
	$rooturl = 'https://' . $SITEROOT . '/';

    	// Load the logger
    	$this->log = $this->getServiceLocator()->get('log');
    	$log = $this->log;
		
	// Initialize the View
    	$view = new ViewModel();
	// Retreive the parameters
	$id = $this->params()->fromRoute('item');
		
	// 2Do: Check to see that user is logged in

 	$persistent = $this->getAuthService()->getStorage();
	$namespace = $persistent->getNamespace();

    	// 2Do: Populate username with user's username
    	$userSession = new Container('user');
		$this->username = $userSession->username;
		$loggedIn = $userSession->loggedin;
		if ($loggedIn)
		{
			// Set the Helpers
			$layout = $this->layout();
			foreach($layout->getVariables() as $child)
			{
				$child->setLoggedIn(true);
				$child->setUserName($username);
			}
		}
		else
		{
	       		return $this->redirect()->toUrl($rooturl);
		}
		
		$em = $this->getEntityManager()	;
		
		$wordage = $em->getRepository('Application\Entity\Wordage')->find($id);
		
		//$topic = new \Application\View\Helper\TopicToolbar('wordage');
		//$view->topic = $topic();
		$theWords = $wordage->getWordage();
		$title = $wordage->getTitle();
		
		$view->title = $title;
		$view->content = $theWords;
		$view->id =$id;
	return $view;
    }
    public function wordageAction()
    {
	$view = new ViewModel();
        $view->content = $this->content();
        return $view;
    }
    public function newAction()
    {
	$view = new ViewModel();
        return $view;
    }
    public function changeAction()
    {
    	$this->log = $this->getServiceLocator()->get('log');
    	$log = $this->log;

	$changedtext = $this->params()->fromPost('thetext');

	$id = $this->params()->fromRoute('item');
	//$theId = substr($wordageid,strpos('wordage-',$wordageid)+8,strlen($wordageid));
	$theArray = array('id' => $id);

	$em = $this->getEntityManager();
	$wordage = $em->getRepository('Application\Entity\Wordage')->findOneBy($theArray);

	$wordage->setWordage($changedtext);
	$em->persist($wordage);
	$em->flush();

	$variables = array("status" => "200",'id'=>$theId,'wordage'=>print_r($wordage,true));
        $response = $this->getResponse();
        $response->setStatusCode(200);
        $response->setContent(json_encode($variables));
	return $response;
    }
    public function editAction()
    {
    	$this->log = $this->getServiceLocator()->get('log');
    	$log = $this->log;
	$view = new ViewModel();
	$view->setTerminal(true);
	$renderer = new PhpRenderer();
	$resolver = new Resolver\AggregateResolver();
	$renderer->setResolver($resolver);

	//$this->_helper->layout()->disableLayout();
	//$this->_helper->viewRenderer->setNoRender(true);

	$map = new Resolver\TemplateMapResolver(array(
    		'edit'      => __DIR__ . '/../../../view/application/wordage/edit.phtml',
	));
	$stack = new Resolver\TemplatePathStack(array(
    		'script_paths' => array(
        	__DIR__ . '/view',
    		)
	));

	$resolver->attach($map);
	$resolver->attach($stack);

	$wordageid = $this->params()->fromRoute('item');
	//$wordageid = $this->params()->fromQuery('id');
	// Looking for: wordage- or 8 chars

	$theArray = array('id' => $wordageid);

	$em = $this->getEntityManager();
	$wordage = $em->getRepository('Application\Entity\Wordage')->findOneBy($theArray);
	$actualWords = $wordage->getWordage();
	$theWords = $wordage->getWordage();
	$title = $wordage->getTitle();
		
	$view->title = $title;
	$view->content = $theWords;
	$view->id =$id;
	return $view;
    }
    public function editinplaceAction()
    {
    	$this->log = $this->getServiceLocator()->get('log');
    	$log = $this->log;
	$viewModel = new ViewModel();
	$viewModel->setTemplate("edit");
	$renderer = new PhpRenderer();
	$resolver = new Resolver\AggregateResolver();
	$renderer->setResolver($resolver);

	$map = new Resolver\TemplateMapResolver(array(
    		'edit'      => __DIR__ . '/../../../view/application/wordage/edit.phtml',
	));
	$stack = new Resolver\TemplatePathStack(array(
    		'script_paths' => array(
        	__DIR__ . '/view',
    		)
	));

	$resolver->attach($map);
	$resolver->attach($stack);

	$wordageid = $this->params()->fromRoute('item');
	//$wordageid = $this->params()->fromQuery('id');
	// Looking for: wordage- or 8 chars
	$viewModel->setVariable('theid',$wordageid);

	$theArray = array('id' => $wordageid);

	$em = $this->getEntityManager();
	$wordage = $em->getRepository('Application\Entity\Wordage')->findOneBy($theArray);
	$actualWords = $wordage->getWordage();
	$viewModel->setVariable('actualWords',$actualWords);
	$viewModel->setVariable('id',$theId);

	$variables = array("id" => $wordageid,"view" => $renderer->render($viewModel),"thewordage" => print_r($wordage,true));
	$jsonModel = new JsonModel($variables);
        $response = $this->getResponse();
        $response->setStatusCode(200);
        $response->setContent(json_encode($variables));
	return $response;
    }
}
