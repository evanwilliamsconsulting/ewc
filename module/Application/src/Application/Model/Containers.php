<?php
namespace Application\Model;

use Zend\Db\Adapter\Driver\ResultInterface;
use Zend\Db\ResultSet\AbstractResultSet as AbstractResultSet;
use Zend\Stdlib\ArrayObject as ArrayObject;


use Application\Model\ContainerItems as ContainerItems;
use Application\Entity\ContainerItems as ContainerItemObject;

class Containers extends AbstractResultSet
{
     private $itemArray;
     protected $em;
     protected $obj;
     protected $log;

     public function __construct()
     {
		$this->obj = new ArrayObject();
    }
/*
    public function setItems($someArray)
    {
	$this->itemArray = $someArray;
    }
    public function getItems()
    {
	return $this->itemArray;
    }
*/
    public function setLog($log)
    {
	$this->log = $log;
    }
    public function setEntityManager($em)
    {
    	$this->em = $em;
    }
	public function getEntityManager()
	{
		return $this->em;
	}
	public function loadDataSource()
	{
		$em = $this->getEntityManager();
		$containers = $em->getRepository('Application\Entity\Container')->findAll();

		foreach ($containers as $container)
		{

			// Find all Container Items for this Container;
			$containerId = $container->getId();
			$items = new ContainerItems();
			$items->setLog($this->log);
			$items->setEntityManager($this->em);
			$items->setContainerId($containerId);
			$items->loadDataSource();


			$itemArray = Array();
			foreach ($items->toArray() as $num => $item)
			{
				$newArray2 = $item;
				$itemArray[] = $newArray2;
				
			}

			$container->setEntityManager($this->em);
			$newArray = Array();
			$newArray["type"] = "Container";
			$newArray["object"] = $container;
			//$container->setItems(print_r($itemArray,true));
			$container->setItems($itemArray);
			$this->obj->append($newArray);
		}


	}
    public function getDataSource()
    {
	 	return $this->obj;
	 }
     public function getFieldCount()
	 {
	 	$it = $this->obj->getIterator();
	 	return $it->count();
	 }
     /** Iterator */
     public function next()
	 {
	 	$it = $this->obj->getIterator();
	    return $it->next();	
	 }
     public function key()
	 {
	 	$it = $this->obj->getIterator();
	 	return $it->key();
	 }
     public function current()
	 {
	 	$it = $this->obj->getIterator();
	 	return $it->current();
	 }
     public function valid()
	 {
	 	$it = $this->obj->getIterator();
	 	return $it->valid();
	 }
     public function rewind()
	 {
	 	$it = $this->obj->getIterator();
	 	return $it->rewind();
	 }
     /** countable */
     public function count()
	 {
	 	$it = $this->obj->getIterator();
		return $it->count();	 	
	 }
     public function getContainerItems()
     {
	return $this->itemArray;
     }
     /** get rows as array */
     public function toArray()
	 {
	 	$it = $this->obj->getIterator();
	   	$returnArray = $it->getArrayCopy();	
		return $returnArray;
	 }
}
?>
