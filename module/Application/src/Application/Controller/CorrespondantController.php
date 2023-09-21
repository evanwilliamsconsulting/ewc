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

use Doctrine\ORM\EntityManager;
use Application\Form\Entity\CorrespondantForm;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterInterface;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\Session\Container;
use Zend\Stdlib\ArrayObject as ArrayObject;

use Application\Model\Items as Items;
use Application\Entity\Wordage as Wordage;
use Application\Entity\Outline as Outline;
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

use Application\View\Helper\OutlineHelper as OutlineHelper;
use Application\Service\OutlineService as OutlineService;

use Application\View\Helper\PictureHelper as PictureHelper;
use Application\View\Helper\FileHelper as FileHelper;
use Application\View\Helper\CodeHelper as CodeHelper;
use Application\View\Helper\BaseHelper as BaseHelper;
use Application\View\Helper\ExperienceHelper as ExperienceHelper;

use Application\View\Helper\HeadlineHelper as HeadlineHelper;

use Application\View\Helper\Toolbar as Toolbar;
use Application\View\Helper\Binder as Binder;


use Application\Model\Containers as Containers;
use Application\Entity\Container as ContainerObject;
use Application\View\Helper\ContainerHelper as ContainerHelper;

class CorrespondantController extends AbstractActionController
{
    protected $em;
    protected $authservice;
    protected $username;
    protected $log;
    protected $obj;

    public function __construct()
    {
    }
    public function getEntityManager()
    {
        if (null == $this->em)
        {
	    try {
            	$this->em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');
                //$this->em = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
            } catch (Exception $e) {
		//print_r($e);
		//print_r($e-getPrevious());
	    }
	}
	return $this->em;
    }
    public function containerAction()
    {
	// Retrieve Custom Config
	$config = $this->getServiceLocator()->get('config');
	$settings = $config['settings'];
	$SITEROOT = $settings['SITE_ROOT'];
	$rooturl = 'https://' . $SITEROOT . '/';

	$this->log = $this->getServiceLocator()->get('log');
        $log = $this->log;
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
			$child->setUserName($this->username);
			}
	}
	else
	{
	       return $this->redirect()->toUrl($rooturl);
	}
