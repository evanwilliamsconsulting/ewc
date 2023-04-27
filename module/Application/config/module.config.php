<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */
return array(
// Doctrine config
    'doctrine' => array(
        'connection' => array(
            // Configuration for service `doctrine.connection.orm_default` service
            'orm_default' => array(
                // configuration instance to use. The retrieved service name will
                // be `doctrine.configuration.$thisSetting`
                'configuration' => 'orm_default',
                // event manager instance to use. The retrieved service name will
                // be `doctrine.eventmanager.$thisSetting`
                'eventmanager'  => 'orm_default',
                // connection parameters, see
                // http://docs.doctrine-project.org/projects/doctrine-dbal/en/latest/reference/configuration.html
                'params' => array(
                    'host'     => 'localhost',
                    'port'     => '3306',
                    'user'     => 'root',
                    'password' => 'ptH3984z',
                    'dbname'   => 'nhpress',
                )
            ),
        ),
        // Configuration details for the ORM.
        // See http://docs.doctrine-project.org/en/latest/reference/configuration.html
        'configuration' => array(
            // Configuration for service `doctrine.configuration.orm_default` service
            'orm_default' => array(
                // metadata cache instance to use. The retrieved service name will
                // be `doctrine.cache.$thisSetting`
                'metadata_cache'    => 'array',
                // DQL queries parsing cache instance to use. The retrieved service
                // name will be `doctrine.cache.$thisSetting`
                'query_cache'       => 'array',
                // ResultSet cache to use.  The retrieved service name will be
                // `doctrine.cache.$thisSetting`
                'result_cache'      => 'array',
                // Hydration cache to use.  The retrieved service name will be
                // `doctrine.cache.$thisSetting`
                'hydration_cache'   => 'array',
                // Mapping driver instance to use. Change this only if you don't want
                // to use the default chained driver. The retrieved service name will
                // be `doctrine.driver.$thisSetting`
                'driver'            => 'orm_default',
                // Generate proxies automatically (turn off for production)
                'generate_proxies'  => true,
                // directory where proxies will be stored. By default, this is in
                // the `data` directory of your application
                'proxy_dir'         => 'data/DoctrineORMModule/Proxy',
                // namespace for generated proxy classes
                'proxy_namespace'   => 'DoctrineORMModule\Proxy',
                // SQL filters. See http://docs.doctrine-project.org/en/latest/reference/filters.html
                'filters'           => array(),
                // Custom DQL functions.
                // You can grab common MySQL ones at https://github.com/beberlei/DoctrineExtensions
                // Further docs at http://docs.doctrine-project.org/en/latest/cookbook/dql-user-defined-functions.html
                'datetime_functions' => array(),
                'string_functions' => array(),
                'numeric_functions' => array(),
                // Second level cache configuration (see doc to learn about configuration)
                'second_level_cache' => array()
            )
        ),
        // Metadata Mapping driver configuration
        'driver' => array(
            // Configuration for service `doctrine.driver.orm_default` service
	    'orm_default' => array(
                'class' => 'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
		'cache' => 'array',
		'paths' => array(__DIR__ . '/../src/' . __NAMESPACE__ . '/Application/Entity')
	    ),
            'Application_annotation_driver' => array(
                'class' => 'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
                'cache' => 'array',
                'paths' => array(
                    __DIR__ . '/../src/Application/Entity',
                ),
            ),
            'CRM_annotation_driver' => array(
                'class' => 'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
                'cache' => 'array',
                'paths' => array(
                    __DIR__ . '/../src/Application/Entity',
                ),
            ),
            'application_entities' => array(
                'class' => 'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
                'cache' => 'array',
                'paths' => array(__DIR__ . '/../src/Application/Entity')
            ),
            'orm_default' => array(
                // By default, the ORM module uses a driver chain. This allows multiple
                // modules to define their own entities
                // Map of driver names to be used within this driver chain, indexed by
                // entity namespace
                'drivers' => array(
		   'Application\Entity' => 'application_entities'
		)
            )

        ),
        // Entity Manager instantiation settings
        'entitymanager' => array(
            // configuration for the `doctrine.entitymanager.orm_default` service
            'orm_default' => array(
                // connection instance to use. The retrieved service name will
                // be `doctrine.connection.$thisSetting`
                'connection'    => 'orm_default',
                // configuration instance to use. The retrieved service name will
                // be `doctrine.configuration.$thisSetting`
                'configuration' => 'orm_default'
            )
        ),
        'eventmanager' => array(
            // configuration for the `doctrine.eventmanager.orm_default` service
            'orm_default' => array()
        ),
        // SQL logger collector, used when ZendDeveloperTools and its toolbar are active
        'sql_logger_collector' => array(
            // configuration for the `doctrine.sql_logger_collector.orm_default` service
            'orm_default' => array(),
        ),
        // mappings collector, used when ZendDeveloperTools and its toolbar are active
        'mapping_collector' => array(
            // configuration for the `doctrine.sql_logger_collector.orm_default` service
            'orm_default' => array(),
        ),
        // form annotation builder configuration
        'formannotationbuilder' => array(
            // Configuration for service `doctrine.formannotationbuilder.orm_default` service
            'orm_default' => array(),
        ),
        // entity resolver configuration, allows mapping associations to interfaces
        'entity_resolver' => array(
            // configuration for the `doctrine.entity_resolver.orm_default` service
            'orm_default' => array()
        ),
        // authentication service configuration
        'authentication' => array(
            // configuration for the `doctrine.authentication.orm_default` authentication service
            'orm_default' => array(
                // name of the object manager to use. By default, the EntityManager is used
                'objectManager' => 'doctrine.entitymanager.orm_default',
                //'identityClass' => 'Application\Model\User',
                //'identityProperty' => 'username',
                //'credentialProperty' => 'password'
            ),
        ),
        // migrations configuration
        'migrations_configuration' => array(
            'orm_default' => array(
                'directory' => 'data/DoctrineORMModule/Migrations',
                'name'      => 'Doctrine Database Migrations',
                'namespace' => 'DoctrineORMModule\Migrations',
                'table'     => 'migrations',
            ),
        ),
        // migrations commands base config
        'migrations_cmd' => array(
            'generate' => array(),
            'execute'  => array(),
            'migrate'  => array(),
            'status'   => array(),
            'version'  => array(),
            'diff'     => array(),
            'latest'   => array()
        ),
    ),
    'service_manager' => array(
        'factories' => array(
            'Doctrine\ORM\EntityManager' => 'DoctrineORMModule\Service\EntityManagerAliasCompatFactory',
        ),
        'invokables' => array(
            // DBAL commands
            'doctrine.dbal_cmd.runsql' => '\Doctrine\DBAL\Tools\Console\Command\RunSqlCommand',
            'doctrine.dbal_cmd.import' => '\Doctrine\DBAL\Tools\Console\Command\ImportCommand',
            // ORM Commands
            'doctrine.orm_cmd.clear_cache_metadata' => '\Doctrine\ORM\Tools\Console\Command\ClearCache\MetadataCommand',
            'doctrine.orm_cmd.clear_cache_result' => '\Doctrine\ORM\Tools\Console\Command\ClearCache\ResultCommand',
            'doctrine.orm_cmd.clear_cache_query' => '\Doctrine\ORM\Tools\Console\Command\ClearCache\QueryCommand',
            'doctrine.orm_cmd.schema_tool_create' => '\Doctrine\ORM\Tools\Console\Command\SchemaTool\CreateCommand',
            'doctrine.orm_cmd.schema_tool_update' => '\Doctrine\ORM\Tools\Console\Command\SchemaTool\UpdateCommand',
            'doctrine.orm_cmd.schema_tool_drop' => '\Doctrine\ORM\Tools\Console\Command\SchemaTool\DropCommand',
            'doctrine.orm_cmd.convert_d1_schema' => '\Doctrine\ORM\Tools\Console\Command\ConvertDoctrine1SchemaCommand',
            'doctrine.orm_cmd.generate_entities' => '\Doctrine\ORM\Tools\Console\Command\GenerateEntitiesCommand',
            'doctrine.orm_cmd.generate_proxies' => '\Doctrine\ORM\Tools\Console\Command\GenerateProxiesCommand',
            'doctrine.orm_cmd.convert_mapping' => '\Doctrine\ORM\Tools\Console\Command\ConvertMappingCommand',
            'doctrine.orm_cmd.run_dql' => '\Doctrine\ORM\Tools\Console\Command\RunDqlCommand',
            'doctrine.orm_cmd.validate_schema' => '\Doctrine\ORM\Tools\Console\Command\ValidateSchemaCommand',
            'doctrine.orm_cmd.info' => '\Doctrine\ORM\Tools\Console\Command\InfoCommand',
            'doctrine.orm_cmd.ensure_production_settings'
                => '\Doctrine\ORM\Tools\Console\Command\EnsureProductionSettingsCommand',
            'doctrine.orm_cmd.generate_repositories'
                => '\Doctrine\ORM\Tools\Console\Command\GenerateRepositoriesCommand',
        ),
    ),
    // Factory mappings - used to define which factory to use to instantiate a particular doctrine
    // service type
    'doctrine_factories' => array(
        'connection'               => 'DoctrineORMModule\Service\DBALConnectionFactory',
        'configuration'            => 'DoctrineORMModule\Service\ConfigurationFactory',
        'entitymanager'            => 'DoctrineORMModule\Service\EntityManagerFactory',
        'entity_resolver'          => 'DoctrineORMModule\Service\EntityResolverFactory',
        'sql_logger_collector'     => 'DoctrineORMModule\Service\SQLLoggerCollectorFactory',
        'mapping_collector'        => 'DoctrineORMModule\Service\MappingCollectorFactory',
        'formannotationbuilder'    => 'DoctrineORMModule\Service\FormAnnotationBuilderFactory',
        'migrations_configuration' => 'DoctrineORMModule\Service\MigrationsConfigurationFactory',
        'migrations_cmd'           => 'DoctrineORMModule\Service\MigrationsCommandFactory',
    ),
    // Zend\Form\FormElementManager configuration
    'form_elements' => array(
        'aliases' => array(
            'objectselect'        => 'DoctrineModule\Form\Element\ObjectSelect',
            'objectradio'         => 'DoctrineModule\Form\Element\ObjectRadio',
            'objectmulticheckbox' => 'DoctrineModule\Form\Element\ObjectMultiCheckbox',
        ),
        'factories' => array(
            'DoctrineModule\Form\Element\ObjectSelect'        => 'DoctrineORMModule\Service\ObjectSelectFactory',
            'DoctrineModule\Form\Element\ObjectRadio'         => 'DoctrineORMModule\Service\ObjectRadioFactory',
            'DoctrineModule\Form\Element\ObjectMultiCheckbox' => 'DoctrineORMModule\Service\ObjectMultiCheckboxFactory',
        ),
    ),
    'hydrators' => array(
        'factories' => array(
            'DoctrineModule\Stdlib\Hydrator\DoctrineObject' => 'DoctrineORMModule\Service\DoctrineObjectHydratorFactory'
        )
    ),
    'router' => array(
     'routes' => array(
         'default' => array(
             'type' => 'segment',
             'options' => array(
                 'route'    => '/[:controller[/:action]]',
                 'defaults' => array(
                     '__NAMESPACE__' => 'Application\Controller',
                     'controller'    => 'Index',
                     'action'        => 'index',
                 ),
                 'constraints' => [
                     'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                     'action'     => '[a-zA-Z][a-zA-Z0-9_-]*',
                 ]
             ),
         ),
         'correspondant' => array(
              'type' => 'literal',
              'options' => array(
                    'route' => '/correspondant/index',
                    'defaults' => array(
                          '__NAMESPACE__' => 'Application\Controller',
                         'controller' => 'correspondant',
                         'action' => 'index',
                    )
              )
	),
	'register' => array(
	      'type' => 'Segment',
              'options' => array(
	            'route' => '/:controller/:action',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Application\Controller',
			'controller' => 'auth',
			'action' => 'register',
		     ),
	      ),
 	),
	'signup' => array(
	      'type' => 'Segment',
              'options' => array(
	            'route' => '/:controller/:action',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Application\Controller',
			'controller' => 'auth',
			'action' => 'signup',
		     ),
	      ),
 	),
	'auth' => array(
	      'type' => 'Segment',
              'options' => array(
	            'route' => '/:controller/:action',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Application\Controller',
			'controller' => 'auth',
			'action' => 'signup',
		     ),
	      ),
 	),
        'content' => array(
              'type' => 'Segment',
              'options' => array(
                    'route' => '/:controller/:action/:item',
                    'defaults' => array(
                          '__NAMESPACE__' => 'Application\Controller',
                         'controller' => 'wordage',
			 'action' => 'view',
      			 'item' => 'item',
                    ),
              ),
	),
	'products' => array(
              'type' => 'literal',
              'options' => array(
                    'route' => '/',
                    'defaults' => array(
                          '__NAMESPACE__' => 'Application\Controller',
                         'controller' => 'index',
                         'action' => 'products',
                    )
              )
	),
	'services' => array(
              'type' => 'literal',
              'options' => array(
                    'route' => '/',
                    'defaults' => array(
                          '__NAMESPACE__' => 'Application\Controller',
                         'controller' => 'index',
                         'action' => 'services',
                    )
              )
	),
	'contact' => array(
              'type' => 'literal',
              'options' => array(
                    'route' => '/',
                    'defaults' => array(
                          '__NAMESPACE__' => 'Application\Controller',
                         'controller' => 'index',
                         'action' => 'services',
                    )
              )
	),
	'home' => array(
              'type' => 'literal',
              'options' => array(
                    'route' => '/',
                    'defaults' => array(
                          '__NAMESPACE__' => 'Application\Controller',
                         'controller' => 'index',
                         'action' => 'index',
                    )
              )
	)
     )
 ),
