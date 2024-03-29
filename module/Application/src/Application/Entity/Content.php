<?php
namespace Application\Entity;

use Zend\Db\Adapter\Driver\ResultInterface;
use Zend\Db\ResultSet\AbstractResultSet as AbstractResultSet;
use Zend\Stdlib\ArrayObject as ArrayObject;

class Content extends AbstractResultSet
{
     private $itemArray;
     protected $em;
     protected $obj;
     protected $obj2;
     protected $log;
     protected $containerId;

     public function __construct()
     {
		$this->obj = new ArrayObject();
		$this->obj2 = new ArrayObject();
    }
    public function setLog($log)
    {
	$this->log = $log;
	$this->log->info("Container Items Set Log");
    }
    public function setEntityManager($em)
    {
    	$this->em = $em;
	//$this->log->info("Container Items Set Entity Manager");
    }
	public function getEntityManager()
	{
		return $this->em;
	}
	public function loadDataSource()
	{
		$em = $this->getEntityManager();
		$containerId = $this->containerId;
		$criteria = Array();
		$criteria["containerid"] = $containerId;
		$order = Array();
		$order["container_order"] = "ASC";

		$containers = $em->getRepository('Application\Entity\ContainerItems')->findBy($criteria,$order);

		foreach ($containers as $container)
		{
			$newArray = Array();
			$newArray["type"] = "ContainerItem";
			$newArray["object"] = $container;
			$itemtype = $container->getItemType();
			$newArray["itemtype"] = $itemtype;
			$itemid = $container->getItemId();
			$newArray["itemid"] = $itemid;
			$this->obj->append($newArray);

			$criteria = array("id" => $itemid);
			
			if (0 == strcmp($itemtype,"wordage"))
			{
				$em = $this->getEntityManager();
				$wordages = $em->getRepository('Application\Entity\Wordage')->findBy($criteria);
				foreach	($wordages as $wordage)
				{
					$newArray = Array();
					$newArray["type"] = "Wordage";	
					$newArray["object"] = $wordage;
					$this->obj->append($newArray);
				}
			}
			if (0 == strcmp($itemtype,"product"))
			{
				$em = $this->getEntityManager();
				$products = $em->getRepository('Application\Entity\Product')->findBy($criteria);
				foreach	($products as $product)
				{
					$newArray = Array();
					$newArray["type"] = "Product";	
					$newArray["object"] = $product;
					$this->obj->append($newArray);
				}
			}
			else if (0 == strcmp($itemtype,"picture"))
			{
				$pictures = $em->getRepository('Application\Entity\Picture')->findBy($criteria);
				foreach	($pictures as $picture)
				{
					$newArray = Array();
					$newArray["type"] = "Picture";	
					$newArray["object"] = $picture;
					$this->obj->append($newArray);
				}
			}
			else if (0 == strcmp($itemtype,"headline"))
			{
				$headlines = $em->getRepository('Application\Entity\Headline')->findBy($criteria);
				foreach ($headlines as $headline)
				{
					$newArray = Array();
					$newArray['type'] = "Headline";
					$newArray['object'] = $headline;
					$this->obj->append($newArray);
				}
			}
			else if (0 == strcmp($itemtype,"file"))
			{	
				$files = $em->getRepository('Application\Entity\File')->findBy($criteria);
				foreach ($files as $file)
				{
					$newArray = Array();
					$newArray["type"] = "File";
					$newArray["object"] = $file;
					$this->obj->append($newArray);
				}
			}
			else if (0 == strcmp($itemtype,"experience"))
			{
				$experiences= $em->getRepository('Application\Entity\Experience')->findBy($criteria);
				foreach ($experiences as $experience)
				{
					$newArray = Array();
					$newArray["type"] = "Experience";
					$newArray["object"] = $experience;
					$this->obj->append($newArray);
				}
			}
			else if (0 == strcmp($itemtype,"codebase"))
			{	
				$codebases = $em->getRepository('Application\Entity\CodeBase')->findBy($criteria);
				foreach ($codebases as $codebase)
				{
					$newArray = Array();
					$newArray["type"] = "CodeBase";
					$newArray["object"] = $codebase;
					$this->obj->append($newArray);
				}
			}
			else if (0 == strcmp($itemtype,"codesample"))
			{
				$codesamples = $em->getRepository('Application\Entity\CodeSample')->findBy($criteria);
				foreach ($codesamples as $codesample)
				{
					$newArray = Array();
					$newArray["type"] = "CodeSample";
					$newArray["object"] = $codesample;
					$this->obj->append($newArray);
				}
			}
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
     public function setContainerId($id)
     {
	$this->containerId = $id;
     }
     public function getContainerId()
     {
	return $this->containerId;
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
     /** get rows as array */
     public function toArray()
	 {
	   $it = $this->obj->getIterator();
	   return $it->getArrayCopy();	
	 }
}
