<?php
namespace Application\Entity;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

use Doctrine\ORM\EntityManager;
use Application\Form\Entity\CorrespondantForm;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterInterface;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\Session\Container;
//use Zend\Stdlib\ArrayObject as ArrayObject;

//use Application\Model\Items as Items;
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
use Application\View\Helper\Binder as Binder;


use Application\Model\Containers as Containers;
use Application\Entity\Container as ContainerObject;
use Application\View\Helper\ContainerHelper as ContainerHelper;

use Zend\Db\Adapter\Driver\ResultInterface;
use Zend\Db\ResultSet\AbstractResultSet as AbstractResultSet;
use Zend\Stdlib\ArrayObject as ArrayObject;

class Items extends AbstractResultSet
{
     private $itemArray;
     protected $em;
     protected $obj;
     protected $log;

     public function __construct()
     {
		$this->obj = new ArrayObject();
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
		$wordages = $em->getRepository('Application\Entity\Wordage')->findAll();
		foreach	($wordages as $wordage)
		{
			$newArray = Array();
			$newArray["type"] = "Wordage";	
			$newArray["object"] = $wordage;
			$this->obj->append($newArray);
		}
		$pictures = $em->getRepository('Application\Entity\Picture')->findAll();
		foreach	($pictures as $picture)
		{
			$newArray = Array();
			$newArray["type"] = "Picture";	
			$newArray["object"] = $picture;
			$this->obj->append($newArray);
		}
		$files = $em->getRepository('Application\Entity\File')->findAll();
		foreach ($files as $file)
		{
			$newArray = Array();
			$newArray["type"] = "File";
			$newArray["object"] = $file;
			$this->obj->append($newArray);
		}
		$experiences= $em->getRepository('Application\Entity\Experience')->findAll();
		foreach ($experiences as $experience)
		{
			$newArray = Array();
			$newArray["type"] = "Experience";
			$newArray["object"] = $experience;
			$this->obj->append($newArray);
		}

		$codebases = $em->getRepository('Application\Entity\CodeBase')->findAll();
		foreach ($codebases as $codebase)
		{
			$newArray = Array();
			$newArray["type"] = "CodeBase";
			$newArray["object"] = $codebase;
			$this->obj->append($newArray);
		}
		$codesamples = $em->getRepository('Application\Entity\CodeSample')->findAll();
		foreach ($codesamples as $codesample)
		{
			$newArray = Array();
			$newArray["type"] = "CodeSample";
			$newArray["object"] = $codesample;
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
     /** get rows as array */
     public function toArray()
	 {
	 	$it = $this->obj->getIterator();
	   return $it->getArrayCopy();	
	 }
}
?>
