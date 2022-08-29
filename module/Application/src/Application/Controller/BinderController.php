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
use Application\View\Helper\BaseHelper as BaseHelper;
use Application\View\Helper\ExperienceHelper as ExperienceHelper;

use Application\View\Helper\HeadlineHelper as HeadlineHelper;

use Application\View\Helper\Toolbar as Toolbar;


use Application\Model\Containers as Containers;
use Application\Entity\Container as ContainerObject;
use Application\View\Helper\ContainerHelper as ContainerHelper;

class BinderController extends AbstractActionController
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
    public function indexAction()
    {
    	$userSession = new Container('user');
	$this->username = $userSession->username;
	$loggedIn = $userSession->loggedin;
	//$loggedIn = true;
	if ($loggedIn)
	{
		// Set the Helpers
		$layout = $this->layout();
		foreach($layout->getVariables() as $child)
		{
			//$child->setLoggedIn(true);
			$child->setLoggedIn($loggedIn);
			$child->setUserName($this->username);
			}
	}
	else
	{
	       return $this->redirect()->toUrl('https://www.evtechnote.us/');
	}

        $em = $this->getEntityManager();

	$criteria = array("id" => 1);
	$binders = $em->getRepository('Application\Entity\Binder')->findBy($criteria);

	print_r($binders);	

	$criteria = array("binder_id" => 1);
	$wordage = $em->getRepository('Application\Entity\Wordage')->findBy($criteria);

	print_r($wordage);
    
    }
}
