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

use Application\Entity\Picture;
use Hex\View\Helper\CustomHelper;
use Doctrine\ORM\EntityManager;

use Application\Form\Entity\PictureForm;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterInterface;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\Session\Container;
use Zend\View\Renderer\PhpRenderer;
use Zend\View\Resolver;

class PictureController extends AbstractActionController
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
	$pictures = $em->getRepository('Application\Entity\Picture')->findAll();

	$picture_items = Array();

	foreach ($pictures as $key => $picture)
	{
		$picture_item = Array();
		$id = $picture->getId();
		$picture_text  = $picture->getPicture();
		$binder_id = $picture->getBinderId();
		$title = $picture->getTitle();
		$picture_item[] = $id;
		$picture_item[] = $binder_id;
		$picture_item[] = $title;
		$picture_item[] = $picture_text;
		$picture_items[] = $picture_item;
	}
	$html = "<div class='picture_table'>";
	$html .=  "<ul class='picture_row'>";
	$html .= "<li class='picture_id_col'>";
	$html .= "Id";
	$html .= "</li>";
	$html .= "<li class='picture_binder_id_col'>";
	$html .= "Binder Id"; 
	$html .= "</li>";
	$html .= "<li class='picture_title_col'>";
	$html .= "Title";
	$html .= "</li>";
	$html .= "<li class='picture_text_col'>";
	$html .= "Wordage";
	$html .= "</li>";
	$html .= "</ul>";
	$html .= "<br/>";
	foreach ($picture_items as $key => $item)
	{
		$id = $item[0];
		$binder_id = $item[1];
		$title = strip_tags($item[2]);
		$picture_text = strip_tags($item[3]);
		$html .= "<ul class='picture_row'>";	
		$html .= "<li class='picture_id_col'>";
		$html .= $id;
		$html .= "</li>";
		$html .= "<li class='picture_binder_id_col'>";
		$html .= $binder_id;
		$html .= "</li >";
		$html .= "<li class='picture_title_col'>";
		$html .= $title;
		$html .= "</li>";
		$html .= "<li class='picture_text_col'>";
		$html .= substr($picture_text,0,40);
		$html .= "</li >";
		$html .= "</ul>";
		$html .= "<br/>";
	}
	$html .= "</div>";

	$view->content = $html;

	return $view;
    }

    public function viewAction()
    {
	// Retrieve Custom Config
	$config = $this->getServiceLocator()->get('config');
	$settings = $config['settings'];
	$SITEROOT = $settings['SITE_ROOT'];
	$rooturl = 'https://' . $SITEROOT . '/';

	$userSession = new Container('user');
	$this->username = $userSession->username;
	$loggedIn = $userSession->loggedin;

	if ($loggedIn)
	{
		// Set the helpers
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

	// Retrieve the Parameters
	$id = $this->params()->fromQuery('id');

	if (is_null($id))
	{
		$id = 1;
	}
		
	$em = $this->getEntityManager();
	
	$picture = $em->getRepository('Application\Entity\Picture')->find($id);

	$thePicture = $picture->getPicture();
	$title = $picture->getTitle();
	$caption = $picture->getCaption();
	$width = $picture->getWidth();
	$height = $picture->getHeight();	
	$credit = $picture->getCredit();
	$subfolder = $picture->getSubfolder();

	$view->title = $title;
	$pictureRelativeURI = '/images/';
	if (!is_null($subfolder))
	{
	    $pictureRelativeURI .= $subfolder;
	    $pictureRelativeURI .= '/';
	}
	$pictureRelativeURI .= $thePicture;
	$view->picture = $pictureRelativeURI;
	$view->caption = $caption;
	$view->id =$id;
	$view->width = $width;
	$view->height = $height;
	$view->credit = $credit;
	$view->subfolder = $subfolder;

        return $view;
    }
    public function content()
    {
	return "content";
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

	$wordageid = $this->params()->fromPost('id');
	$theId = substr($wordageid,strpos('wordage-',$wordageid)+8,strlen($wordageid));
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
	// Retrieve Custom Config
	$config = $this->getServiceLocator()->get('config');
	$settings = $config['settings'];
	$SITEROOT = $settings['SITE_ROOT'];
	$rooturl = 'https://' . $SITEROOT . '/';

	$userSession = new Container('user');
	$this->username = $userSession->username;
	$loggedIn = $userSession->loggedin;

	if ($loggedIn)
	{
		// Set the helpers
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

	// Retrieve the Parameters
	$id = $this->params()->fromQuery('id');

	if (is_null($id))
	{
		$id = 1;
	}
		
	$em = $this->getEntityManager();
	
	$picture = $em->getRepository('Application\Entity\Picture')->find($id);

	$thePicture = $picture->getPicture();
	$title = $picture->getTitle();
	$caption = $picture->getCaption();
	$width = $picture->getWidth();
	$height = $picture->getHeight();	
	$credit = $picture->getCredit();
	$subfolder = $picture->getSubfolder();

	$view->title = $title;
	$pictureRelativeURI = '/images/';
	if (!is_null($subfolder))
	{
	    $pictureRelativeURI .= $subfolder;
	    $pictureRelativeURI .= '/';
	}
	$pictureRelativeURI .= $thePicture;
	$view->picture = $pictureRelativeURI;
	$view->caption = $caption;
	$view->id =$id;
	$view->width = $width;
	$view->height = $height;
	$view->credit = $credit;
	$view->subfolder = $subfolder;
	$view->resize_width = $width;
	$view->resize_height = $height;

        return $view;
    }
    public function resizeAction()
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
		$from = "picture";
	}

	$resize_width = $this->getRequest()->getPost('picture_width',null);
	$resize_height = $this->getRequest()->getPost('picture_height',null);

	$em = $this->getEntityManager();
	$theArray = array('id' => $id );
	$picture = $em->getRepository('Application\Entity\Picture')->findOneBy($theArray);
		
	$picture->setWidth($resize_width);
	$picture->setHeight($resize_height);
	$em->persist($picture);
	$em->flush();
		
	$view->id =$id;
	
	if (0 == strcmp($from,"correspondant"))
	{
	   return $this->redirect()->toUrl('/correspondant/index');
	}
	else if (0 == strcmp($from,"picture"))
	{
	   return $this->redirect()->toUrl('/picture/index');
	}
	else
	{
		return $view;
	}
    }
}
