<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Publish;

use Zend\Mvc\ModuleRouteListener;
use Zend\Mvc\MvcEvent;
/* from
*
* https://samsonasik.wordpress.com/2012/10/23/zend-framework-2-create-login-authentication-using-authenticationservice-with-rememberme/
*
*/
use Zend\ModuleManager\Feature\AutoloaderProviderInterface;
use Zend\ModuleManager\Feature\ViewHelperProviderInterface;
use Zend\ModuleManager\Feature\ConfigProviderInterface;
use Zend\Authentication\Storage;
use Zend\Authentication\AuthenticationService;
use Zend\Authentication\Adapter\DbTable as DbTableAuthAdapter;
use Application\View\Helper\Welcome as Welcome;
use Application\View\Helper\UserToolbar as UserToolbar;
use Application\View\Helper\SiteToolbar as SiteToolbar;
use Zend\Session\SessionManager;
use Zend\Session\Container;
use Zend\Log\Logger;
use Application\View\Helper\TopicToolbar as TopicToolbar;
use Application\View\Helper\WordageHelper as WordageHelper;
use Application\Service\WordageService as WordageService;
use Application\View\Helper\ItemHelper as ItemHelper;
use Application\Service\ItemService as ItemService;
use Zend\Db\Adapter\Adapter;
use Zend\Log\Writer\Db;


class Module implements AutoloaderProviderInterface, ViewHelperProviderInterface, ConfigProviderInterface
{
    public function getServiceConfig()
    {
        return array(
            'factories'=>array(
                'log' => function($sm) {
                    $log = new Logger();
		    $dbconfig = array(
        		'driver'         => 'PdoMysql',
        		'dsn'            => 'mysql:dbname=ewc;host=localhost',
        		'username'       => 'root',
        		'password'       => 'ptH3984z'
			);
		    $db = new Adapter($dbconfig);
		    $mapping = [
			'timestamp' => 'date',
			'priority' => 'type',
			'message' => 'event',
			];
		    $writer = new Db($db,'log_table_name');
                    $log->addWriter($writer);
                    return $log;
                },
            )
        );
    }
    public function onBootstrap(MvcEvent $e)
    {
        $eventManager        = $e->getApplication()->getEventManager();
        $moduleRouteListener = new ModuleRouteListener();
        $moduleRouteListener->attach($eventManager);

        $serviceManager = $e->getApplication()->getServiceManager();
	    $viewModel = $e->getApplication()->getMvcEvent()->getViewModel();
    }
    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }
    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }
    public function getViewHelperConfig()
    {
        return array(
            'factories' => array(
                'block_helper' => function($sm) {
                    $helper = new BlockHelper;
                    return $helper;
                },
            )
        );   
    }
}
