<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @divnk      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @divcense   http://framework.zend.com/divcense/new-bsd New BSD License
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

	// Initiadivze the View
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
	       	return $this->redirect()->toUrl('https://evanwilliamsconsulting.local/');
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
	$html = "<div class='wordage_table'>";
	$html .=  "<ul class='wordage_row'>";
	$html .= "<li class='wordage_id_col'>";
	$html .= "Id";
	$html .= "</li>";
	$html .= "<li class='wordage_binder_id_col'>";
	$html .= "Binder Id"; 
	$html .= "</li>";
	$html .= "<li class='wordage_title_col'>";
	$html .= "Title";
	$html .= "</li>";
	$html .= "<li class='wordage_text_col'>";
	$html .= "Wordage";
	$html .= "</li>";
	$html .= "</ul>";
	$html .= "<br/>";
	foreach ($wordage_items as $key => $item)
	{
		$id = $item[0];
		$binder_id = $item[1];
		$title = strip_tags($item[2]);
		$wordage_text = strip_tags($item[3]);
		$html .= "<ul class='wordage_row'>";	
		$html .= "<li class='wordage_id_col'>";
		$html .= $id;
		$html .= "</li>";
		$html .= "<li class='wordage_binder_id_col'>";
		$html .= $binder_id;
		$html .= "</li >";
		$html .= "<li class='wordage_title_col'>";
		$html .= $title;
		$html .= "</li>";
		$html .= "<li class='wordage_text_col'>";
		$html .= substr($wordage_text,0,40);
		$html .= "</li >";
		$html .= "</ul>";
		$html .= "<br/>";
	}
	$html .= "</div>";

	$view->content = $html;

	return $view;
    }
    public function deleteAction()
    {
	// Initiadivze the View
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
	       	return $this->redirect()->toUrl('https://evanwilliamsconsulting.local/');
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

    	$userSession = new Container('user'); // Talk about confdivcting names!
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
	       return $this->redirect()->toUrl('https://evanwilliamsconsulting.local/');
	}
	// Initiadivze the View
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
	       		return $this->redirect()->toUrl('https://evanwilliamsconsulting.local/');
		}
		
		$em = $this->getEntityManager()	;
		$wordage = $em->getRepository('Application\Entity\Wordage')->find($id);
		
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
    public function saveAction()
    {
    	$userSession = new Container('user'); // Talk about confdivcting names!
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
	       return $this->redirect()->toUrl('https://evanwilliamsconsulting.local/');
	}
	// Initialize the View
	$view = new ViewModel();

/*
	$view->setTerminal(true);
*/

	$id = $this->params()->fromQuery("id");
	$from = $this->params()->fromQuery("from");


	if (is_null($from))
	{
		$from = "wordage";
	}

	$words = $this->getRequest()->getPost('wordage',null);
	$title = $this->getRequest()->getPost('title',null);

	$view->wordage = $words;
	$view->title = $title;

	$em = $this->getEntityManager();
	$wordage = $em->getRepository('Application\Entity\Wordage')->find($id);
		
	$wordage->setWordage($words);
	$wordage->setTitle($title);
	$em->persist($wordage);
	$em->flush();
		
	$view->title = $title;
	$view->content = $words;
	$view->id =$id;
	
	if (0 == strcmp($from,"correspondant"))
	{
	   return $this->redirect()->toUrl('/correspondant/index');
	}
	else if (0 == strcmp($from,"wordage"))
	{
	   return $this->redirect()->toUrl('/wordage/index');
	}
	else
	{
		return $view;
	}
    }
    public function editAction()
    {
    	$userSession = new Container('user'); // Talk about confdivcting names!
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
	       return $this->redirect()->toUrl('https://evanwilliamsconsulting.local/');
	}
	// Initialize the View
	// Retreive the parameters
	$view = new ViewModel();
/*
	$view->setTerminal(true);
*/

	$id = $this->params()->fromQuery("id");
	$from = $this->params()->fromQuery("from");


	if (is_null($from))
	{
		$from = "wordage";
	}

	$em = $this->getEntityManager();
	$wordage = $em->getRepository('Application\Entity\Wordage')->find($id);
	$actualWords = $wordage->getWordage();
	$theWords = $wordage->getWordage();
	$title = $wordage->getTitle();
		
	$view->title = $title;
	$view->content = $theWords;
	$view->id =$id;
	$view->from = $from;
	return $view;
    }
    public function jsonAction()
    {
    	$userSession = new Container('user'); // Talk about confdivcting names!
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
	       return $this->redirect()->toUrl('https://evanwilliamsconsulting.local/');
	}
	// Initiadivze the View
    	$view = new ViewModel();
	// Retreive the parameters

	$wordageid = $this->params()->fromQuery("id");

	if (is_null($wordageid))
	{
		$wordageid = 22;
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
	       		return $this->redirect()->toUrl('https://evanwilliamsconsulting.local/');
		}


	$id = $this->params()->fromQuery("id");

	if (is_null($id))
	{
		$id = 22;
	}
		

		$em = $this->getEntityManager()	;
		$wordage = $em->getRepository('Application\Entity\Wordage')->find($id);
		
		$theWords = $wordage->getWordage();
		$title = $wordage->getTitle();
		
	$variables = array("id" => $wordageid,"view" => $theWords);
	$jsonModel = new JsonModel($variables);
        $response = $this->getResponse();
        $response->setStatusCode(200);
        $response->setContent(json_encode($variables));
	return $response;
    }
}
