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
use Hex\View\Helper\CustomHelper;
use Application\Form\Panel\LoginForm;
use Zend\EventManager\EventManger;
use Publish\BlockHelper as BlockHelper;
use Publish\Block\Broadsheet;

use Application\Entity\Items as Items; 
use Application\Entity\Content as Content; 
use Application\Entity\Container as Container;
use Application\Model\ContainerItems as ContainerItems;
use Application\View\Helper\ContainerHelper as ContainerHelper;
use Application\View\Helper\WordageHelper as WordageHelper;

class IndexController extends AbstractActionController
{
    protected $em;
	private $windowWidth;
	private $windowHeight;
    protected $storage;
    protected $authservice;
    protected $log;

    public function getAuthService()
    {
        if (! $this->authservice) {
            $this->authservice = $this->getServiceLocator()
                                      ->get('AuthService');
        }
        return $this->authservice;
    }
    public function getSessionStorage()
    {
        if (! $this->storage) {
            $this->storage = $this->getServiceLocator()
                                  ->get('Application\Storage\Login');
        }
        return $this->storage;
    }
    public function productsAction()
    {
    }
    public function servicesAction()
    {
    }
    public function contactAction()
    {
    }
    public function indexAction()
    {
        $em = $this->getEntityManager();
	$view = new ViewModel();
	$layout = $this->layout();

	$content = new Content();
	$content->setContainerId(1);
	$content->setEntityManager($em);
	$content->loadDataSource();

	$view = new ViewModel();

	$view->content = print_r($content,true);




	foreach ($content->toArray() as $num => $item)
	{
		$type = $item["type"];
		if (0 == strcmp($type,"Wordage"))
		{
			$helper = new WordageHelper();
			$helper->setServiceLocator($this->getServiceLocator());
			$helper->setEntityManager($this->getEntityManager());
			$object = $item["object"];
			$helper->setObject($object);
			$helper->setViewModel($view);
			$view->content=$helper;
		}
	}


/*
        $theItems= $em->getRepository('Application\Entity\Container')->findAll();
	$theObject = $theItems[0];
	$containerItem = new ContainerHelper();
	$containerItem->setEntityManager($em);
	$containerItem->setServiceLocator($this->getServiceLocator());
	$containerItem->setViewModel($view);
	$containerItem->setContainerObject($theObject);
	$containerItem->setItems($theItems);
	$html = $containerItem->toHTML();
	$view->content = $html;
*/
	return $view;
    } 
	public function loginAction()
	{
		$view = new ViewModel();
		$view->setTerminal(true);
		$form = new LoginForm();
		$boxHTML = "<div>TEST</div>";
		$view->box = $form;
		return $view;
	}
/*
	public function setsizeAction()
	{
		/
		 * This is correct code for receiving parameters from an ajax call
		 * But not the way to go about setting the window sizes.
		 * Need to use window.resize and percentages in layout.
		 *
		$view = new ViewModel();
		$view->setTerminal(true);
		$result = $_POST;
		$this->windowWidth = $result['width'];
		$this->windowHeight = $result['height'];
		$view->data = "success";
		return $view;
	}
*/
    public function welcomeAction()
    {
        $view = new ViewModel();

        $view->content = $this->content();
        
        return $view;
    }
    public function content()
    {
	return "content";
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
}
