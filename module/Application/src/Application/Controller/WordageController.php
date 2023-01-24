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
use Hex\View\Helper\CustomHelper;
use Doctrine\ORM\EntityManager;
use Application\Form\Entity\WordageForm;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterInterface;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\Session\Container;
use Zend\View\Renderer\PhpRenderer;
use Zend\View\Resolver;

class WordageController extends AbstractActionController
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

	// Initialize the View
    	$view = new ViewModel();

	// 2Do: Check to see that user is logged in

 	$persistent = $this->getAuthService()->getStorage();
	$namespace = $persistent->getNamespace();

    	// 2Do: Populate username with user's username
    	$userSession = new Container('user');
	$this->username = $userSession->username;
	$username = $this->username;
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
	       	return $this->redirect()->toUrl('https://www.evtechnote.us/');
	}

	/* See that! */
        $em = $this->getEntityManager();
	$wordages = $em->getRepository('Application\Entity\Wordage')->findAll();

	$wordage_items = Array();

	foreach ($wordages as $key => $wordage)
	{
		$wordage_item = Array();
		$id = $wordage->getId();
		$wordage_text  = $wordage->getWordage();
		$binder_id = $wordage->getBinderId();
		$title = $wordage->getTitle();
		$wordage_item[] = $id;
		$wordage_item[] = $binder_id;
		$wordage_item[] = $title;
		$wordage_item[] = $wordage_text;
		$wordage_items[] = $wordage_item;
	}
	$html = "<div>";
	$html .=  "<div>";
	$html .= "<span>Id</span><span>Binder Id</span><span>Title</span><span>Wordage</span>";
	$html .= "</div>";
	foreach ($wordage_items as $key => $item)
	{
		$id = $item[0];
		$binder_id = $item[1];
		$title = $item[2];
		$wordage_text = $item[3];
		$html .= "<div>";	
		$html .= "<span>";
		$html .= $id;
		$html .= "</span>";
		$html .= "<span>";
		$html .= $binder_id;
		$html .= "</span>";
		$html .= "<span>";
		$html .= $title;
		$html .= "</span>";
		$html .= "<span>";
		$html .= substr($wordage_text,0,40);
		$html .= "</span>";
		$html .= "</div>";
	}
	$html .= "</div>";

	$view->content = $html;

	return $view;
    }
    public function deleteAction()
    {
	// Initialize the View
    	$view = new ViewModel();
	$view->setTerminal(true);
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
	       	return $this->redirect()->toUrl('https://www.evtechnote.us/');
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

    	$userSession = new Container('user'); // Talk about conflicting names!
	$this->username = $userSession->username;
	$loggedIn = $userSession->loggedin;
	if ($loggedIn)
	{
		// Set the Helpers
		$layout = $this->layout();
		foreach($layout->getVariables() as $child)
		{
			$child->setLoggedIn(true);
			$child->setUserName($this->username);
		}
	}
	else
	{
	       return $this->redirect()->toUrl('https://www.evtechnote.us/');
	}
	// Initialize the View
    	$view = new ViewModel();
	// Retreive the parameters

	$id = $this->params()->fromQuery("id");

	if (is_null($id))
	{
		$id = 22;
	}
		
	// 2Do: Check to see that user is logged in

 	$persistent = $this->getAuthService()->getStorage();
	$namespace = $persistent->getNamespace();

    	// 2Do: Populate username with user's username
    	$userSession = new Container('user');
		$this->username = $userSession->username;
		$username = $this->username;
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
	       		return $this->redirect()->toUrl('https://www.evtechnote.us/');
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
	$view = new ViewModel();
	$view->setTerminal(true);
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
    public function jsonAction()
    {
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
	$viewModel->setVariable('content',$actualWords);
	$viewModel->setVariable('id',$theId);

	//$responseHTML = "<textarea>" . $actualWords . "</textarea>";

	$wordageResponse = $renderer->render($viewModel);

	$variables = array("id" => $wordageid,"view" => $wordageResponse);
	$jsonModel = new JsonModel($variables);
        $response = $this->getResponse();
        $response->setStatusCode(200);
        $response->setContent(json_encode($variables));
	return $response;
    }
}
