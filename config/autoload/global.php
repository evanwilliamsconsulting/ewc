<?php
/**
 * Global Configuration Override
 *
 * You can use this file for overriding configuration values from modules, etc.
 * You would place values in here that are agnostic to the environment and not
 * sensitive to security.
 *
 * @NOTE: In practice, this file will typically be INCLUDED in your source
 * control, so do not include passwords or other sensitive information in this
 * file.
 */

return array(
    'db' => array(
        'driver'         => 'PdoMysql',
        'dsn'            => 'mysql:dbname=nhpress;host=127.0.0.1',
        'username'       => 'root',
        'password'       => 'ptH3984z'
    ),
    'service_manager' => array(
        'factories' => array(
            'Zend\Db\Adapter\Adapter'
                    => 'Zend\Db\Adapter\AdapterServiceFactory',
        ),
    ),
    'session' => array(
        'config' => array(
            'class' => 'Zend\Session\Config\SessionConfig',
            'options' => array(
                'name' => 'ewc',
		'gc_maxlifetime' => 3600,
		'gc_divisor' => 1,
            ),
        ),
        'storage' => 'Zend\Session\Storage\SessionArrayStorage',
        'validators' => array(
            'Zend\Session\Validator\RemoteAddr',
            'Zend\Session\Validator\HttpUserAgent',
        ),
    ),
    'doctrine' => array(
        'connection' => array(
            'orm_default' => array(
	        'driverClass' => 'Doctrine\DBAL\Driver\PDOMySql\Driver',
                'params' => array(
		    'host' => '127.0.0.1',
		    'port' => '3306',
		    'user' => 'root',
		    'password' => 'ptH3984z', 
		    'dbname' => 'nhpress',
                    'charset'  => 'utf8',
                    'driverOptions' => array(
                        1002 => 'SET NAMES utf8'
                    ),
                ),
            ),
        ),
        'driver' => array(
            'orm_default' => array(
                'drivers' => array(
                    'Application\Entity' => 'Application_annotation_driver',
                    'CRM\Entity' => 'CRM_annotation_driver',
                ),
            ),
        ),
    ),
);    // ...
