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
use Application\Entity\Outline;
use Hex\View\Helper\CustomHelper;
use Doctrine\ORM\EntityManager;
use Application\Form\Entity\WordageForm;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterInterface;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\Session\Container;
use Zend\View\Renderer\PhpRenderer;
use Zend\View\Resolver;
use Application\Entity\OutlineEntry as OutlineEntry;

class OutlineController extends AbstractActionController
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
	// Retrieve Custom Config
	$config = $this->getServiceLocator()->get('config');
	$settings = $config['settings'];
	$SITEROOT = $settings['SITE_ROOT'];
	$rooturl = 'https://' . $SITEROOT . '/';

    	$this->log = $this->getServiceLocator()->get('log');
    	$log = $this->log;
    	$log->info("view action");

	// Initialize the View
    	$view = new ViewModel();

	// 2Do: Check to see that user is logged in

 	$persistent = $this->getAuthService()->getStorage();
	$namespace = $persistent->getNamespace();
	$log->info($namespace);

    	// 2Do: Populate username with user's username
    	$userSession = new Container('user');
	$this->username = $userSession->username;
	$username = $this->username;
	$log->info($this->username);
	$loggedIn = $userSession->loggedin;
	if ($loggedIn)
	{
		$log->info("Logged In");
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
		$log->info("Not Logged In");
	       	return $this->redirect()->toUrl($rooturl);
	}

	return $view;
    }
