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
use Application\Entity\Headline;
use Hex\View\Helper\CustomHelper;
use Doctrine\ORM\EntityManager;
use Application\Form\Entity\HeadlineForm;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterInterface;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\Session\Container;
use Zend\View\Renderer\PhpRenderer;
use Zend\View\Resolver;

class HeadlineController extends AbstractActionController
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
	       	return $this->redirect()->toUrl($rooturl);
	}

	/* See that! */
        $em = $this->getEntityManager();
	$headlines = $em->getRepository('Application\Entity\Headline')->findAll();

	$headline_items = Array();

	foreach ($headlines as $key => $headline)
	{
		$headline_item = Array();
		$id = $headline->getId();
		$headline_text  = $headline->getHeadline();
		$binder_id = $headline->getBinderId();
		$headline_item[] = $id;
		$headline_item[] = $binder_id;
		$headline_item[] = $headline_text;
		$headline_items[] = $headline_item;
	}
	$html = "<div class='headline_table'>";
	$html .=  "<ul class='headline_row'>";
	$html .= "<li class='headline_id_col'>";
	$html .= "Id";
	$html .= "</li>";
	$html .= "<li class='headline_binder_id_col'>";
	$html .= "Binder Id"; 
	$html .= "</li>";
	$html .= "<li class='headline_text_col'>";
	$html .= "Headline";
	$html .= "</li>";
	$html .= "</ul>";
	$html .= "<br/>";
	foreach ($headline_items as $key => $item)
	{
		$id = $item[0];
		$binder_id = $item[1];
		$headline_text = strip_tags($item[2]);
		$html .= "<ul class='headline_row'>";	
		$html .= "<li class='headline_id_col'>";
		$html .= $id;
		$html .= "</li>";
		$html .= "<li class='headline_binder_id_col'>";
		$html .= $binder_id;
		$html .= "</li >";
		$html .= "<li class='headline_text_col'>";
		$html .= substr($headline_text,0,40);
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

	// Retrieve Custom Config
	$config = $this->getServiceLocator()->get('config');
	$settings = $config['settings'];
	$SITEROOT = $settings['SITE_ROOT'];
	$rooturl = 'https://' . $SITEROOT . '/';

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
	       	return $this->redirect()->toUrl($rooturl);
	}
		
	$em = $this->getEntityManager()	;
	$headline = $em->getRepository('Application\Entity\Headline')->find($id);
	$em->remove($headline);
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
	       return $this->redirect()->toUrl($rooturl);
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
	       		return $this->redirect()->toUrl($rooturl);
		}
		
		$em = $this->getEntityManager()	;
		$headline = $em->getRepository('Application\Entity\Headline')->find($id);
		
		$headline_text = $headline->getHeadline();
		$fontsize = $headline->getFontsize();
		$fontstyle = $headline->getFontstyle();
		$fontfamily = $headline->getFontfamily();
		
		$view->headline = $headline_text;
		$view->fontsize = $fontsize;
		$view->fontstyle = $fontstyle;
		$view->fontfamily = $fontfamily;
		$view->id =$id;
	return $view;
    }
    public function headlineAction()
    {

	// Retrieve Custom Config
	$config = $this->getServiceLocator()->get('config');
	$settings = $config['settings'];
	$SITEROOT = $settings['SITE_ROOT'];
	$rooturl = 'https://' . $SITEROOT . '/';

	$view = new ViewModel();
        $view->content = $this->content();
        return $view;
    }
    public function changeAction()
    {

	// Retrieve Custom Config
	$config = $this->getServiceLocator()->get('config');
	$settings = $config['settings'];
	$SITEROOT = $settings['SITE_ROOT'];
	$rooturl = 'https://' . $SITEROOT . '/';

	$changedtext = $this->params()->fromPost('thetext');

	$id = $this->params()->fromRoute('item');
	//$theId = substr($headlineid,strpos('headline-',$headlineid)+8,strlen($headlineid));
	$theArray = array('id' => $id);

	$em = $this->getEntityManager();
	$headline = $em->getRepository('Application\Entity\Headline')->findOneBy($theArray);

	$headline->setHeadline($changedtext);
	$em->persist($headline);
	$em->flush();

	$variables = array("status" => "200",'id'=>$theId,'headline'=>print_r($headline,true));
        $response = $this->getResponse();
        $response->setStatusCode(200);
        $response->setContent(json_encode($variables));
	return $response;
    }
    public function saveAction()
    {

	// Retrieve Custom Config
	$config = $this->getServiceLocator()->get('config');
	$settings = $config['settings'];
	$SITEROOT = $settings['SITE_ROOT'];
	$rooturl = 'https://' . $SITEROOT . '/';

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
	       return $this->redirect()->toUrl($rooturl);
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
		$from = "headline";
	}

	$headline_text= $this->getRequest()->getPost('headline',null);

	$view->headline = $headline_text;

	$em = $this->getEntityManager();
	$headline = $em->getRepository('Application\Entity\Headline')->find($id);
		
	$headline->setHeadline($headline_text);
	$em->persist($headline);
	$em->flush();
		
	$view->content = $headline_text;
	$view->id =$id;
	
	if (0 == strcmp($from,"correspondant"))
	{
	   return $this->redirect()->toUrl('/correspondant/index');
	}
	else if (0 == strcmp($from,"headline"))
	{
	   return $this->redirect()->toUrl('/headline/index');
	}
	else
	{
		return $view;
	}
    }
    public function editAction()
    {
	
	// Retrieve Custom Config
	$config = $this->getServiceLocator()->get('config');
	$settings = $config['settings'];
	$SITEROOT = $settings['SITE_ROOT'];
	$rooturl = 'https://' . $SITEROOT . '/';

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
	       return $this->redirect()->toUrl($rooturl);
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
		$from = "headline";
	}

	$em = $this->getEntityManager();
	$headline = $em->getRepository('Application\Entity\Headline')->find($id);
	$headline_text = $headline->getHeadline();
	$fontsize = $headline->getFontsize();
	$fontstyle = $headline->getFontstyle();
	$fontfamily = $headline->getFontfamily();
		
	$view->headline = $headline_text;
	$view->fontsize = $fontsize;
	$view->fontstyle = $fontstyle;
	$view->fontfamily = $fontfamily;
	$view->id =$id;

	$theWords = $headline->getHeadline();
		
	$view->content = $theWords;
	$view->id =$id;
	$view->from = $from;
	return $view;
    }
    public function jsonAction()
    {

	// Retrieve Custom Config
	$config = $this->getServiceLocator()->get('config');
	$settings = $config['settings'];
	$SITEROOT = $settings['SITE_ROOT'];
	$rooturl = 'https://' . $SITEROOT . '/';

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
	       return $this->redirect()->toUrl($rooturl);
	}
	// Initiadivze the View
    	$view = new ViewModel();
	// Retreive the parameters

	$headlineid = $this->params()->fromQuery("id");

	if (is_null($headlineid))
	{
		$headlineid = 22;
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
	       		return $this->redirect()->toUrl($rooturl);
		}


	$id = $this->params()->fromQuery("id");

	if (is_null($id))
	{
		$id = 22;
	}
		

		$em = $this->getEntityManager()	;
		$headline = $em->getRepository('Application\Entity\Headline')->find($id);
		
	$headline_text = $headline->getHeadline();
	$fontsize = $headline->getFontsize();
	$fontstyle = $headline->getFontstyle();
	$fontfamily = $headline->getFontfamily();

		
	$variables = array("id" => $headlineid,"view" => $headline_text,"fontsize" => $fontsize,"fontstyle" => $fontstyle,"fontfamily" => $fontfamily);
	$jsonModel = new JsonModel($variables);
        $response = $this->getResponse();
        $response->setStatusCode(200);
        $response->setContent(json_encode($variables));
	return $response;
    }
}
