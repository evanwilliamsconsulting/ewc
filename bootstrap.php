<?php
use Doctrine\ORM\Tools\Setup;

require_once "vendor/autoload.php";

// Create a simple "default" Doctrine ORM configuration for XML Mapping
$isDevMode = true;
$config = Setup::createAnnotationMetadataConfiguration(array(__DIR__."/entity"), $isDevMode);
// stackoverflow.com/questions/1743225/doctrine2-no-metadata-classes-to-process
//$config = Setup::createAnnotationMetadataConfiguration(array(__DIR__."/module/Application/src/Application/Entity"), $isDevMode,null,null,false);
//$config = Setup::createAnnotationMetadataConfiguration(array(__DIR__."/build"), $isDevMode,null,null,false);
// or if you prefer yaml or annotations
//$config = Setup::createXMLMetadataConfiguration(array(__DIR__."/config/xml"), $isDevMode);
//$config = Setup::createYAMLMetadataConfiguration(array(__DIR__."/config/yaml"), $isDevMode);

// database configuration parameters
$conn = array(
    'driver' => 'pdo_mysql',
    'host' => 'localhost',
    'dbname' => 'nhpress',
    'user' => 'root',
    'password' => 'ptH3984z'
);

// obtaining the entity manager
$entityManager = \Doctrine\ORM\EntityManager::create($conn, $config);
