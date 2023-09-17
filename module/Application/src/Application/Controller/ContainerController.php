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

use Application\Model\Containers as Containers;
use Application\Entity\Container as ContainerObject;
use Application\Entity\Wordage as Wordage;


use Application\Model\ContainerItems as ContainerItems;
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

use Application\View\Helper\PictureHelper as PictureHelper;
use Application\View\Helper\FileHelper as FileHelper;
use Application\View\Helper\CodeHelper as CodeHelper;
use Application\View\Helper\ExperienceHelper as ExperienceHelper;

use Application\View\Helper\HeadlineHelper as HeadlineHelper;

use Application\View\Helper\Toolbar as Toolbar;


use Application\View\Helper\ContainerHelper as ContainerHelper;

class ContainerController extends AbstractActionController
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
    public function oldAction()
    {
	$view = new ViewModel();

	$this->log = $this->getServiceLocator()->get('log');
        $log = $this->log;
    	$userSession = new Container('user');
	$this->username = $userSession->username;
	$loggedIn = $userSession->loggedin;
	if ($loggedIn)
	{
		// Set the Helpers
		$layout = $this->layout();
		foreach($layout->getVariables() as $child)
		{
			$child->setLoggedIn($loggedIn);
			$child->setUserName($this->username);
			}
	}
	else
	{
	       return $this->redirect()->toUrl('https://www.evtechnote.us/');
	}

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


        $repository = $em->getRepository('Application\Entity\Container');
	$theItems = $repository->findAll();
	$numItems = count($theItems);
	$i = 0;

		$theObject = $theItems[$i];

		$containerItem = new ContainerHelper();
		$containerItem->setEntityManager($em);
		$containerItem->setServiceLocator($this->getServiceLocator());
		$containerItem->setViewModel($view);
		$containerItem->setContainerObject($theObject);
		$html .= $containerItem->toHTML();

	$html .= "<br/>";
	$html .= $numItems;
	$html .= "<br/>";
	$view->content = $html;

        return $view;
    }
    public function listAction()
    {
	$view = new ViewModel();

	$this->log = $this->getServiceLocator()->get('log');
        $log = $this->log;
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
	       return $this->redirect()->toUrl('https://www.evtechnote.us/');
	}

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


        $repository = $em->getRepository('Application\Entity\Container');
	$theItems = $repository->findAll();
	$numItems = count($theItems);
	$i = 0;
	while ($i < $numItems)
	{
		$theObject = $theItems[$i];
		$title = $theObject->getTitle();
		$id = $theObject->getId();
		$containerItem = new ContainerHelper();
		$containerItem->setEntityManager($em);
		$containerItem->setServiceLocator($this->getServiceLocator());
		$containerItem->setViewModel($view);
		$containerItem->setContainerObject($theObject);
		$html .= $id;
		$html .= "&nbsp;-&nbsp;";
		$html .= $title;
		$html .= "&nbsp;-Edit:&nbsp;";
		$html .= "<a href='";
		$html .= "https://www.evtechnote.us/container/edit?id=";
		$html .= trim($id);
		$html .= "'>Edit</a>";
		$html .= "<br/>";
		$i++;
	}
	$html .= "<br/>";
	$view->content = $html;

        return $view;
    }
    public function editAction()
    {
	$view = new ViewModel();

	$this->log = $this->getServiceLocator()->get('log');
        $log = $this->log;
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
	       return $this->redirect()->toUrl('https://www.evtechnote.us/');
	}

        $em = $this->getEntityManager();

	$editId = $this->params()->fromQuery('id');

        $em = $this->getEntityManager();

	$criteria = array('id' => $editId);

        $repository = $em->getRepository('Application\Entity\Container');
	$theItems = $repository->findBy($criteria);
	$numItems = count($theItems);
	$i = 0;
	$html = "Start of Container";
	$html .= "<br/>";
	while ($i < $numItems)
	{
		$theObject = $theItems[$i];
		$title = $theObject->getTitle();
		$id = $theObject->getId();
		$containerItem = new ContainerHelper();
		$containerItem->setEntityManager($em);
		$containerItem->setServiceLocator($this->getServiceLocator());
		$containerItem->setViewModel($view);
		$containerItem->setContainerObject($theObject);
		$html .= $id;
		$html .= "&nbsp;-&nbsp;";
		$html .= $title;
		$html .= "<br/>";
		$i++;
		/* Now get the Items */
		$containerId = $id;
		$criteria = Array();
		$criteria["containerid"] = $containerId;
		$items = $em->getRepository('Application\Entity\ContainerItems')->findBy($criteria);
		$this->items= Array();

		$html .= "<br/>";
		foreach ($items as $item)
		{
			$this->items["type"] = "ContainerItem";
			$html .= "Container Item:";
			$html .= "<br/>";
			$this->items["object"] = $item;
			$itemid = $item->getItemId();
			$itemtype = $item->getItemType();
			//$itemid = $item->itemid;
			//$itemtype = $item->itemtype;
			$html .= "ItemId:&nbsp;";
			$html .= $itemid;
			$html .= "&nbsp;-&nbsp;";
			$html .= "ItemType:&nbsp;";
			$html .= $itemtype;
			$html .= "&nbsp;";
			$html .= "<a href='";
			$html .= "https://www.evtechnote.us/";
			$html .= $itemtype;
			$html .= "/view/";
			$html .= trim($itemid);
			$html .= "'>View</a>";
			$html .= "<br/>";
		}
	}
	$html .= "<br/>";
	$view->content = $html;

        return $view;
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
	$containers = $em->getRepository('Application\Entity\Container')->findAll();

	$container_items = Array();

	foreach ($containers as $key => $container)
	{
		$container_item = Array();
		$id = $container->getId();
		$title = $container->getTitle();
		$type = $container->getContainerType();
		$description = $container->getDescription();
		$container_item[] = $id;
		$container_item[] = $title;
		$container_item[] = $type;
		$container_item[] = $description;
		$container_items[] = $container_item;
	}
	$html = "<div class='item_table'>";
	$html .=  "<ul class='item_row'>";
	$html .= "<li class='item_id_col'>";
	$html .= "Id";
	$html .= "</li>";
	$html .= "<li class='item_title_col'>";
	$html .= "Title";
	$html .= "</li>";
	$html .= "<li class='item_type_col'>";
	$html .= "Type";
	$html .= "</li>";
	$html .= "<li class='item_description_col'>";
	$html .= "Description";
	$html .= "</li>";
	$html .= "</ul>";
	$html .= "<br/>";

	foreach ($container_items as $key => $item)
	{
		$id = $item[0];
		$title = strip_tags($item[1]);
		$type = strip_tags($item[2]);
		$description = strip_tags($item[3]);
		$html .= "<ul class='item_row'>";	
		$html .= "<li class='item_id_col'>";
		$html .= $id;
		$html .= "</li>";
		$html .= "<li class='item_title_col'>";
		$html .= $title;
		$html .= "</li>";
		$html .= "<li class='item_type_col'>";
		$html .= $type;
		$html .= "</li>";
		$html .= "<li class='item_description_col'>";
		$html .= $description;
		$html .= "</li>";
		$html .= "</ul>";
		$html .= "<br/>";


		//  Given the Container's Id, fetch the Container Items.
		$params = Array();
		$params['containerid'] = $id;
		$containerItems = $em->getRepository('Application\Entity\ContainerItems')->findBy($params);


		$containerHtml = "<div class='subitem_table'>";
		$containerHtml .= "<ul class='subitem_row'>";
		$containerHtml .= "<li class='subitem_id_col'>";
		$containerHtml .= "id";
		$containerHtml .= "</li>";
		$containerHtml .= "<li class='subitem_id_col'>";
		$containerHtml .= "order";
		$containerHtml .= "</li>";
		$containerHtml .= "<li class='subitem_id_col'>";
		$containerHtml .= "container_id";
		$containerHtml .= "</li>";
		$containerHtml .= "<li class='subitem_id_col'>";
		$containerHtml .= "itemid";
		$containerHtml .= "</li>";
		$containerHtml .= "<li class='subitem_type_col'>";
		$containerHtml .= "itemtype";
		$containerHtml .= "</li>";
		$containerHtml .= "</ul>";
		$containerHtml .= "<br/>";
		foreach ($containerItems as $key => $containerItem)
		{
			$containerItem_id = $containerItem->getId();
			$containerItem_containerid = $containerItem->getContainerId();
			$containerItem_order = $containerItem->getContainerOrder();
			$containerItem_itemid = $containerItem->getItemId();
			$containerItem_itemtype = $containerItem->getItemType();
			$containerHtml .= "<ul class='subitem_row'>";
			$containerHtml .= "<li class='subitem_id_col'>";
			$containerHtml .= $containerItem_id;
			$containerHtml .= "</li>";
			$containerHtml .= "<li class='subitem_id_col'>";
			$containerHtml .= $containerItem_order;
			$containerHtml .= "</li>";
			$containerHtml .= "<li class='subitem_id_col'>";
			$containerHtml .= $containerItem_containerid;
			$containerHtml .= "</li>";
			$containerHtml .= "<li class='subitem_id_col'><a href='/";
			$containerHtml .= $containerItem_itemtype;
			$containerHtml .= "/edit?id=" . $containerItem_itemid . "&from=container'>"; 
			$containerHtml .= $containerItem_itemid;
			$containerHtml .= "</a></li>";
			$containerHtml .= "<li class='subitem_type_col'>";
			$containerHtml .= $containerItem_itemtype;
			$containerHtml .= "</li>";
			$containerHtml .= "</ul>";
			$containerHtml .= "<br/>";
		}
		$containerHtml .= "</div>";
		$html .= $containerHtml;
		$html .= "</div>";

	}
	$html .= "</div>";

	$view->content = $html;

	return $view;
    }
    public function oldindexAction()
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
    
        $em = $this->getEntityManager();

	$new = $this->params()->fromQuery('new');

	if (!is_null($new))
	{
		if ($new == "container")
		{
			$newContainer = new Containers();
			$newContainer->setTitle("new");
			$em->persist($newContainer);
			$em->flush();

			return $this->redirect()->toRoute('container');
		}
	}

	// This second layout look really should happen if logged in.
	//$layout->setTemplate('layout/correspondant');

	$items = new Containers();
	$items->setEntityManager($em);
	$items->loadDataSource();
		
	$view = new ViewModel();
		
	$itemArray = Array();
	foreach ($items->toArray() as $num => $item)
	{
		//$log->info(print_r($item,true));
		if ($item["type"] == "Container")
		{
			//log->info("process Container Item");
			$containerObject = $item["object"];
			//$log->info(print_r($containerObject,true));
			$id = $containerObject->getId();
			$username = $containerObject->getUsername();
			$original = $containerObject->getOriginalDate();
			$title = $containerObject->getTitle();
			$background = $containerObject->getBackground();
			$frame = $containerObject->getFrame();
			$backgroundWidth = $containerObject->getBackgroundWidth();
			$backgroundHeight = $containerObject->getBackgroundHeight();
/*
			$itemArray["id"] = $id;
			$itemArray["username"] = $username;
			$itemArray["original"] = $original;
			$itemArray["title"] = $title;
			$itemArray["background"] = $background;
			$itemArray["backgroundWidth"] = $backgroundWidth;
			$itemArray["backgroundHeight"] = $backgroundHeight;
			$itemArray["frame"] = $frame;
*/
			$bcolor = '#bb22bb';
			$view = new ViewModel(array('id' => $id,
				'username' => $username,
				'original' => $original,
				'title' => $title,
				'background' => $background,
				'backgroundWidth' => $backgroundWidth,
				'backgroundHeight' => $backgroundHeight,
				'frame' => $frame
			));
			$containerItem = new ContainerHelper();
			$containerItem->setServiceLocator($this->getServiceLocator());
			$containerItem->setViewModel($view);
			$containerItem->setContainerObject($item["object"]);
			$itemArray[] = $containerItem;
		}
/*
		if ($item["type"] == "Wordage")
		{
			$wordageObject = $item["object"];
			$wordage = $wordageObject->getWordage();
			$id = $wordageObject->getId();
			$original = $wordageObject->getOriginal();
			$title = $wordageObject->getTitle();
			$username = $wordageObject->getUsername();
			$bcolor = '#ff22bb';
			$view = new ViewModel(array('wordage' => $wordage,
				'id' => $id,
				'original' => $original,
				'title' => $title,
				'username' => $username,
				'bcolor' => $bcolor
			));
			$wordageItem = new WordageHelper();
			$wordageItem->setServiceLocator($this->getServiceLocator());
			$wordageItem->setViewModel($view);
			$wordageItem->setWordageObject($item["object"]);
			$itemArray[] = $wordageItem;
		}
		else 
		{
			$pictureObject = $item["object"];
			$picture = $pictureObject->getPicture();
			$id = $pictureObject->getId();
			$original = $pictureObject->getOriginal();
			$caption = $pictureObject->getCaption();
			$username = $pictureObject->getUsername();
			$bcolor = '#00bbbb';
			$view = new ViewModel(array('picture' => $picture,
				'id' => $id,
				'original' => $original,
				'caption' => $caption,
				'username' => $username,
				'bcolor' => $bcolor
			));
			$pictureItem = new PictureHelper();
			$pictureItem->setServiceLocator($this->getServiceLocator());
			$pictureItem->setViewModel($view);
			$pictureItem->setPictureObject($item["object"]);
			$itemArray[] = $pictureItem;
		}		
*/
	}
	$view->items = $itemArray;

	

        return $view;
    }
    public function viewAction()
    {
	$view = new ViewModel();

	$this->log = $this->getServiceLocator()->get('log');
        $log = $this->log;
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
	       return $this->redirect()->toUrl('https://www.evtechnote.us/');
	}

        $em = $this->getEntityManager();

	$viewId = $this->params()->fromQuery('id');

        $em = $this->getEntityManager();

	$containerItems = new ContainerItems();
	$containerItems->setContainerId($viewId);
	$containerItems->setEntityManager($em);
	$containerItems->loadDataSource();
		
	$view = new ViewModel();

	
	foreach ($containerItems->toArray() as $num => $item)
	{
		$html .= print_r($item,true);
	}
		
	$html .= "<br/>";

	$view->content = $html;

        return $view;
    }
}
