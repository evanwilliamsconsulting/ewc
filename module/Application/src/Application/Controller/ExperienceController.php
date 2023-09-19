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
use Application\Entity\Experience;
use Hex\View\Helper\CustomHelper;
use Doctrine\ORM\EntityManager;
use Application\Form\Entity\ExperienceForm;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterInterface;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\Session\Container;
use Zend\View\Renderer\PhpRenderer;
use Zend\View\Resolver;

class ExperienceController extends AbstractActionController
{
    protected $em;
	protected $authservice;
	protected $username;
 
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
	       	return $this->redirect()->toUrl($rooturl);
	}
		
	$em = $this->getEntityManager()	;
		
	$experience = $em->getRepository('Application\Entity\Experience')->find($id);
		
	$theWords = $experience->getExperience();
	$title = $experience->getTitle();
		
	$variables = array("status" => "200",'id'=>$theId,'title'=>$title,'content'=>$theWords,true);
        $response = $this->getResponse();
        $response->setStatusCode(200);
        $response->setContent(json_encode($variables));
	return $response;
    }
    public function deleteAction()
    {
	// Retrieve Custom Config
	$config = $this->getServiceLocator()->get('config');
	$settings = $config['settings'];
	$SITEROOT = $settings['SITE_ROOT'];
	$rooturl = 'https://' . $SITEROOT . '/';

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
	       	return $this->redirect()->toUrl($rooturl);
	}
		
	$em = $this->getEntityManager()	;
	$experience = $em->getRepository('Application\Entity\Experience')->find($id);
	$em->remove($experience);
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

	// Initialize the View
    	$view = new ViewModel();
	// Retreive the parameters
	$id = $this->params()->fromRoute('item');
	$log = $this->getServiceLocator()->get('log');
	$id = $this->params()->fromRoute('item');
	$log->info($id);
		

 	$persistent = $this->getAuthService()->getStorage();
	$namespace = $persistent->getNamespace();

	//$username = $persistent->getUsername();


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
	       		return $this->redirect()->toUrl($rooturl);
		}
		

		$em = $this->getEntityManager();
		
		$experience = $em->getRepository('Application\Entity\Experience')->find($id);

		
		$topic = new \Application\View\Helper\TopicToolbar('experience');
		$view->topic = $topic();
		$theDescription = $experience->getDescription();
		$startDate = $experience->getStartDate();
		$endDate = $experience->getEndDate();
		$company = $experience->getCompany();
		$role = $experience->getRole();
		$skills = $experience->getSkills();
		$title = $experience->getTitle();
		
		$view->title = $title;
		$view->content = $theDescription;
		$view->startDate = date_format($startDate,"m/d/Y");
		$view->endDate = date_format($endDate,"m/d/Y");
		$view->company = $company;
		$view->role = $role;
		$view->skills = $skills;
		$view->id =$id;
	return $view;
    }
    public function experienceAction()
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
    public function  changeAction()
    {
	$log = $this->getServiceLocator()->get('log');
	$id = $this->params()->fromRoute('item');
	$log->info("change");
	$log->info($id);

	$description = $_GET['description'];
	$log->info($description);
	$skills = $_GET['skills'];
	$log->info($skills);
	$company = $_GET['company'];
	$log->info($company);
	$role = $_GET['role'];
	$log->info($role);
	$title = $_GET['title'];
	$log->info($title);
	$startDate = $_GET['startDate'];
	$log->info($startDate);
	$endDate = $_GET['endDate'];
	$log->info($endDate);

	$theArray = array('id' => $id);

	$em = $this->getEntityManager();
	$experience = $em->getRepository('Application\Entity\Experience')->findOneBy($theArray);

	$experience->setDescription($description);
	$experience->setSkills($skills);
	$experience->setCompany($company);
	$experience->setRole($role);
	$experience->setTitle($title);
	$startDate = new \DateTime($startDate);
	$endDate = new \DateTime($endDate);
	$experience->setStartDate($startDate);
	$experience->setEndDate($endDate);
	$em->persist($experience);
	$em->flush();

	$variables = array("status" => "200",'id'=>$id,'experience'=>print_r($experience,true));
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

	//$this->_helper->layout()->disableLayout();
	//$this->_helper->viewRenderer->setNoRender(true);

	$map = new Resolver\TemplateMapResolver(array(
    		'edit'      => __DIR__ . '/../../../view/application/experience/edit.phtml',
	));
	$stack = new Resolver\TemplatePathStack(array(
    		'script_paths' => array(
        	__DIR__ . '/view',
    		)
	));

	$resolver->attach($map);
	$resolver->attach($stack);

	$experienceid = $this->params()->fromRoute('item');
	//$experienceid = $this->params()->fromQuery('id');
	// Looking for: experience- or 8 chars

	$theArray = array('id' => $experienceid);

	$em = $this->getEntityManager();
	$experience = $em->getRepository('Application\Entity\Experience')->findOneBy($theArray);
		$theDescription = $experience->getDescription();
		$startDate = $experience->getStartDate();
		$endDate = $experience->getEndDate();
		$company = $experience->getCompany();
		$role = $experience->getRole();
		$skills = $experience->getSkills();
		$title = $experience->getTitle();
		
		$view->title = $title;
		$view->content = $theDescription;
		$view->startDate = $startDate->format("m/d/Y");
		$view->endDate = $endDate->format("m/d/Y");
		$view->company = $company;
		$view->role = $role;
		$view->skills = $skills;
		$view->id =$id;
	return $view;
    }
    public function editinplaceAction()
    {
	$viewModel = new ViewModel();
	$viewModel->setTemplate("edit");
	$renderer = new PhpRenderer();
	$resolver = new Resolver\AggregateResolver();
	$renderer->setResolver($resolver);

	$map = new Resolver\TemplateMapResolver(array(
    		'edit'      => __DIR__ . '/../../../view/application/experience/edit.phtml',
	));
	$stack = new Resolver\TemplatePathStack(array(
    		'script_paths' => array(
        	__DIR__ . '/view',
    		)
	));

	$resolver->attach($map);
	$resolver->attach($stack);

	$experienceid = $this->params()->fromRoute('item');
	//$experienceid = $this->params()->fromQuery('id');
	// Looking for: experience- or 8 chars
	$viewModel->setVariable('theid',$experienceid);

	$theArray = array('id' => $experienceid);

	$em = $this->getEntityManager();
	$experience = $em->getRepository('Application\Entity\Experience')->findOneBy($theArray);
	$actualWords = $experience->getExperience();
	$viewModel->setVariable('actualWords',$actualWords);
	$viewModel->setVariable('id',$theId);

	$variables = array("id" => $experienceid,"view" => $renderer->render($viewModel),"theexperience" => print_r($experience,true));
	$jsonModel = new JsonModel($variables);
        $response = $this->getResponse();
        $response->setStatusCode(200);
        $response->setContent(json_encode($variables));
	return $response;
    }
}