/*
    'router' => array(
        'routes' => array(
            'login' => array(
                'type' => 'Zend\Mvc\Router\Http\Literal',
            	'options' => array(
                    'route' => '/index/login',
                    'defaults' => array(
                        'controller' => 'Application\Controller\Index',
                        'action'     => 'index',
                    ),
                ), 
            ), 
            'binder' => array(
                'type' => 'Literal',
                'options' => array(
                    'route' => '/binder/',
                    'defaults' => array(
                       '__NAMESPACE__' => 'Application\Controller',
                       'controller' => 'binder',
                       'action' => 'index',
                    ),
                ), 
                'may_terminate' => true,
                'child_routes' => array(
                    'process' => array(
                        'type' => 'Segment',
                        'options' => array(
                            'route' => '/[:action]',
                            'constraints' => array(
                                'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                            ),
                            'defaults' => array(
                            ),
                        ),
                    ),
                ),
            ), 
            'container' => array(
                'type' => 'Literal',
                'options' => array(
                    'route' => '/container/',
                    'defaults' => array(
                       '__NAMESPACE__' => 'Application\Controller',
                       'controller' => 'container',
                       'action' => 'index',
                    ),
                    'view' => array(
                       '__NAMESPACE__' => 'Application\Controller',
                       'controller' => 'container',
                       'action' => 'view',
                    ),
                    'edit' => array(
                       '__NAMESPACE__' => 'Application\Controller',
                       'controller' => 'container',
                       'action' => 'edit',
                    ),
                ), 
                'may_terminate' => true,
                'child_routes' => array(
                    'process' => array(
                        'type' => 'Segment',
                        'options' => array(
                            'route' => '/[:action]',
                            'constraints' => array(
                                'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                            ),
                            'defaults' => array(
                            ),
                        ),
                    ),
                ),
            ), 
            'movie' => array(
                'type' => 'Literal',
                'options' => array(
                    'route' => '/movie/',
                    'defaults' => array(
                       '__NAMESPACE__' => 'Application\Controller',
                       'controller' => 'movie',
                       'action' => 'index',
                    ),
                    'search' => array(
                       '__NAMESPACE__' => 'Application\Controller',
                       'controller' => 'movie',
                       'action' => 'search',
                    ),
                ), 
                'may_terminate' => true,
                'child_routes' => array(
                    'process' => array(
                        'type' => 'Segment',
                        'options' => array(
                            'route' => '/[:action]',
                            'constraints' => array(
                                'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                            ),
                            'defaults' => array(
                            ),
                        ),
                    ),
                ),
            ), 
            'container' => array(
                'type' => 'Literal',
                'options' => array(
                    'route' => '/container/',
                    'defaults' => array(
                       '__NAMESPACE__' => 'Application\Controller',
                       'controller' => 'container',
                       'action' => 'index',
                    ),
                ), 
                'may_terminate' => true,
                'child_routes' => array(
                    'process' => array(
                        'type' => 'Segment',
                        'options' => array(
                            'route' => '/[:action]',
                            'constraints' => array(
                                'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                            ),
                            'defaults' => array(
                            ),
                        ),
                    ),
                ),
            ), 
            'experience' => array(
                'type' => 'Literal',
                'options' => array(
                    'route' => '/experience/',
                    'defaults' => array(
                       '__NAMESPACE__' => 'Application\Controller',
                       'controller' => 'correspondant',
                       'action' => 'index',
                    ),
                ), 
                'may_terminate' => true,
                'child_routes' => array(
                    'process' => array(
                        'type' => 'Segment',
                        'options' => array(
                  	    'route'    => '/:item[/]',
                            'constraints' => array(
                                'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                            ),
                            'defaults' => array(
                            ),
                        ),
                    ),
                ),
            ), 
            'home' => array(
                'type' => 'Zend\Mvc\Router\Http\Literal',
                'options' => array(
                    'route'    => '/',
                    'defaults' => array(
                        'controller' => 'Application\Controller\Index',
                        'action'     => 'index',
                    ),
                ),
            ),
            // The following is a route to simplify getting started creating
            // new controllers and actions without needing to create a new
            // module. Simply drop new controllers in, and you can access them
            // using the path /application/:controller/:action
            'application' => array(
                'type'    => 'Literal',
                'options' => array(
                    'route'    => '/application',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Application\Controller',
                        'controller'    => 'Index',
                        'action'        => 'index',
                     ),
                 ),
             ),
             'object' => array(
                 'type' => 'Segment',
                 'options' => array(
                      'route' => '/[:controller]/[:action]',
                      'constraints' => array(
                          'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                          'action'     => '[a-zA-Z][a-zA-Z0-9_-]*',
                      ),
                      'defaults' => array(
                          '__NAMESPACE__' => 'Application\Controller',
                          'controller'    => 'Index',
                          'action'        => 'index',
                      ),
                  ),
              ),
         ),
    ),
*/
    'service_manager' => array(
        'abstract_factories' => array(
            'Zend\Cache\Service\StorageCacheAbstractServiceFactory',
            'Zend\Log\LoggerAbstractServiceFactory',
        ),
        'factories' => array(
            'translator' => 'Zend\Mvc\Service\TranslatorServiceFactory',
        ),
    ),
    'translator' => array(
        'locale' => 'en_US',
        'translation_file_patterns' => array(
            array(
                'type'     => 'gettext',
                'base_dir' => __DIR__ . '/../language',
                'pattern'  => '%s.mo',
            ),
        ),
    ),
    'controllers' => array(
        'invokables' => array(
            'Application\Controller\Auth' => 'Application\Controller\AuthController',
            'Application\Controller\Success' => 'Application\Controller\SuccessController',
            'Application\Controller\Issue' => 'Application\Controller\IssueController',
            'Application\Controller\Index' => 'Application\Controller\IndexController',
            'Application\Controller\Broadsheet' => 'Application\Controller\BroadsheetController',
            'Application\Controller\Block' => 'Application\Controller\BlockController',
            'Application\Controller\Container' => 'Application\Controller\ContainerController',
            'Application\Controller\RichColumn' => 'Application\Controller\RichColumnController',
            'Application\Controller\Textcolumn' => 'Application\Controller\TextcolumnController',
            'Application\Controller\Headline' => 'Application\Controller\HeadlineController',
            'Application\Controller\Pix' => 'Application\Controller\PixController',
            'Application\Controller\PixLink' => 'Application\Controller\PixlinkController',
            'Application\Controller\Wordage' => 'Application\Controller\WordageController',
            'Application\Controller\Outline' => 'Application\Controller\OutlineController',
            'Application\Controller\Glossary' => 'Application\Controller\GlossaryController',
            'Application\Controller\Experience' => 'Application\Controller\ExperienceController',
            'Application\Controller\Code' => 'Application\Controller\CodeController',
            'Application\Controller\Picture' => 'Application\Controller\PictureController',
            'Application\Controller\Correspondant' => 'Application\Controller\CorrespondantController',
            'Application\Controller\Binder' => 'Application\Controller\BinderController',
            'Application\Controller\Movie' => 'Application\Controller\MovieController',
            'Application\Controller\Article' => 'Application\Controller\ArticleController',
        ),
    ),
    'view_manager' => array(
        'display_not_found_reason' => true,
        'display_exceptions'       => true,
        'doctype'                  => 'HTML5',
        'not_found_template'       => 'error/404',
        'exception_template'       => 'error/index',
        'template_map' => array(
            'layout/layout'           => __DIR__ . '/../view/layout/layout.phtml',
            'layout/correspondant'           => __DIR__ . '/../view/layout/correspondant.phtml',
            'application/index/index' => __DIR__ . '/../view/application/index/index.phtml',
        ),
        'template_path_stack' => array(
            __DIR__ . '/../view',
        ),
    ),
    // Placeholder for console routes
    'console' => array(
        'router' => array(
            'routes' => array(
            ),
        ),
    ),
    'view_helpers' => array(  
        'invokables' => array(  
            'customHelper' => 'Application\View\Helper\CustomHelper',  
	    'wordageHelper' => 'Application\View\Helper\WordageHelper',
	    'experienceHelper' => 'Application\View\Helper\ExperienceHelper',
                // more helpers here ...  
        )  
    ),  
    // doctrine
);