/*
        $em = $this->getEntityManager();

	$new = $this->params()->fromQuery('new');

	if (!is_null($new))
	{
		if ($new == "container")
		{
			$newContainer = new Bag();
			$newContainer->setTitle("new");
			$newContainer->setContainerType("container");
			$newContainer->setUsername("evanwill");
			$newContainer->setBackgroundWidth(600);
			$newContainer->setBackgroundHeight(400);
			$em->persist($newContainer);
			$em->flush();

			return $this->redirect()->toRoute('correspondant');
		}
		else if ($new == "schematic")
                {
			$newContainer = new Schematic();
			$newContainer->setTitle("new");
			$newContainer->setContainerType("schematic");
			$newContainer->setUsername("evanwill");
			$newContainer->setBackgroundWidth(600);
			$newContainer->setBackgroundHeight(400);
			$em->persist($newContainer);
			$em->flush();

			return $this->redirect()->toRoute('correspondant');
		}
		else if ($new == "lesson")
                {
			$newContainer = new Lesson();
			$newContainer->setTitle("new");
			$newContainer->setContainerType("lesson");
			$newContainer->setUsername("evanwill");
			$newContainer->setBackgroundWidth(600);
			$newContainer->setBackgroundHeight(400);
			$em->persist($newContainer);
			$em->flush();

			return $this->redirect()->toRoute('correspondant');
		}
		else if ($new == "graphic")
                {
			$newContainer = new Graphic();
			$newContainer->setTitle("new");
			$newContainer->setContainerType("graphic");
			$newContainer->setUsername("evanwill");
			$newContainer->setBackgroundWidth(600);
			$newContainer->setBackgroundHeight(400);
			$em->persist($newContainer);
			$em->flush();
		}
        }
    
        $em = $this->getEntityManager();

	$view = new ViewModel();
		
	$itemArray = Array();
	foreach ($items->toArray() as $num => $item)
	{
		if ($item["type"] == "Container")
		{
			$containerObject = $item["object"];
			$id = $containerObject->getId();
			$username = $containerObject->getUsername();
			$original = $containerObject->getOriginalDate();
			$title = $containerObject->getTitle();
			$background = $containerObject->getBackground();
			$frame = $containerObject->getFrame();
			$backgroundWidth = $containerObject->getBackgroundWidth();
			$backgroundHeight = $containerObject->getBackgroundHeight();
			$bcolor = '#bb22bb';

			$view = new ViewModel(array('id' => $id,
				'username' => $username,
				'original' => $original,
				'title' => $title,
				'background' => $background,
				'backgroundWidth' => $backgroundWidth,
				'backgroundHeight' => $backgroundHeight,
				'frame' => $frame,
			));

			$containerItem = new ContainerHelper();
			$containerItem->setServiceLocator($this->getServiceLocator());
			$containerItem->setViewModel($view);
			$containerItem->setEntityManager($em);
			$containerItem->setContainerObject($containerObject);
			$itemArray[] = $containerItem;
		}
	}
	$view->items = $itemArray;


	$toolbar = new Toolbar();
	$toolbar->setContext("containers");
	$view->toolbar = $toolbar;	
	$view->items = $itemArray;

*/
        return $view;
    }
    public function indexAction()
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
	       return $this->redirect()->toUrl('https://www.evanwilliamsconsulting.com/');
	}
	$binder = $this->params()->fromQuery("binder");

	if (is_null($binder))
	{
		$binder_id = 1;
	}
	else
	{
		$binder_id = $binder;
	}

	/* Here is an example for you!

	The id for the binder object and database table is the primary id,
	So it is called just 'id'.  Everywhere else, that is, in every
	Other table where the binder_id is used it is called 'binder_id',
	Because it is not the native key to the table (so far that is!)

	So as a result we have the confusing code below!!!
	2DO: Maybe we should use composite keys rather than autonumbers!!!

	*/

	$criteria = array("binder_id" => $binder_id);
	$binderCriteria = array("id" => $binder_id);

	/* See that! */
        $em = $this->getEntityManager();
	$binder= $em->getRepository('Application\Entity\Binder')->findBy($binderCriteria);
	$binders = $em->getRepository('Application\Entity\Binder')->findAll();

	$itemArray = array();
	$view = new ViewModel();
	$ENTITY_ROOT = "Application\\Entity\\";

	$types = array("Wordage","Picture","Experience","File","CodeBase","CodeSample","Outline");

	foreach ($types as $key => $type)
	{	
		$entity = $ENTITY_ROOT . $type;
		$items = $em->getRepository($entity)->findBy($criteria);
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
	$binderItem = $binder[0];

	$binderName = $binderItem->getTitle();
	$binderCount = count($binders);

	$binder2 = new Binder();
	$binder2->setBinderId($binder_id);
	$binder2->setBinderCount($binderCount);
	$binder2->setBinderName($binderName);

	$view->binder = $binder2;

	$view->items = $itemArray;
	return $view;
    }
    public function addAction()
    {

	// Retrieve Custom Config
	$config = $this->getServiceLocator()->get('config');
	$settings = $config['settings'];
	$SITEROOT = $settings['SITE_ROOT'];
	$rooturl = 'https://' . $SITEROOT . '/';

	$view = new ViewModel();

	$this->log = $this->getServiceLocator()->get('log');
        $log = $this->log;
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
			$child->setUserName($this->username);
			}
	}
	else
	{
	       return $this->redirect()->toUrl($rooturl);
	}

        $em = $this->getEntityManager();
	$type = $this->params()->fromQuery("type");
	if (0==strcmp($type,"Wordage"))
        {
		$newContent = new Wordage();
		$newContent->setTitle("new");
                $newContent->setUsername("ewilliams");
		$newContent->setColumnsize(40);
		$newContent->setBinderId(1);
                $em->persist($newContent);
                $em->flush();
		$uri = $rooturl . 'wordage/index';
		return $this->redirect()->toUrl($uri);
        }
	else if (0==strcmp($type,"Outline"))
	{
		$newContent = new Outline();
		$newContent->setTitle("outline1");
                $newContent->setUsername("ewilliams");
		$newContent->setDescription("test");
		$newContent->setBinderId(1);
                $em->persist($newContent);
                $em->flush();
	}
	else if (0==strcmp($type,"Picture"))
        {
		$newContent = new Picture();
		$newContent->setTitle("picture1");
		$newContent->setCredit("EJW");
		$newContent->setWidth(300);
		$newContent->setHeight(300);
                $newContent->setUsername("ewilliams");
		$newContent->setCaption("test");
		$newContent->setBinderId(1);
                $em->persist($newContent);
                $em->flush();
        }
	return $view;
    }
}
