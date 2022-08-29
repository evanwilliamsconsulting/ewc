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
use TMDB\Client as MovieClient;

use Application\Model\Containers as Containers;
use Application\Entity\Container as ContainerObject;
use Application\View\Helper\ContainerHelper as ContainerHelper;

class MovieController extends AbstractActionController
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
    public function indexAction()
    {
	//$this->log = $this->getServiceLocator()->get('log');
	$view = new ViewModel();

	//$this->log->info("test");

/*
	if ($this->getAuthService()->getIdentity() != NULL)
	{
		    $layout = $this->layout();
		    foreach($layout->getVariables() as $child)
		    {
			$child->setLoggedIn(true);
			$child->setUserName($username);
		    }
	}
*/

	
	$view->message = "OK";
$apikey = "ad6236b3b2693fb2ac8797547ee955d1";
$db = MovieClient::getInstance($apikey);
$content = print_r($db,true);
//$db->adult = true;  // return adult content
//$db->paged = false; // merges all paged results into a single result automatically

$title = 'The Matrix';
$year = '1999';
$language = 'en-US';
$type='popular';

//$results = $db->search('movie', array('query'=>$title, 'year'=>$year));
$results= $db->info('movie','popular',false,array('language'=>$language));
$topmovies = $results->results;
	$movies=array();
	$index = 1;
	foreach ($topmovies as $key => $value)
	{
		if ($value->original_language=="en")
		{
			$movies[] = $value;
			$index += 1;
			if ($index == 11)
			{
				break;
			}
		}
	}
	$firstMovie=$movies[0];
	$title = $firstMovie->original_title;

	$view->content = $movies;

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