/*
    public function deleteAction()
    {
	// Retrieve Custom Config
	$config = $this->getServiceLocator()->get('config');
	$settings = $config['settings'];
	$SITEROOT = $settings['SITE_ROOT'];
	$rooturl = 'https://' . $SITEROOT . '/';

    	$this->log = $this->getServiceLocator()->get('log');
    	$log = $this->log;
    	$log->info("delete action");

	// Initialize the View
    	$view = new ViewModel();
	$view->setTerminal(true);
	// Retreive the parameters
	$id = $this->params()->fromRoute('item');
	$log->info($id);

	// 2Do: Check to see that user is logged in

 	$persistent = $this->getAuthService()->getStorage();
	$namespace = $persistent->getNamespace();
	$log->info($namespace);

    	// 2Do: Populate username with user's username
    	$userSession = new Container('user');
	$this->username = $userSession->username;
	$log->info($this->username);
	$loggedIn = $userSession->loggedin;
	if ($loggedIn)
	{
		$log->info("Logged In");
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
		$log->info("Not Logged In");
	       	return $this->redirect()->toUrl($rooturl);
	}
		
	$em = $this->getEntityManager()	;
	$outline = $em->getRepository('Application\Entity\Outline')->find($id);
	$em->remove($outline);
	$em->flush();
		
	$variables = array("status" => "200",'id'=>$theId);
        $response = $this->getResponse();
        $response->setStatusCode(200);
        $response->setContent(json_encode($variables));
	return $response;
    }
*/
    public function viewAction()
    {
    	// Load the logger
    	$this->log = $this->getServiceLocator()->get('log');
		
	// Initialize the View
    	$view = new ViewModel();
	// Retreive the parameters
	$id = $this->params()->fromRoute('item');
		
	// 2Do: Check to see that user is logged in

 	$persistent = $this->getAuthService()->getStorage();
	$namespace = $persistent->getNamespace();
/*
	$username = $persistent->getUsername();
*/

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
				$child->setUserName($this->username);
			}
		}
		else
		{
	       		return $this->redirect()->toUrl($rooturl);
		}
		
		$em = $this->getEntityManager()	;
		
		$outline = $em->getRepository('Application\Entity\Outline')->find($id);
		
		//$topic = new \Application\View\Helper\TopicToolbar('outline');
		//$view->topic = $topic();
		$theWords = $outline->getDescription();
		$title = $outline->getTitle();
		$outline_id = $id;

		$params = array();
		$orderby = array();
		$params['outline_id'] = $id;
                $orderby['order_no'] = 'ASC';
		$outlineEntry = $em->getRepository('Application\Entity\OutlineEntry')->findBy($params,$orderby);

		$entries = array();
		foreach ($outlineEntry as $key => $item)
		{
			$entryTitle = $item->getTitle();
			$entryDescription = $item->getDescription();
			$key2 = $item->getId();
			$orderNo = $item->getOrderNo();
			$entryItem = array("title"=>$entryTitle,"description"=>$entryDescription,"id"=>$id,"key"=>$key2,"order_no"=>$orderNo);
			$entries[] = $entryItem;	
		}
		$view->title = $title;
		$view->content = $theWords;
		$view->entries = $entries;
		$view->id =$id;
	return $view;
    }
    public function outlineAction()
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
	//$theId = substr($outlineid,strpos('outline-',$outlineid)+8,strlen($outlineid));
	$theArray = array('id' => $id);

	$em = $this->getEntityManager();
	$outline = $em->getRepository('Application\Entity\Outline')->findOneBy($theArray);

	$outline->setWordage($changedtext);
	$em->persist($outline);
	$em->flush();

	$variables = array("status" => "200",'id'=>$theId,'outline'=>print_r($outline,true));
        $response = $this->getResponse();
        $response->setStatusCode(200);
        $response->setContent(json_encode($variables));
	return $response;
    }
    public function addAction()
    {
	$post = $this->getRequest()->getPost();
	$outlineId = $post['id'];
	$key = $post['key'];	
	$test['id']=$outlineId;
	$test['key']=$key;
	$variables = array("status" => "200",'result'=>'test');

	$em = $this->getEntityManager();
	$outlineEntry = $em->getRepository('Application\Entity\OutlineEntry')->find($key);
	$thisOutlineId = $outlineEntry->getOutlineId();
	$thisBinderId = $outlineEntry->getBinderId();
	$outlineEntries = $em->getRepository('Application\Entity\OutlineEntry')->findAll();
	$countAll = count($outlineEntries);
	$newOrderNo = $countAll + 1;
	
    	$userSession = new Container('user');
	$username = $userSession->username;

	$newEntry = new OutlineEntry();
	$newEntry->setUsername($username);
	$theDate = date("Y-m-d");
	$newEntry->setOriginal($theDate);
	$newEntry->setTitle("New Title");
	$newEntry->setLabel("New Label");
	$newEntry->setDescription("New Description");
	$newEntry->setOrderNo(1);
	$newEntry->setBinderId(1);
	$newEntry->setOutlineId($outlineId);

	$em->persist($newEntry);
	$em->flush();

        $response = $this->getResponse();
        $response->setStatusCode(200);
        $response->setContent(json_encode($variables));
	return $response;
    }
    public function upAction()
    {
	$post = $this->getRequest()->getPost();
	$outlineId = $post['id'];
	$key = $post['key'];	
	$em = $this->getEntityManager();
	$params = array();
	$params['outline_id'] = $outlineId;
	$outlineEntry = $em->getRepository('Application\Entity\OutlineEntry')->findBy($params);
	$entries = array();
	$previousKey = 1;
	$currentKey = 0;
	foreach ($outlineEntry as $entry => $item)
	{
	    $entryTitle = $item->getTitle();
	    $entryDescription = $item->getDescription();
	    $key2 = $item->getId();
	    $orderNo = $item->getOrderNo();
	    if ($key2 == $key)
            {
		$currentKey = 1;
		$previousKey = 0;
            }
	    $entries[$key2] = array('order_no'=>$orderNo,'current_key'=>$currentKey,'previous_key'=>$previousKey);	
	    $currentKey = 0;
	}
	// Now read the entries.  If it starts with currentKey = 1 then key is currently at the top.
	$top = 1;	
	$previous_order_no = 1;
	$previous_key2;
	$update = 0;
	foreach ($entries as $key2 => $entryArray)
        {
	    $order_no = $entryArray['order_no'];
	    $current_key = $entryArray['current_key'];
	    $previous_key = $entryArray['previous_key'];
	    if ($current_key == 1 && $top == 0)
	    { 
		// Current Record should be replace by Previous Record
		// Previous Record should be replace by Current Record
		$outlineCurrent = $em->getRepository('Application\Entity\OutlineEntry')->find($key2);
		$outlineCurrent->setOrderNo($previous_order_no);
		$em->persist($outlineCurrent);
		$update = 1;
		break;
	    }
	    $previous_key2 = $key2;
	    $previous_order_no = $order_no;
	    $top = 0;	
        }	
	$em->flush();
	if ($update == 1)
	{
	    $outlinePrevious = $em->getRepository('Application\Entity\OutlineEntry')->find($previous_key2);
	    $outlinePrevious->setOrderNo($order_no);
	    $em->persist($outlinePrevious);
	    $em->flush();
	}
	$variables = array("status" => "200",'result'=>'test','id'=>$outlineId,'key'=>$key,'entries'=>print_r($entries,true));
        $response = $this->getResponse();
        $response->setStatusCode(200);
        $response->setContent(json_encode($variables));
	return $response;
    }
    public function downAction()
    {
	$post = $this->getRequest()->getPost();
	$outlineId = $post['id'];
	$key = $post['key'];	
	$em = $this->getEntityManager();
	$params = array();
	$params['outline_id'] = $outlineId;
	$outlineEntry = $em->getRepository('Application\Entity\OutlineEntry')->findBy($params);
	$entries = array();
	$previousKey = 1;
	$currentKey = 0;
	foreach ($outlineEntry as $entry => $item)
	{
	    $entryTitle = $item->getTitle();
	    $entryDescription = $item->getDescription();
	    $key2 = $item->getId();
	    $orderNo = $item->getOrderNo();
	    if ($key2 == $key)
            {
		$currentKey = 1;
		$previousKey = 0;
            }
	    $entries[$key2] = array('order_no'=>$orderNo,'current_key'=>$currentKey,'previous_key'=>$previousKey);	
	    $currentKey = 0;
	}
	// Now read the entries.  If it starts with currentKey = 1 then key is currently at the top.
	$top = 1;	
	$previous_order_no = 1;
	$previous_key2;
	$update = 0;
	foreach ($entries as $key2 => $entryArray)
        {
	    $order_no = $entryArray['order_no'];
	    $current_key = $entryArray['current_key'];
	    $previous_key = $entryArray['previous_key'];
	    if ($current_key == 1 && $top == 0)
	    { 
		// Current Record should be replace by Previous Record
		// Previous Record should be replace by Current Record
	        $outlinePrevious = $em->getRepository('Application\Entity\OutlineEntry')->find($previous_key2);
	        $outlinePrevious->setOrderNo($order_no);
	        $em->persist($outlinePrevious);
		$update = 1;
		break;
	    }
	    $previous_key2 = $key2;
	    $previous_order_no = $order_no;
	    $top = 0;	
        }	
	$outlineCurrent = $em->getRepository('Application\Entity\OutlineEntry')->find($key2);
	$outlineCurrent->setOrderNo($previous_order_no);
	$em->persist($outlineCurrent);
	$em->flush();
	if ($update == 1)
	{
	    $em->flush();
	}
	$variables = array("status" => "200",'result'=>'test','id'=>$outlineId,'key'=>$key,'entries'=>print_r($entries,true));
        $response = $this->getResponse();
        $response->setStatusCode(200);
        $response->setContent(json_encode($variables));
	return $response;
    }
    public function deleteAction()
    {
	$post = $this->getRequest()->getPost();
	$outlineId = $post['id'];
	$key = $post['key'];	
	$test['id']=$outlineId;
	$test['key']=$key;
	$variables = array("status" => "200",'result'=>'test','id'=>$outlineId,'key'=>$key);
	$em = $this->getEntityManager();
	$outline = $em->getRepository('Application\Entity\OutlineEntry')->find($key);
	$em->remove($outline);
	$em->flush();
        $response = $this->getResponse();
        $response->setStatusCode(200);
        $response->setContent(json_encode($test));
	return $response;
    }
    public function saveAction()
    {
	$post = $this->getRequest()->getPost();
	$outlineId = $post['id'];
	$key = $post['key'];	
	$title = $post['title'];
	$description = $post['description'];
	$test['id']=$outlineId;
	$test['key']=$key;
	
	$variables = array("status" => "200",'result'=>'test','id'=>$outlineId,'key'=>$key,'title'=>$title,'description'=>$description);
	$em = $this->getEntityManager();
	$outline = $em->getRepository('Application\Entity\OutlineEntry')->find($key);
	$outline->setTitle($title);
	$outline->setDescription($description);
	$em->persist($outline);
	$em->flush();
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
    		'edit'      => __DIR__ . '/../../../view/application/outline/edit.phtml',
	));
	$stack = new Resolver\TemplatePathStack(array(
    		'script_paths' => array(
        	__DIR__ . '/view',
    		)
	));

	$resolver->attach($map);
	$resolver->attach($stack);

	$outlineid = $this->params()->fromRoute('item');
	//$outlineid = $this->params()->fromQuery('id');
	// Looking for: outline- or 8 chars

	$theArray = array('id' => $outlineid);

	$em = $this->getEntityManager();
	$outline = $em->getRepository('Application\Entity\Outline')->findOneBy($theArray);
	$actualWords = $outline->getDescription();
	$theWords = $outline->getDescription();
	$title = $outline->getTitle();
		
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
    		'edit'      => __DIR__ . '/../../../view/application/outline/edit.phtml',
	));
	$stack = new Resolver\TemplatePathStack(array(
    		'script_paths' => array(
        	__DIR__ . '/view',
    		)
	));

	$resolver->attach($map);
	$resolver->attach($stack);

	$outlineid = $this->params()->fromRoute('item');
	//$outlineid = $this->params()->fromQuery('id');
	// Looking for: outline- or 8 chars
	$viewModel->setVariable('theid',$outlineid);

	$theArray = array('id' => $outlineid);

	$em = $this->getEntityManager();
	$outline = $em->getRepository('Application\Entity\Outline')->findOneBy($theArray);
	$actualWords = $outline->getDescription();
	$viewModel->setVariable('content',$actualWords);
	$viewModel->setVariable('id',$theId);

	//$responseHTML = "<textarea>" . $actualWords . "</textarea>";

	$outlineResponse = $renderer->render($viewModel);

	$variables = array("id" => $outlineid,"view" => $outlineResponse);
	$jsonModel = new JsonModel($variables);
        $response = $this->getResponse();
        $response->setStatusCode(200);
        $response->setContent(json_encode($variables));
	return $response;
    }
}
